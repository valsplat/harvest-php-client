<?php

namespace Valsplat\Harvest\Entities;

use Valsplat\Harvest\Actions;
use Valsplat\Harvest\Entity;

class TimeEntry extends Entity
{
    use Actions\Getable;
    use Actions\Listable;
    use Actions\Storable;
    use Actions\Deletable;

    protected $fillable = [
        'id',
        'spent_date',
        'user_id',
        'project_id',
        'task_id',
        'hours',
        'notes',
        'is_locked',
        'locked_reason',
        'is_closed',
        'is_billed',
        'timer_started_at',
        'started_time',
        'ended_time',
        'is_running',
        'billable',
        'budgeted',
        'billable_rate',
        'cost_rate',
        'created_at',
        'updated_at',
    ];

    protected $endpoint = 'time_entries/';
    protected $namespace = 'time_entries';
}
