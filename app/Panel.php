<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{

    use \Dimsav\Translatable\Translatable;

    protected $fillable = ['key', 'name'];

    public $translatedAttributes = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fieldGroups()
    {
        return $this->belongsToMany('App\FieldGroup');
    }

    public function orderedFieldGroups()
    {
        return $this->fieldGroups()->orderBy("tableorder");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo('App\Package');
    }

    /**
     * @return array
     */
    public function getAssociatedFieldGroupIds()
    {
        $ids = array();
        foreach ($this->fieldGroups as $item) {
            $ids[] = $item->id;
        }
        return $ids;
    }
}