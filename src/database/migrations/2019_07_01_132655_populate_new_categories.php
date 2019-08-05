<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Field;
use App\Store;

class PopulateNewCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $stores = Store::All();
        
        foreach ($stores as $store) {            
            $old_cats_onestopshop = array_filter(explode(",", Field::getSelectedValues("onestopshop", $store)));
            
            $new_categories = array();
            foreach ($old_cats_onestopshop as $old_cat) {                
                //$old_cat //contains String
                
                $new_cat_ID = DB::table('categories')->where('name', $old_cat)->first();
                
                if (!empty($new_cat_ID->id)) {
                    $new_categories[] = $new_cat_ID->id;   
                }                
            }
            
            $store->categories()->attach($new_categories);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
