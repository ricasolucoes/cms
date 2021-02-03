<?php
/*
|--------------------------------------------------------------------------
| Blog Outro Modulo
|--------------------------------------------------------------------------
*/

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'value' => strtolower($faker->word),
    ];
});