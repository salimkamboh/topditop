<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Fieldtype
 *
 * @property int $id
 * @property string $name
 * @property string $template
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property bool $active
 * @method static \Illuminate\Database\Query\Builder|\App\Fieldtype whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fieldtype whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fieldtype whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fieldtype whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fieldtype whereTemplate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fieldtype whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Fieldtype extends Model
{
    protected $fillable = ['name'];


}
