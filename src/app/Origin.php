<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Origin
 *
 * @property int $id
 * @property string $company
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $street
 * @property string $house_number
 * @property string $additional_address_info
 * @property string $postal_code
 * @property string $city
 * @property string $phone
 * @property string $email
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereAdditionalAddressInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereCompany($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereHouseNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin wherePostalCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereStreet($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Origin whereUserId($value)
 * @mixin \Eloquent
 */
class Origin extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
