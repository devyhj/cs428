<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
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
        $restaurants = Restaurant::all();
        $faker = Faker\Factory::create();

        foreach($restaurants as $restaurant)
        {
        	for($i = 0; $i < 10; $i++)
        	{
	        	$restaurant->menus()->create([
	        		'name' => $faker->word,
	        		'description' => $faker->sentence,
	        		'price' => $faker->randomFloat(2, 0, 30)
	        	]);
	        }
        }
    }
}
