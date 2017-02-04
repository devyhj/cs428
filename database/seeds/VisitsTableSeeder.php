<?php

use Illuminate\Database\Seeder;
use App\Visit;
use App\Role;
use App\User;
use App\Restaurant;
use Carbon\Carbon;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $customerRole = Role::where('name', 'customer')->get();
        $customerRole->load('users');
       	$customers = $customerRole->first()->users;

        foreach($customers as $customer)
        {
        	$visit = new Visit;
        	$restaurant = Restaurant::all()->random();
        	$visit->start_time = $faker->dateTimeBetween($startDate = '-1 hours', $endDate = 'now', $timezone = 'America/Denver');
        	$visit->restaurant()->associate($restaurant);
        	$visit->user()->associate($customer);
        	$visit->save();
        }
    }
}
