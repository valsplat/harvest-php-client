<?php

namespace Valsplat\Harvest;

use Valsplat\Harvest\Entities;

class Harvest
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function client($attributes = [])
    {
        return new Entities\Client($this->connection, $attributes);
    }

    public function project($attributes = [])
    {
        return new Entities\Project($this->connection, $attributes);
    }

    public function task($attributes = [])
    {
        return new Entities\Task($this->connection, $attributes);
    }

    public function taskAssignment($attributes = [])
    {
        return new Entities\TaskAssignment($this->connection, $attributes);
    }

    public function userAssignment($attributes = [])
    {
        return new Entities\UserAssignment($this->connection, $attributes);
    }
}
