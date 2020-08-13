<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use Faker\Generator as Faker;


$factory->define(Reply::class, function (Faker $faker) {
    $user = App\User::orderByRaw('RAND()')->first();
    $conversation = App\Conversation::orderByRaw('RAND()')->first();

    return [
        'user_id' => $user->id,
        'conversation_id' => $conversation->id,
        'body' => $faker->sentence,
    ];
});
