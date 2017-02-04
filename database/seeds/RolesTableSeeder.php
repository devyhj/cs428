<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = new Role;
        $customer->name = 'customer';
        $customer->save();

        $server = new Role;
        $server->name = 'server';
        $server->save();

        $owner = new Role;
        $owner->name ='owner';
        $owner->save();

    }
}
