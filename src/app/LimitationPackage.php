<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LimitationPackage
 *
 * @property int $id
 * @property int $package_id
 * @property int $limitation_id
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\LimitationPackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LimitationPackage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LimitationPackage whereLimitationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LimitationPackage wherePackageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LimitationPackage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LimitationPackage whereValue($value)
 * @mixin \Eloquent
 */
class LimitationPackage extends Model
{
    protected $fillable = ['value'];

    protected $table = 'limitation_package';
}
