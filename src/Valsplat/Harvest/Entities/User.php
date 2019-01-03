<?php

namespace Valsplat\Harvest\Entities;

use Valsplat\Harvest\Actions;
use Valsplat\Harvest\Entity;

class User extends Entity
{
    use Actions\Getable;
    use Actions\Listable;
    use Actions\Storable;
    use Actions\Deletable;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'telephone',
        'timezone',
        'has_access_to_all_future_projects',
        'is_contractor',
        'is_admin',
        'is_project_manager',
        'can_see_rates',
        'can_create_projects',
        'can_create_invoices',
        'is_active',
        'weekly_capacity',
        'default_hourly_rate',
        'cost_rate',
        'roles'
    ];

    protected $endpoint = 'users/';
    protected $namespace = 'users';
}
