<?php

namespace Valsplat\Harvest\Actions;

trait Deletable
{

    /**
     * Delete an item
     * @param $id (default to $this->id if not given)
     * @return mixed
     * @author Bjorn
     */
    public function delete($id = null)
    {
        if ($id !== null) {
            $this->id = $id;
        }
        return $this->connection()->delete($this->getEndpoint() . urlencode($this->id));
    }
}
