<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = Role::where('slug', 'manager')->first();
        $client = Role::where('slug','client')->first();
        $manageUsers = Permission::where('slug','manage-users')->first();
        $createRequests = Permission::where('slug','create-request')->first();

        $user1 = new User();
        $user1->name = 'Manager';
        $user1->email = 'manager@gmail.com';
        $user1->password = bcrypt('secret');
        $user1->last_topic = 0;
        $user1->save();
        $user1->roles()->attach($manager);
        $user1->permissions()->attach($manageUsers);

    }
}
