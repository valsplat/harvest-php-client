<?php

namespace Valsplat\Harvest\Entities;

use Valsplat\Harvest\Actions;
use Valsplat\Harvest\Entity;

class ProjectUserAssignment extends Entity
{
    use Actions\Getable;
    use Actions\Listable;
    use Actions\Storable;
    use Actions\Deletable;

    protected $fillable = [
        'user_id',
        'project_id',
        'is_active',
        'is_project_manager',
        'hourly_rate',
        'budget'
    ];

    protected $endpoint = 'user_assignments/';
    protected $namespace = 'user_assignments';

    public function getEndpoint() {
        if (isset($this->project_id)) {
            return sprintf('projects/%s/%s', $this->project_id, $this->endpoint);
        } else {
            return $this->endpoint;
        }
    }
}