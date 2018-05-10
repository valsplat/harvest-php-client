<?php

namespace Valsplat\Harvest\Entities;

use Valsplat\Harvest\Actions;
use Valsplat\Harvest\Entity;

class Task extends Entity
{
    use Actions\Getable;
    use Actions\Listable;
    use Actions\Storable;
    use Actions\Deletable;

    protected $fillable = [
        'name',
        'billable_by_default',
        'default_hourly_rate',
        'is_default',
        'is_active'
    ];

    protected $endpoint = 'tasks/';
    protected $namespace = 'tasks';
}
