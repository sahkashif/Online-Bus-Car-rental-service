<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Bus;

class bus_stop extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public function bus(){
        $bus = Bus::find($this->bus_id);
        return $bus;
    }
}