<?php

use Illuminate\Database\Seeder;
use App\User;
use APP\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = Role::find(3);
        $server = Role::find(2);
        $customer = Role::find(1);
        $faker = Faker\Factory::create();
        for($i = 0; $i < 5; $i++)
        {
            
            $thisUser = new User;
            $thisUser->name = $faker->name;
            $thisUser->email = $faker->unique()->email;
            $thisUser->password = bcrypt("123456");
            $thisUser->api_token = str_random(60);
            $thisUser->save();
            $thisUser->roles()->attach($owner);
        }

        for($i = 0; $i < 20; $i++)
        {
            $thisUser = new User;
            $thisUser->name = $faker->name;
            $thisUser->email = $faker->unique()->email;
            $thisUser->password = bcrypt("123456");
            $thisUser->api_token = str_random(60);
            $thisUser->save();
            $thisUser->roles()->attach($server);
        }

        for($i = 0; $i < 100; $i++)
        {
            $thisUser = new User;
            $thisUser->name = $faker->name;
            $thisUser->email = $faker->unique()->email;
            $thisUser->password = bcrypt("123456");
            $thisUser->api_token = str_random(60);
            $thisUser->save();
            $thisUser->roles()->attach($customer);
        }
    }
}
