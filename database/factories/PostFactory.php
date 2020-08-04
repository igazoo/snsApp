<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;
use App\User;
use Illuminate\Support\Str;


$factory->define(Post::class, function (Faker $faker) {


    return [
        //
        'image' => $faker->image('public/storage/images',640,480, null, false),
        'content' => $faker->word(),
        'user_id' => factory(App\User::class),
    ];
});
