<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    const HIGHEST = 'TopDiTop Store';
    const MIDDLE = 'TopStore';
    const LOWEST = 'Store';

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
