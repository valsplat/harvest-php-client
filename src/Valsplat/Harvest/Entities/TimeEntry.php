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
        'user_id',
        'project_id',
        'task_id',
        'spent_date',
        'hours',
        'notes',
    ];

    protected $endpoint = 'time_entries/';
    protected $namespace = 'time_entries';
}
