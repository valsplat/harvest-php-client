<?php

namespace Valsplat\Harvest;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7;
use Valsplat\Harvest\Exceptions\ApiException;
use Valsplat\Harvest\Exceptions\NotFoundException;

/**
 * Class Connection
 * @package Valsplat\Harvest
 */
class Connection
{
    /**
     * @var string
     */
    private $apiUrl = 'https://api.harvestapp.com/v2';

    /**
     * @var
     */
    private $accessToken;

    /**
     * @var
     */
    private $accountId;

    /**
     * @var array Middlewares for the Guzzle 6 client
     */
    protected $middlewares = [];

    /**
     * @var bool
     */
    private $testing = false;

    /**
     * @var object
     */
    private $client;

    /**
     * @return Client
     */
    private function client()
    {
        if ($this->client) {
            return $this->client;
        }

        $handlerStack = HandlerStack::create();
        foreach ($this->middlewares as $middleware) {
            $handlerStack->push($middleware);
        }

        $this->client = new Client([
            'http_errors' => true,
            'handler' => $handlerStack,
        ]);

        return $this->client;
    }

    /**
     * Insert a Middleware for the Guzzle Client
     * @param $middleWare
     */
    public function insertMiddleWare($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return Client
     * @throws ApiException
     */
    public function connect($accountId, $token)
    {
        $this->setAccountId($accountId);
        $this->setAccessToken($token);
        $client = $this->client();

        return $client;
    }

    /**
     * @param string $method
     * @param $endpoint
     * @param null $body
     * @param array $params
     * @param array $headers
     * @return Request
     */
    private function createRequest($method = 'GET', $endpoint, $body = null, array $params = [], array $headers = [])
    {
        // Add default json headers to the request
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Harvest-Account-ID' => $this->getAccountId(),
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
            'User-Agent' => 'vasplat/harvest-php-client',
        ]);

        // Create param string
        if (!empty($params)) {
            $endpoint .= '?' . http_build_query($params);
        }

        return new Request($method, $endpoint, $headers, $body);
    }

    /**
     * @param $url
     * @param array $params
     * @return mixed
     * @throws ApiException
     */
    public function get($url, array $params = [])
    {
        try {
            $request = $this->createRequest('GET', $this->formatUrl($url, 'get'), null, $params);
            $response = $this->client()->send($request);

            return $this->parseResponse($response);
        } catch (Exception $e) {
            $this->parseExceptionForErrorMessages($e);
        }
    }

    /**
     * @param $url
     * @param $body
     * @return mixed
     * @throws ApiException
     */
    public function post($url, $body)
    {
        try {
            $request = $this->createRequest('POST', $this->formatUrl($url, 'post'), $body);
            $response = $this->client()->send($request);

            return $this->parseResponse($response);
        } catch (Exception $e) {
            $this->parseExceptionForErrorMessages($e);
        }
    }

    /**
     * @param $url
     * @param $body
     * @return mixed
     * @throws ApiException
     */
    public function patch($url, $body)
    {
        try {
            $request = $this->createRequest('PATCH', $this->formatUrl($url, 'patch'), $body);
            $response = $this->client()->send($request);

            return $this->parseResponse($response);
        } catch (Exception $e) {
            $this->parseExceptionForErrorMessages($e);
        }
    }

    /**
     * @param $url
     * @return mixed
     * @throws ApiException
     */
    public function delete($url)
    {
        try {
            $request = $this->createRequest('DELETE', $this->formatUrl($url, 'delete'));
            $response = $this->client()->send($request);

            return $this->parseResponse($response);
        } catch (Exception $e) {
            $this->parseExceptionForErrorMessages($e);
        }
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return mixed
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param mixed $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @param Response $response
     * @return mixed
     * @throws ApiException
     */
    private function parseResponse(Response $response)
    {
        try {
            Psr7\rewind_body($response);
            $json = json_decode($response->getBody()->getContents(), true);

            return $json;
        } catch (\RuntimeException $e) {
            throw new ApiException($e->getMessage());
        }
    }

    /**
     * Parse the reponse in the Exception to return the Exact error messages
     * @param Exception $e
     * @throws ApiException
     */
    private function parseExceptionForErrorMessages(Exception $e)
    {
        if (!$e instanceof BadResponseException) {
            throw new ApiException($e->getMessage());
        }

        $response = $e->getResponse();
        Psr7\rewind_body($response);
        $responseBody = $response->getBody()->getContents();
        $decodedResponseBody = json_decode($responseBody, true);

        if (!is_null($decodedResponseBody) && isset($decodedResponseBody['message'])) {
            $errorMessage = $decodedResponseBody['message'];
        } else {
            $errorMessage = $responseBody;
        }

        if ($response->getStatusCode() === 404) {
            throw new NotFoundException($errorMessage);
        }

        throw new ApiException('Error ' . $response->getStatusCode() . ': ' . $errorMessage, $response->getStatusCode());
    }

    /**
     * @param $url
     * @param string $method
     * @return string
     */
    private function formatUrl($url, $method = 'get')
    {
        if ($this->testing) {
            return 'https://httpbin.org/' . $method;
        }

        return $this->apiUrl . '/' . $url;
    }

    /**
     * @return boolean
     */
    public function isTesting()
    {
        return $this->testing;
    }

    /**
     * @param boolean $testing
     */
    public function setTesting($testing)
    {
        $this->testing = $testing;
    }

    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }
}
