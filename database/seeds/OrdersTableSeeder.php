<?php

use Illuminate\Database\Seeder;
use App\Visit;
use App\MenuItem;
use App\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
        $visits = Visit::with('restaurant.menuCategories.menuItems')->get();
        foreach($visits as $visit)
        {
        	$orderCount = $faker->numberBetween(1, 5);
        	for($i = 0; $i < $orderCount; $i++)
        	{
	        	$availableMenu = $visit->restaurant->first()->menuCategories->random()->menuItems;
	        	$thisMenu = $availableMenu->random();
	        	$thisOrder = new Order;
	        	$thisOrder->special_request = $faker->sentence;
	        	$thisOrder->option_selected = $faker->word;
	        	$thisOrder->visit()->associate($visit);
	        	$thisOrder->menuItem()->associate($thisMenu);
	        	$thisOrder->save();
	        }
        }
    }
}
