<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Registerfield
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $values
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $fieldlocation
 * @property int $order
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Registerfield whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Registerfield whereFieldlocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Registerfield whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Registerfield whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Registerfield whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Registerfield whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Registerfield whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Registerfield whereValues($value)
 * @mixin \Eloquent
 */
class Registerfield extends Model
{
    protected $fillable = ['key', 'name', 'values', 'fieldlocation'];

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('valueEntered')->withTimestamps();
    }
}
