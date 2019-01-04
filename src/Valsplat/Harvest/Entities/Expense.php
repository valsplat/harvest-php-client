<?php

namespace Valsplat\Harvest\Entities;

use Valsplat\Harvest\Actions;
use Valsplat\Harvest\Entity;

class Expense extends Entity
{
    use Actions\Getable;
    use Actions\Listable;
    use Actions\Storable;
    use Actions\Deletable;

    protected $fillable = [
        'id',
        'user_id',
        'project_id',
        'expense_category_id',
        'spent_date',
        'units',
        'total_cost',
        'notes',
        'billable',
        'receipt',
    ];

    protected $singleNestedEntities = [
        'user' => User::class,
        'project' => Project::class,
        'expense_category' => ExpenseCategory::class,
    ];

    protected $endpoint = 'expenses/';
    protected $namespace = 'expenses';
}
