<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Package
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Limitation[] $limitations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Panel[] $panels
 * @method static \Illuminate\Database\Query\Builder|\App\Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Package whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Package whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Package whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Package whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Package extends Model
{
    const HIGHEST = 'TopDiTop Store';
    const MIDDLE = 'TopStore';
    const LOWEST = 'Store';
    const LIGHT = 'Light Store';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function limitations()
    {
        return $this->belongsToMany('App\Limitation')->withPivot('value')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function panels()
    {
        return $this->hasMany('App\Panel');
    }

    public function getLimitation($entity)
    {
        $limitation = Limitation::where('value', $entity)->first();
        $limitationPackagePIVOT = LimitationPackage::where(['limitation_id' => $limitation->id, 'package_id' => $this->id])->get()->first();
        return $limitationPackagePIVOT->value;
    }
}
