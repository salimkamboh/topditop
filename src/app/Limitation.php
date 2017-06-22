<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Limitation
 *
 * @property int $id
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Package[] $packages
 * @method static \Illuminate\Database\Query\Builder|\App\Limitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Limitation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Limitation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Limitation whereValue($value)
 * @mixin \Eloquent
 */
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
