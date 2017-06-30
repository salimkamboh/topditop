<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PackageLimitation
 *
 * @property int $id
 * @property int $package_id
 * @property int $limitation_id
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\PackageLimitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PackageLimitation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PackageLimitation whereLimitationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PackageLimitation wherePackageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PackageLimitation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PackageLimitation whereValue($value)
 * @mixin \Eloquent
 */
class PackageLimitation extends Model
{
    //
}
