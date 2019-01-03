<?php

namespace Valsplat\Harvest\Entities;

use Valsplat\Harvest\Actions;
use Valsplat\Harvest\Entity;

class ExpenseCategory extends Entity
{
    use Actions\Getable;
    use Actions\Listable;
    use Actions\Storable;
    use Actions\Deletable;

    protected $fillable = [
        'name', //	string	required	The name of the expense category.
        'unit_name', //	string	optional	The unit name of the expense category.
        'unit_price', //	decimal	optional	The unit price of the expense category.
        'is_active', // boolean	optional	Whether the expense category is active or archived. Defaults to true.
    ];

    protected $endpoint = 'expense_categories/';
    protected $namespace = 'expense_categories';
}
