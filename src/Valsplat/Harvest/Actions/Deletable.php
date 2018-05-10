<?php

namespace Valsplat\Harvest\Actions;

trait Deletable
{

    /**
     * Delete an item
     *
     * @return mixed
     * @author Bjorn
     */
    public function delete()
    {
        return $this->connection()->delete($this->getEndpoint() . urlencode($this->id));
    }
}
