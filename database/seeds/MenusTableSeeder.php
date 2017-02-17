<?php

use Illuminate\Database\Seeder;
use App\MenuCategory;
use App\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menucategories = MenuCategory::all();
        $faker = Faker\Factory::create();

        foreach($menucategories as $menucategory)
        {
        	for($i = 0; $i < 10; $i++)
        	{
	        	$menucategory->menus()->create([
	        		'name' => $faker->word,
                    'description' => $faker->sentence,
                    'price' => $faker->randomFloat(2, 0, 30)
	        	]);
	        }
        }
    }
}
