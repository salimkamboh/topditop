<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $store_id
 * @property bool $confirmed
 * @property string $confirmation_code
 * @property bool $json_data
 * @property string $bond_type
 * @property string $term_acceptance_1
 * @property string $term_acceptance_2
 * @property bool $admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Registerfield[] $registerfields
 * @property-read \App\Store $store
 * @method static \Illuminate\Database\Query\Builder|\App\User admin()
 * @method static \Illuminate\Database\Query\Builder|\App\User regular()
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBondType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereConfirmationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereConfirmed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereJsonData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTermAcceptance1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereTermAcceptance2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
