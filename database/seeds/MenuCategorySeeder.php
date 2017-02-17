<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use App\MenuCategory;

class MenuCategorySeeder extends Seeder
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
        	for($i = 0; $i < 5; $i++)
        	{
	        	$restaurant->menuCategories()->create([
	        		'name' => $faker->word
	        	]);
	        }
        }
    }
}
