<?php

namespace Valsplat\Harvest\Entities;

use Valsplat\Harvest\Actions;
use Valsplat\Harvest\Entity;

class Project extends Entity
{
    use Actions\Getable;
    use Actions\Listable;
    use Actions\Storable;
    use Actions\Deletable;

    protected $fillable = [
        'id',
        'client_id',
        'name',
        'code',
        'is_active',
        'is_billable',
        'is_fixed_fee',
        'bill_by',
        'hourly_rate',
        'budget',
        'budget_by',
        'notify_when_over_budget',
        'over_budget_notification_percentage',
        'over_budget_notification_date',
        'show_budget_to_all',
        'cost_budget',
        'cost_budget_include_expenses',
        'fee',
        'notes',
        'starts_on',
        'ends_on'
    ];

    protected $singleNestedEntities = [
        'client' => Client::class,
    ];

    protected $endpoint = 'projects/';
    protected $namespace = 'projects';

    /**
     * Assign Task to this project
     * @param array of fillable
     * @author Joris
     */
    public function taskAssignment($attributes = [])
    {
        $ta = new TaskAssignment($this->connection, $attributes);
        $ta->project_id = $this->id;
        $ta->endpoint = 'projects/{project_id}/'.$ta->endpoint;

        return $ta;
    }

    public function userAssignment($attributes = [])
    {
        $attributes['project_id'] = $this->id;
        return new UserAssignment($this->connection, $attributes);
    }
}
