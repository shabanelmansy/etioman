<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	$role_user = Role::where('name','User')->first(); 
    	$role_admin =  Role::where('name','Admin')->first(); 
    	$role_manager =  Role::where('name','Manager')->first(); 
        //
        $user = new User();
        $user->name = 'shaban';
        $user->email= 'shaban@yahoo.com';
        $user->password = bcrypt('123123');
        $user->save();
        $user->roles()->attach($role_user);



         
        $admin = new User();
        $admin->name = 'ahmed';
        $admin->email= 'ahmed@yahoo.com';
        $admin->password = bcrypt('123123');
        $admin->save();
        $admin->roles()->attach($role_admin);



        $manager = new User();
        $manager->name = 'mohamed';
        $manager->email= 'mohamed@yahoo.com';
        $manager->password = bcrypt('123123');
        $manager->save();
        $manager->roles()->attach($role_manager);







    }
}
