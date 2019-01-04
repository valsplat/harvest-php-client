<?php

namespace Valsplat\Harvest\Entities;

use Valsplat\Harvest\Actions;
use Valsplat\Harvest\Entity;

class Task extends Entity
{
    use Actions\Getable;
    use Actions\Listable;
    use Actions\Storable;
    use Actions\Deletable;

    protected $fillable = [
        'id',
        'name',
        'billable_by_default',
        'default_hourly_rate',
        'is_default',
        'is_active'
    ];

    protected $endpoint = 'tasks/';
    protected $namespace = 'tasks';

    public function activate() {
      $this->is_active = 1;
      $this->save();
    }

    public function archive() {
      $this->is_active = 0;
      $this->save();
    }

}
