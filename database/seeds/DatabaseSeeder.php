<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        // $this->call(UserSeeder::class);
        \App\User::truncate();
        \App\Category::truncate();
        \App\Product::truncate();
        \App\Transaction::truncate();
       DB::table('category_product')->truncate();

       $usersQuantity =200;
       $category =30;
       $products =1000;
       $transactions=1000;

       factory(\App\User::class,$usersQuantity)->create();
       factory(\App\Category::class,$category)->create();
       factory(\App\Product::class,$products)->create()->each(function ($products){
        $categories = \App\Category::all()->random(mt_rand(1,5));

        $products->categories()->attach($categories);
       });
       factory(\App\Transaction::class,$transactions)->create();

    }
}
