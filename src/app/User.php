<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the store that owns the user
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function registerfields()
    {
        return $this->belongsToMany('App\Registerfield')->withPivot('valueEntered')->withTimestamps();
    }

    public function numberOf($entity) {
        if($entity == 'product') {
            return count($this->store->products);
        } else if($entity == 'reference') {
            return count($this->store->references);
        }
    }

    public function numberOfProducts()
    {
        return count($this->store->products);
    }

    public function numberOfReferences()
    {
        return count($this->store->references);
    }

    public function isNotReady()
    {
        if ($this->store->status == 0) {
            return true;
        } else {
            return false;
        }
    }
}