<?php

/** @var Factory $factory */

use App\Contact;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'topic' => $faker->title,
        'message' => $faker->text,
        'file' => $faker->monthName,
        'status' => 0,
        'user_id' => factory(User::class),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
