<?php

use Illuminate\Database\Seeder;

class UserinforTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0 ; $i < 5; $i++){
        	$fullname = $faker->text(10);
            DB::table('userinfo')->insert([
                'user_id'  => 1,
                'fullname'  => $fullname,
                'address'  => $faker->text(30),
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
