<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $admin=User::create([
       	'name'=>'Ko Ko',
       	'profile'=>'images/user/admin.jpeg',
       	'email'=>'admin@gmail.com' ,
       	'password'=>Hash::make('123456789'),
       	'phone'=>'09788870027',
       	'address'=>'Yangon',
       ]);
         $admin->assignRole('admin');

          $customer=User::create([
       	'name'=>'atzm','profile'=>'images/user/c.png',
       	'email'=>'atzm@gmail.com' ,
       	'password'=>Hash::make('123456789'),
       	'phone'=>'09788870027',
       	'address'=>'Yangon',




       ]);
           $customer->assignRole('customer');
      
    }
}
