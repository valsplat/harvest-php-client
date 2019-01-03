<?php

namespace Valsplat\Harvest\Entities;

use Valsplat\Harvest\Actions;
use Valsplat\Harvest\Entity;

class Client extends Entity
{
    use Actions\Getable;
    use Actions\Listable;
    use Actions\Storable;
    use Actions\Deletable;

    protected $fillable = [
        'id',
        'name',
        'is_active',
        'address',
        'currency'
    ];

    protected $endpoint = 'clients/';
    protected $namespace = 'clients';
}
