<?php

namespace Valsplat\Harvest\Entities;

use Valsplat\Harvest\Actions;
use Valsplat\Harvest\Entity;

class ProjectTaskAssignment extends Entity
{
    use Actions\Getable;
    use Actions\Listable;
    use Actions\Storable;
    use Actions\Deletable;

    protected $fillable = [
        'task_id',
        'project_id',
        'is_active',
        'billable',
        'hourly_rate',
        'budget'
    ];

    protected $endpoint = 'task_assignments/';
    protected $namespace = 'task_assignments';

    public function getEndpoint() {
        if (isset($this->project_id)) {
            return sprintf('projects/%s/%s', $this->project_id, $this->endpoint);
        } else {
            return $this->endpoint;
        }
    }
}
