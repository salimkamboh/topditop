<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MergeCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //insert new categories // 18.7.19
        $data = array(
            array('name'=>'Bad', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Badaccessoires', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Badmöbel', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Bänke', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Betten', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Boden', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Coffetables', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Esszimmer', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Fauteuils', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Heimtextilien', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Kinderzimmer', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Kleiderschränke', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Küche', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Küchenausstattung', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Licht', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Office', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Polstermöbel', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Regale', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Sanitär-Produkte', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Sauna & Wellness', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Schlafzimmer', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Schränke & Vitrinen', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Sessel', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Sideboards', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Sofas', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Stühle', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Teppiche', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Tische', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Wohnaccessoires', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
            array('name'=>'Wohnzimmer', 'description'=> 'x', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')),
        );
        
        $new_categories_ids = array();
        
        foreach ($data as $data_entry) {
            DB::table('categories')->insert($data_entry);

            $id = DB::getPdo()->lastInsertId();
			
			//save category IDs 
            array_push($new_categories_ids, $id);
        }       

        $category_mapping_strings = array(
			0 => array('old_cat_name' => 'Beds and Sofas', 'new_cat_name' => 'Betten'),
			1 => array('old_cat_name' => 'Sofas & Couches', 'new_cat_name' => 'Sofas'),
			2 => array('old_cat_name' => 'Sessel', 'new_cat_name' => 'Sessel'),
			3 => array('old_cat_name' => 'Couch & Beistelltische', 'new_cat_name' => 'Coffetables'),
			4 => array('old_cat_name' => 'Kommoden & Sideboards', 'new_cat_name' => 'Sideboards'),
			5 => array('old_cat_name' => 'Regale', 'new_cat_name' => 'Regale'),
			6 => array('old_cat_name' => 'TV & Mediamöbel', 'new_cat_name' => 'Schränke & Vitrinen'),
			7 => array('old_cat_name' => 'Wohnwände', 'new_cat_name' => 'Schränke & Vitrinen'),
			8 => array('old_cat_name' => 'Schränke & Vitrinen', 'new_cat_name' => 'Schränke & Vitrinen'),
			9 => array('old_cat_name' => 'Polsterhocker', 'new_cat_name' => 'Polstermöbel'),
			10 => array('old_cat_name' => 'Kamine & Zubehör', 'new_cat_name' => 'Wohnaccessoires'),
			11 => array('old_cat_name' => 'Einzelsessel', 'new_cat_name' => 'Sessel'),
			12 => array('old_cat_name' => 'Beistelltische', 'new_cat_name' => 'Coffetables'),
			13 => array('old_cat_name' => 'Sideboards', 'new_cat_name' => 'Sideboards'),
			14 => array('old_cat_name' => 'Beistellregale', 'new_cat_name' => 'Regale'),
			15 => array('old_cat_name' => 'TV-Wände', 'new_cat_name' => 'Regale'),
			16 => array('old_cat_name' => 'Massive Wohnwände', 'new_cat_name' => 'Schränke & Vitrinen'),
			17 => array('old_cat_name' => 'Bar & Weinschränke', 'new_cat_name' => 'Schränke & Vitrinen'),
			18 => array('old_cat_name' => 'Fußablagen', 'new_cat_name' => 'Wohnaccessoires'),
			19 => array('old_cat_name' => 'Elektrokamine', 'new_cat_name' => 'Wohnaccessoires'),
			20 => array('old_cat_name' => 'Ohrensessel', 'new_cat_name' => 'Sessel'),
			21 => array('old_cat_name' => 'Esstische', 'new_cat_name' => 'Tische'),
			22 => array('old_cat_name' => 'Esszimmerstühle', 'new_cat_name' => 'Stühle'),
			23 => array('old_cat_name' => 'Essgruppen', 'new_cat_name' => 'Esszimmer'),
			24 => array('old_cat_name' => 'Servierwagen', 'new_cat_name' => 'Wohnaccessoires'),
			25 => array('old_cat_name' => 'Armlehnstühle', 'new_cat_name' => 'Stühle'),
			26 => array('old_cat_name' => 'Eckbänke', 'new_cat_name' => 'Bänke'),
			27 => array('old_cat_name' => 'Freischwinger', 'new_cat_name' => 'Sessel'),
			28 => array('old_cat_name' => 'Einfache Sitzbänke', 'new_cat_name' => 'Bänke'),
			29 => array('old_cat_name' => 'Holzstühle', 'new_cat_name' => 'Stühle'),
			30 => array('old_cat_name' => 'Holzbänke', 'new_cat_name' => 'Bänke'),
			31 => array('old_cat_name' => 'Polsterstühle', 'new_cat_name' => 'Stühle'),
			32 => array('old_cat_name' => 'Polsterbänke', 'new_cat_name' => 'Bänke'),
			33 => array('old_cat_name' => 'Kleiderschränke', 'new_cat_name' => 'Schränke & Vitrinen'),
			34 => array('old_cat_name' => 'Betten', 'new_cat_name' => 'Betten'),
			35 => array('old_cat_name' => 'Matratzen', 'new_cat_name' => 'Betten'),
			36 => array('old_cat_name' => 'Lattenroste', 'new_cat_name' => 'Betten'),
			37 => array('old_cat_name' => 'Nachttische & Kommoden', 'new_cat_name' => 'Schlafzimmer'),
			38 => array('old_cat_name' => 'Schlafzimmersets', 'new_cat_name' => 'Schlafzimmer'),
			39 => array('old_cat_name' => 'Hocker & Bänke', 'new_cat_name' => 'Bänke'),
			40 => array('old_cat_name' => 'Schlafsofas', 'new_cat_name' => 'Sofas'),
			41 => array('old_cat_name' => 'Schminktische', 'new_cat_name' => 'Tische'),
			42 => array('old_cat_name' => 'Truhen', 'new_cat_name' => 'Schränke & Vitrinen'),
			43 => array('old_cat_name' => 'Paravents', 'new_cat_name' => 'Wohnaccessoires'),
			44 => array('old_cat_name' => 'Kissen & Bettdecken', 'new_cat_name' => 'Wohnaccessoires'),
			45 => array('old_cat_name' => 'Bettwäsche', 'new_cat_name' => 'Wohnaccessoires'),
			46 => array('old_cat_name' => 'Badezimmer Sets', 'new_cat_name' => 'Bad'),
			47 => array('old_cat_name' => 'Badschränke', 'new_cat_name' => 'Badmöbel'),
			48 => array('old_cat_name' => 'Waschplätze', 'new_cat_name' => 'Bad'),
			49 => array('old_cat_name' => 'Badregale', 'new_cat_name' => 'Badmöbel'),
			50 => array('old_cat_name' => 'Gästebäder', 'new_cat_name' => 'Bad'),
			51 => array('old_cat_name' => 'Badspiegel', 'new_cat_name' => 'Badaccessoires'),
			52 => array('old_cat_name' => 'Sanitär & Hygiene', 'new_cat_name' => 'Bad'),
			53 => array('old_cat_name' => 'Badvorleger & Duschvorhänge', 'new_cat_name' => 'Badaccessoires'),
			54 => array('old_cat_name' => 'Handtücher & Bademäntel', 'new_cat_name' => 'Badaccessoires'),
			55 => array('old_cat_name' => 'Badaccessoires', 'new_cat_name' => 'Badaccessoires'),
			56 => array('old_cat_name' => 'Badezimmerleuchten', 'new_cat_name' => 'Licht'),
			57 => array('old_cat_name' => 'Sauna & Wellness', 'new_cat_name' => 'Bad'),
			58 => array('old_cat_name' => 'Ordnung & Kleinaufbewahrung', 'new_cat_name' => 'Schränke & Vitrinen'),
			59 => array('old_cat_name' => 'Bürotische', 'new_cat_name' => 'Tische'),
			60 => array('old_cat_name' => 'Bürostühle', 'new_cat_name' => 'Stühle'),
			61 => array('old_cat_name' => 'Büroregale', 'new_cat_name' => 'Regale'),
			62 => array('old_cat_name' => 'Büroschränke', 'new_cat_name' => 'Schränke & Vitrinen'),
			63 => array('old_cat_name' => 'Container', 'new_cat_name' => 'Schränke & Vitrinen'),
			64 => array('old_cat_name' => 'Sekretäre', 'new_cat_name' => 'Schränke & Vitrinen'),
			65 => array('old_cat_name' => 'Büromöbel Sets', 'new_cat_name' => 'Schränke & Vitrinen'),
			66 => array('old_cat_name' => 'Schreibtischleuchten', 'new_cat_name' => 'Licht'),
			67 => array('old_cat_name' => 'Garderoben Sets', 'new_cat_name' => 'Wohnaccessoires'),
			68 => array('old_cat_name' => 'Garderobenschränke', 'new_cat_name' => 'Schränke & Vitrinen'),
			69 => array('old_cat_name' => 'Schuhschränke', 'new_cat_name' => 'Schränke & Vitrinen'),
			70 => array('old_cat_name' => 'Garderobenpaneele', 'new_cat_name' => 'Wohnaccessoires'),
			71 => array('old_cat_name' => 'Garderobenleisten & Haken', 'new_cat_name' => 'Wohnaccessoires'),
			72 => array('old_cat_name' => 'Kleiderständer', 'new_cat_name' => 'Wohnaccessoires'),
			73 => array('old_cat_name' => 'Dielenkommoden', 'new_cat_name' => 'Wohnaccessoires'),
			74 => array('old_cat_name' => 'Garderobenbänke & Hocker', 'new_cat_name' => 'Bänke'),
			75 => array('old_cat_name' => 'Konsolentische', 'new_cat_name' => 'Tische'),
			76 => array('old_cat_name' => 'Garderobenspiegel', 'new_cat_name' => 'Wohnaccessoires'),
			77 => array('old_cat_name' => 'Truhen', 'new_cat_name' => 'Schränke & Vitrinen'),
			78 => array('old_cat_name' => 'Schlüsselkästen & Ablagen', 'new_cat_name' => 'Wohnaccessoires'),
			79 => array('old_cat_name' => 'Schirmständer', 'new_cat_name' => 'Wohnaccessoires'),
			80 => array('old_cat_name' => 'Babyzimmer', 'new_cat_name' => 'Kinderzimmer'),
			81 => array('old_cat_name' => 'Kinderzimmer', 'new_cat_name' => 'Kinderzimmer'),
			82 => array('old_cat_name' => 'Jugendzimmer', 'new_cat_name' => 'Kinderzimmer'),
			83 => array('old_cat_name' => 'Bartische', 'new_cat_name' => 'Tische'),
			84 => array('old_cat_name' => 'Barhocker & Barstühle', 'new_cat_name' => 'Stühle'),
			85 => array('old_cat_name' => 'Barsets', 'new_cat_name' => 'Wohnaccessoires'),
			86 => array('old_cat_name' => 'Barschränke', 'new_cat_name' => 'Schränke und Stauräume'),
			87 => array('old_cat_name' => 'Buffets & Schränke', 'new_cat_name' => 'Schränke und Stauräume'),
			88 => array('old_cat_name' => 'Küchenregale', 'new_cat_name' => 'Schränke und Stauräume'),
			89 => array('old_cat_name' => 'Küchentische', 'new_cat_name' => 'Tische'),
			90 => array('old_cat_name' => 'Küchenstühle', 'new_cat_name' => 'Stühle'),
			91 => array('old_cat_name' => 'Sitzbänke', 'new_cat_name' => 'Sitzmöbel'),
			92 => array('old_cat_name' => 'Küche', 'new_cat_name' => 'Küche'),
			93 => array('old_cat_name' => 'Lampen', 'new_cat_name' => 'Licht'),
			94 => array('old_cat_name' => 'Spa', 'new_cat_name' => 'Bad'),
			95 => array('old_cat_name' => 'Teppich', 'new_cat_name' => 'Boden'),
			96 => array('old_cat_name' => 'Tisch', 'new_cat_name' => 'Tische'),
			97 => array('old_cat_name' => 'Spiegel', 'new_cat_name' => 'Wohnaccessoires'),
			98 => array('old_cat_name' => 'Apothekerschrank', 'new_cat_name' => 'Schränke & Vitrinen'),
		);
		
		//update brandreferences & category_product
		foreach ($category_mapping_strings as $index => $item ) {
			$old_cat_ID = DB::table('categories')->where(array('name'=> $item['old_cat_name'], ))->whereNotIn('id', $new_categories_ids)->first();

			$new_cat_ID = DB::table('categories')->where('name', $item['new_cat_name'])->whereIn('id', $new_categories_ids)->first();
			
			if (!empty($old_cat_ID) AND !empty($new_cat_ID) AND !empty($old_cat_ID->id) AND !empty($new_cat_ID->id)) {
				$changed_rows = DB::update('update brandreferences set category_id = '.$new_cat_ID->id.' where category_id = ?', [$old_cat_ID->id]);	
				$changed_rows = DB::update('update category_product set category_id = '.$new_cat_ID->id.' where category_id = ?', [$old_cat_ID->id]);
			}
		}
		
        //create intermediate table
        Schema::create('category_store', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->integer('store_id')->unsigned();
			$table->longText('value');
			$table->timestamp('created_at')->nullable()->default(NULL);
			$table->timestamp('updated_at')->nullable()->default(NULL);
			
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
			$table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
		});		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		$category_mapping_strings = array(
			0 => array('old_cat_name' => 'Beds and Sofas', 'new_cat_name' => 'Betten'),
			1 => array('old_cat_name' => 'Sofas & Couches', 'new_cat_name' => 'Sofas'),
			2 => array('old_cat_name' => 'Sessel', 'new_cat_name' => 'Sessel'),
			3 => array('old_cat_name' => 'Couch & Beistelltische', 'new_cat_name' => 'Coffetables'),
			4 => array('old_cat_name' => 'Kommoden & Sideboards', 'new_cat_name' => 'Sideboards'),
			5 => array('old_cat_name' => 'Regale', 'new_cat_name' => 'Regale'),
			6 => array('old_cat_name' => 'TV & Mediamöbel', 'new_cat_name' => 'Schränke & Vitrinen'),
			7 => array('old_cat_name' => 'Wohnwände', 'new_cat_name' => 'Schränke & Vitrinen'),
			8 => array('old_cat_name' => 'Schränke & Vitrinen', 'new_cat_name' => 'Schränke & Vitrinen'),
			9 => array('old_cat_name' => 'Polsterhocker', 'new_cat_name' => 'Polstermöbel'),
			10 => array('old_cat_name' => 'Kamine & Zubehör', 'new_cat_name' => 'Wohnaccessoires'),
			11 => array('old_cat_name' => 'Einzelsessel', 'new_cat_name' => 'Sessel'),
			12 => array('old_cat_name' => 'Beistelltische', 'new_cat_name' => 'Coffetables'),
			13 => array('old_cat_name' => 'Sideboards', 'new_cat_name' => 'Sideboards'),
			14 => array('old_cat_name' => 'Beistellregale', 'new_cat_name' => 'Regale'),
			15 => array('old_cat_name' => 'TV-Wände', 'new_cat_name' => 'Regale'),
			16 => array('old_cat_name' => 'Massive Wohnwände', 'new_cat_name' => 'Schränke & Vitrinen'),
			17 => array('old_cat_name' => 'Bar & Weinschränke', 'new_cat_name' => 'Schränke & Vitrinen'),
			18 => array('old_cat_name' => 'Fußablagen', 'new_cat_name' => 'Wohnaccessoires'),
			19 => array('old_cat_name' => 'Elektrokamine', 'new_cat_name' => 'Wohnaccessoires'),
			20 => array('old_cat_name' => 'Ohrensessel', 'new_cat_name' => 'Sessel'),
			21 => array('old_cat_name' => 'Esstische', 'new_cat_name' => 'Tische'),
			22 => array('old_cat_name' => 'Esszimmerstühle', 'new_cat_name' => 'Stühle'),
			23 => array('old_cat_name' => 'Essgruppen', 'new_cat_name' => 'Esszimmer'),
			24 => array('old_cat_name' => 'Servierwagen', 'new_cat_name' => 'Wohnaccessoires'),
			25 => array('old_cat_name' => 'Armlehnstühle', 'new_cat_name' => 'Stühle'),
			26 => array('old_cat_name' => 'Eckbänke', 'new_cat_name' => 'Bänke'),
			27 => array('old_cat_name' => 'Freischwinger', 'new_cat_name' => 'Sessel'),
			28 => array('old_cat_name' => 'Einfache Sitzbänke', 'new_cat_name' => 'Bänke'),
			29 => array('old_cat_name' => 'Holzstühle', 'new_cat_name' => 'Stühle'),
			30 => array('old_cat_name' => 'Holzbänke', 'new_cat_name' => 'Bänke'),
			31 => array('old_cat_name' => 'Polsterstühle', 'new_cat_name' => 'Stühle'),
			32 => array('old_cat_name' => 'Polsterbänke', 'new_cat_name' => 'Bänke'),
			33 => array('old_cat_name' => 'Kleiderschränke', 'new_cat_name' => 'Schränke & Vitrinen'),
			34 => array('old_cat_name' => 'Betten', 'new_cat_name' => 'Betten'),
			35 => array('old_cat_name' => 'Matratzen', 'new_cat_name' => 'Betten'),
			36 => array('old_cat_name' => 'Lattenroste', 'new_cat_name' => 'Betten'),
			37 => array('old_cat_name' => 'Nachttische & Kommoden', 'new_cat_name' => 'Schlafzimmer'),
			38 => array('old_cat_name' => 'Schlafzimmersets', 'new_cat_name' => 'Schlafzimmer'),
			39 => array('old_cat_name' => 'Hocker & Bänke', 'new_cat_name' => 'Bänke'),
			40 => array('old_cat_name' => 'Schlafsofas', 'new_cat_name' => 'Sofas'),
			41 => array('old_cat_name' => 'Schminktische', 'new_cat_name' => 'Tische'),
			42 => array('old_cat_name' => 'Truhen', 'new_cat_name' => 'Schränke & Vitrinen'),
			43 => array('old_cat_name' => 'Paravents', 'new_cat_name' => 'Wohnaccessoires'),
			44 => array('old_cat_name' => 'Kissen & Bettdecken', 'new_cat_name' => 'Wohnaccessoires'),
			45 => array('old_cat_name' => 'Bettwäsche', 'new_cat_name' => 'Wohnaccessoires'),
			46 => array('old_cat_name' => 'Badezimmer Sets', 'new_cat_name' => 'Bad'),
			47 => array('old_cat_name' => 'Badschränke', 'new_cat_name' => 'Badmöbel'),
			48 => array('old_cat_name' => 'Waschplätze', 'new_cat_name' => 'Bad'),
			49 => array('old_cat_name' => 'Badregale', 'new_cat_name' => 'Badmöbel'),
			50 => array('old_cat_name' => 'Gästebäder', 'new_cat_name' => 'Bad'),
			51 => array('old_cat_name' => 'Badspiegel', 'new_cat_name' => 'Badaccessoires'),
			52 => array('old_cat_name' => 'Sanitär & Hygiene', 'new_cat_name' => 'Bad'),
			53 => array('old_cat_name' => 'Badvorleger & Duschvorhänge', 'new_cat_name' => 'Badaccessoires'),
			54 => array('old_cat_name' => 'Handtücher & Bademäntel', 'new_cat_name' => 'Badaccessoires'),
			55 => array('old_cat_name' => 'Badaccessoires', 'new_cat_name' => 'Badaccessoires'),
			56 => array('old_cat_name' => 'Badezimmerleuchten', 'new_cat_name' => 'Licht'),
			57 => array('old_cat_name' => 'Sauna & Wellness', 'new_cat_name' => 'Bad'),
			58 => array('old_cat_name' => 'Ordnung & Kleinaufbewahrung', 'new_cat_name' => 'Schränke & Vitrinen'),
			59 => array('old_cat_name' => 'Bürotische', 'new_cat_name' => 'Tische'),
			60 => array('old_cat_name' => 'Bürostühle', 'new_cat_name' => 'Stühle'),
			61 => array('old_cat_name' => 'Büroregale', 'new_cat_name' => 'Regale'),
			62 => array('old_cat_name' => 'Büroschränke', 'new_cat_name' => 'Schränke & Vitrinen'),
			63 => array('old_cat_name' => 'Container', 'new_cat_name' => 'Schränke & Vitrinen'),
			64 => array('old_cat_name' => 'Sekretäre', 'new_cat_name' => 'Schränke & Vitrinen'),
			65 => array('old_cat_name' => 'Büromöbel Sets', 'new_cat_name' => 'Schränke & Vitrinen'),
			66 => array('old_cat_name' => 'Schreibtischleuchten', 'new_cat_name' => 'Licht'),
			67 => array('old_cat_name' => 'Garderoben Sets', 'new_cat_name' => 'Wohnaccessoires'),
			68 => array('old_cat_name' => 'Garderobenschränke', 'new_cat_name' => 'Schränke & Vitrinen'),
			69 => array('old_cat_name' => 'Schuhschränke', 'new_cat_name' => 'Schränke & Vitrinen'),
			70 => array('old_cat_name' => 'Garderobenpaneele', 'new_cat_name' => 'Wohnaccessoires'),
			71 => array('old_cat_name' => 'Garderobenleisten & Haken', 'new_cat_name' => 'Wohnaccessoires'),
			72 => array('old_cat_name' => 'Kleiderständer', 'new_cat_name' => 'Wohnaccessoires'),
			73 => array('old_cat_name' => 'Dielenkommoden', 'new_cat_name' => 'Wohnaccessoires'),
			74 => array('old_cat_name' => 'Garderobenbänke & Hocker', 'new_cat_name' => 'Bänke'),
			75 => array('old_cat_name' => 'Konsolentische', 'new_cat_name' => 'Tische'),
			76 => array('old_cat_name' => 'Garderobenspiegel', 'new_cat_name' => 'Wohnaccessoires'),
			77 => array('old_cat_name' => 'Truhen', 'new_cat_name' => 'Schränke & Vitrinen'),
			78 => array('old_cat_name' => 'Schlüsselkästen & Ablagen', 'new_cat_name' => 'Wohnaccessoires'),
			79 => array('old_cat_name' => 'Schirmständer', 'new_cat_name' => 'Wohnaccessoires'),
			80 => array('old_cat_name' => 'Babyzimmer', 'new_cat_name' => 'Kinderzimmer'),
			81 => array('old_cat_name' => 'Kinderzimmer', 'new_cat_name' => 'Kinderzimmer'),
			82 => array('old_cat_name' => 'Jugendzimmer', 'new_cat_name' => 'Kinderzimmer'),
			83 => array('old_cat_name' => 'Bartische', 'new_cat_name' => 'Tische'),
			84 => array('old_cat_name' => 'Barhocker & Barstühle', 'new_cat_name' => 'Stühle'),
			85 => array('old_cat_name' => 'Barsets', 'new_cat_name' => 'Wohnaccessoires'),
			86 => array('old_cat_name' => 'Barschränke', 'new_cat_name' => 'Schränke und Stauräume'),
			87 => array('old_cat_name' => 'Buffets & Schränke', 'new_cat_name' => 'Schränke und Stauräume'),
			88 => array('old_cat_name' => 'Küchenregale', 'new_cat_name' => 'Schränke und Stauräume'),
			89 => array('old_cat_name' => 'Küchentische', 'new_cat_name' => 'Tische'),
			90 => array('old_cat_name' => 'Küchenstühle', 'new_cat_name' => 'Stühle'),
			91 => array('old_cat_name' => 'Sitzbänke', 'new_cat_name' => 'Sitzmöbel'),
			92 => array('old_cat_name' => 'Küche', 'new_cat_name' => 'Küche'),
			93 => array('old_cat_name' => 'Lampen', 'new_cat_name' => 'Licht'),
			94 => array('old_cat_name' => 'Spa', 'new_cat_name' => 'Bad'),
			95 => array('old_cat_name' => 'Teppich', 'new_cat_name' => 'Boden'),
			96 => array('old_cat_name' => 'Tisch', 'new_cat_name' => 'Tische'),
			97 => array('old_cat_name' => 'Spiegel', 'new_cat_name' => 'Wohnaccessoires'),
			98 => array('old_cat_name' => 'Apothekerschrank', 'new_cat_name' => 'Schränke & Vitrinen'),
		);
		
		//update brandreferences & category_product
		foreach ($category_mapping_strings as $index => $item ) {
			$old_cat_ID = DB::table('categories')->where(array('name'=> $item['old_cat_name'], ))->orderBy('created_at', 'asc')->first();

			$new_cat_ID = DB::table('categories')->where('name', $item['new_cat_name'])->orderBy('created_at', 'desc')->first();
			
			if (!empty($old_cat_ID) AND !empty($new_cat_ID) AND !empty($old_cat_ID->id) AND !empty($new_cat_ID->id)) {
				$changed_rows = DB::update('update brandreferences set category_id = '.$old_cat_ID->id.' where category_id = ?', [$new_cat_ID->id]);	
				$changed_rows = DB::update('update category_product set category_id = '.$old_cat_ID->id.' where category_id = ?', [$new_cat_ID->id]);
			}
		}
		
		Schema::drop('category_store');
    }
}
