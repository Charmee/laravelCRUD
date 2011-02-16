<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $firstname = array(
            'fan',
            'refrigerator',
            'bulb',
            'table',
            'chair',
           
        );
        $name = $firstname[rand ( 0 , count($firstname) -1)];
    
    	foreach (range(1,1) as $index) {
            DB::table('products')->insert([
                'name' =>$name,  
                'quantity' => 2,
                'rate' => 20,
                'product_type' =>'flat',
                'discount' => 0,
                'amount' => 40,
                'userid'=>1,
                'created_at' => date("Y-m-d H:i:s", strtotime('now')),
                'updated_at'=>date("Y-m-d H:i:s", strtotime('now'))

            ]);
        }
        foreach (range(1,1) as $index) {
            DB::table('users')->insert([
                'name' =>$faker->name,  
                'username' =>$faker->name ,
                'email' =>$faker->email,
                'password' =>bcrypt("krishnaradha"),
                'phone' => 9867845678,
                'created_at' => date("Y-m-d H:i:s", strtotime('now')),
                'updated_at'=>date("Y-m-d H:i:s", strtotime('now'))

            ]);
        }
        // \App\Models\User::factory(10)->create();
    }
}
