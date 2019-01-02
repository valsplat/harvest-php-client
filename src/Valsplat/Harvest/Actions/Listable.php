<?php

namespace Valsplat\Harvest\Actions;

trait Listable
{
    /**
     * @return mixed
     */
    public function list($params = [])
    {
        $result = $this->connection()->get($this->getEndpoint(), $params);
        $this->metadataFromResult($result);

        return $this->collectionFromResult($result);
    }

    /**
     * @return mixed
     */
    public function listAll($params = [])
    {
        $collection = [];

        do {
            if ($this->meta['next_page']) {
                $params['page'] = $this->meta['next_page'];
            }

            $result = $this->connection()->get($this->getEndpoint(), $params);
            $this->metadataFromResult($result);
            $collection = array_merge($collection, $this->collectionFromResult($result));

        } while ($this->meta['next_page']);

        return $collection;
    }
}
