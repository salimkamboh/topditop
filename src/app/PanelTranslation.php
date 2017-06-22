<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PanelTranslation
 *
 * @property int $id
 * @property int $panel_id
 * @property string $locale
 * @property string $name
 * @method static \Illuminate\Database\Query\Builder|\App\PanelTranslation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PanelTranslation whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PanelTranslation whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PanelTranslation wherePanelId($value)
 * @mixin \Eloquent
 */
class PanelTranslation extends Model
{
    public $timestamps = false;

}