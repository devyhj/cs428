<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $ownerRole = Role::where('name', 'owner')->get();
        $ownerRole->load('users');
       	$owners = $ownerRole->first()->users;
       	foreach($owners as $owner)
       	{
       		$owner->restaurants()->create([
	       		'name' => $faker->unique()->company,
	       		'address_line1' => $faker->streetAddress,
	       		'address_line2' => $faker->secondaryAddress,
	       		'city' => $faker->city,
	       		'state' => $faker->state,
	       		'zip_code' => $faker->postcode
	       	]);
       	}
    }
}
