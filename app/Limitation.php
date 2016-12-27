<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Limitation extends Model
{

    const DISK_FULL = 202;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function packages() {
        return $this->belongsToMany('App\Package');
    }
}
