<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'verified'=>$verified=$faker->randomElement([User::VERIFIED_USER,User::UNVERIFIED_USER]),
        'verified_token'=>$verified==User::VERIFIED_USER? null: User::generateVerificationCode(),
        'admin'=>$verified=$faker->randomElement([User::ADMIN_USER,User::REGULAR_USER]),
    ];
});
$factory->define(\App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
    ];
});
$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity'=>$faker->numberBetween(1,10),
        'status'=>$faker->randomElement([\App\Product::AVAILABLE_PRODUCT,\App\Product::UNAVAILABLE_PRODUCT]),
        'image'=>$faker->randomElement(['me.jpg','cxeni.jpg','3.png']),
        'seller_id'=>User::all()->random()->id,
    ];
});
$factory->define(\App\Transaction::class, function (Faker $faker) {
    $seller = \App\Seller::has('products')->get()->random();
    $buyer = \App\Buyer::all()->except($seller->id)->random();
    return [

        'quantity'=>$faker->numberBetween(1,10),
       'buyer_id'=>$buyer->id,
       'product_id'=>$seller->products->random()->id,
    ];
});






