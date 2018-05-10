<?php

namespace Valsplat\Harvest\Actions;

trait Storable
{

    /**
     * @return mixed
     */
    public function save()
    {
        if ($this->exists()) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $result = $this->connection()->post($this->getEndpoint(), http_build_query($this->attributes()));
        return $this->selfFromResponse($result);
    }

    /**
     * @return mixed
     */
    public function update()
    {
        $result = $this->connection()->patch($this->getEndpoint() . urlencode($this->id), http_build_query($this->fillables()));
        return $this->selfFromResponse($result);
    }
}
