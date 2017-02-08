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

        return 0;
    }


    /**
     * Regular users, without admins
     *
     * @param $query
     * @return mixed
     */
    public function scopeRegular($query)
    {
        return $query->where('admin', 0);
    }

    public function scopeAdmin($query)
    {
        return $query->where('admin', 1);
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

    public function isAdmin()
    {
        if ($this->admin == 1) {
            return true;
        }
        return false;
    }
}
