<p align="center">
    <img src="https://www.getharvest.com/assets/press/harvest-logo-icon-77a6f855102e2f85a7fbe070575f293346a643c371a49ceff341d2814e270468.png" height="100">
    <h3 align="center">(Unofficial) Harvest v2 API Client for PHP</h3>
</p>

## Contributing

```
$ git clone git@github.com:valsplat/harvest-php-client.git
$ cd harvest-php-client
$ composer update -o
```

## Installation

```
$ composer require valsplat/harvest-php-client
```

## Endpoints

This API client is very much a work in progress and is incomplete at this time. You can only use the `Client`, `Project`, `Task`, `TaskAssignment`, `User` and `UserAssignment` endpoints. Feel free to create a Pull Request to increase coverage.

## Authentication

Authentication is done via providing your account ID and a personal access token:

```
$connection = new \Valsplat\Harvest\Connection();
$connection->setAccessToken('ACCESS_TOKEN');
$connection->setAccountId('ACCOUNT_ID');
```

Get your token and account ID here: https://id.getharvest.com/oauth2/access_tokens/new

## Errors

The API client throws two exceptions:

* `\Valsplat\Harvest\Exceptions\NotFoundException` - Entity could not be found
* `\Valsplat\Harvest\Exceptions\ApiException` - Generic Api exception

## Basic Usage

Each endpoint is accessible via its own method on the `\Valsplat\Harvest\Harvest` instance. The method name is singular, camelcased:

```
$vlak = new \Valsplat\Harvest\Harvest($connection);
$vlak->TaskAssignment();
```

## Generic methods & filters

* `list((array)params)` - get a collection of entities. You find the available params per endpoint in the [Harvest docs](https://help.getharvest.com/api-v2/).
* `get((int)id)` - get a single entity via its id.
* `create()` - create given entity.
* `update()` - update given entity.
* `save()` - convenience method; calls `update()` if the entity already exists, `create()` otherwise.
* `delete()` - delete given entity.

## Usage examples

Authentication and usage examples: [example.php](example.php)

## TODO

* Tests w/ mocked http client
* Complete endpoint support
* Automatic marshaling of attributes
