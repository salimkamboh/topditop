<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    const PACKAGE_1 = 'Store';
    const PACKAGE_2 = 'TopStore';
    const PACKAGE_3 = 'TopDiTop Store';

    protected $fillable = ['store_name', 'user_email', 'mag_store_id', 'mag_cat_id'];

    public function createNew($store_name, $mag_store_id, $mag_cat_id, $user_email)
    {
        $store = new Store();
        $store->store_name = $store_name;
        $store->mag_store_id = $mag_store_id;
        $store->mag_cat_id = $mag_cat_id;
        $store->user_email = $user_email;
        $store->save();
        return $store;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class); // or Profile::class
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product'); // or Profile::class
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function references()
    {
        return $this->hasMany('App\Reference'); // or Profile::class
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User'); // or Profile::class
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo('App\Image'); // or Profile::class
    }

    /**
     * Get the Location that owns the Store.
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function manufacturers()
    {
        return $this->belongsToMany(Manufacturer::class);
    }

    public function getNumberOfReferences()
    {
        return count($this->references);
    }

    public function getNumberOfProducts()
    {
        return count($this->products);
    }

    public function getStoreLogo()
    {
        if (!empty($this->image))
            return $this->image->getImageUrl();
        else
            return '';
    }

    public function getStoreCoverImage()
    {
        if (!empty($this->cover_url))
            return $this->cover_url;
        else
            return '';
    }

    /**
     * @return mixed
     */
    public function package_name()
    {
        $profile = Profile::where(['store_id' => $this->id])->get()->first();

        $package = $profile->package;
        return $package->name;
    }

    public function getStoreBrands()
    {
        $brands = array();
        /** @var $reference \App\Reference */
        foreach ($this->references as $reference) {
            foreach ($reference->manufacturers as $manufacturer) {
                if (!in_array($manufacturer->id, $brands))
                    $brands[] = $manufacturer->id;
            }
        }

        return Manufacturer::whereIn('id', $brands)->get();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getStoreData()
    {
        $store = $this;
        $datablock = array();
        $datablock["topditop_offer"] = array_filter(explode(",", Field::getSelectedValues("topditop_offer", $store)));
        $datablock["TopDiTop_Service"] = array_filter(explode(",", Field::getSelectedValues("TopDiTop_Service", $store)));
        $datablock["onestopshop"] = array_filter(explode(",", Field::getSelectedValues("onestopshop", $store)));
        $datablock["description"] = Field::getSelectedValues("description", $store);
        $datablock["address"] = Field::getSelectedValues("address", $store);

        $datablock["brands"] = array_filter(explode(",", Field::getSelectedValues("brands", $store)));


        $datablock["from_working_days"] = Field::getSelectedValues("from_working_days", $store);
        $datablock["to_working_days"] = Field::getSelectedValues("to_working_days", $store);
        $datablock["from_weekends"] = Field::getSelectedValues("from_weekends", $store);
        $datablock["to_weekends"] = Field::getSelectedValues("to_weekends", $store);

        $datablock["philosophy"] = Field::getSelectedValues("philosophy", $store);
        $datablock["quotation"] = Field::getSelectedValues("quotation", $store);
        $datablock["owner"] = Field::getSelectedValues("owner", $store);
        $datablock["contact_mail"] = Field::getSelectedValues("contact_mail", $store);
        $datablock["website"] = Field::getSelectedValues("website", $store);
        $datablock["telephone_number"] = Field::getSelectedValues("telephone_number", $store);
        $datablock["facebook_fanpage"] = Field::getSelectedValues("facebook_fanpage", $store);

        $datablock["store_latitude"] = Field::getSelectedValues("store_latitude", $store);
        $datablock["store_longitude"] = Field::getSelectedValues("store_longitude", $store);

        return $datablock;
    }

    public function getFieldByKey($key)
    {
        return array_filter(explode(",", Field::getSelectedValues($key, $this)));
    }
}
