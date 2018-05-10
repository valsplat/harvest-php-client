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
        return $this->collectionFromResult($result);
    }
}
