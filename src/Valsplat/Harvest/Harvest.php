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

    public function expense($attributes = [])
    {
        return new Entities\Expense($this->connection, $attributes);
    }

    public function expenseCategory($attributes = [])
    {
        return new Entities\ExpenseCategory($this->connection, $attributes);
    }

    public function project($attributes = [])
    {
        return new Entities\Project($this->connection, $attributes);
    }

    public function projectTaskAssignment($attributes = [])
    {
        return new Entities\ProjectTaskAssignment($this->connection, $attributes);
    }

    public function projectUserAssignment($attributes = [])
    {
        return new Entities\ProjectUserAssignment($this->connection, $attributes);
    }

    public function task($attributes = [])
    {
        return new Entities\Task($this->connection, $attributes);
    }


}
