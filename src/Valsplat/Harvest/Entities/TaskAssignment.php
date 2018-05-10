<?php

namespace Valsplat\Harvest\Entities;

use Valsplat\Harvest\Actions;
use Valsplat\Harvest\Entity;

class TaskAssignment extends Entity
{
    use Actions\Getable;
    use Actions\Listable;
    use Actions\Storable;
    use Actions\Deletable;

    protected $fillable = [
        'task_id',
        'is_active',
        'billable',
        'hourly_rate',
        'budget'
    ];

    protected $endpoint = 'task_assignments/';
    protected $namespace = 'task_assignments';
}
