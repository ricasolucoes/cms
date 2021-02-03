<?php

/*
|--------------------------------------------------------------------------
| Pages Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Casa\Models\Calendar\Event::class, function (Faker\Generator $faker) {
    return [
        'start_date' => '2016-10-31',
        'end_date' => '2016-10-31',
        'seo_keywords' => 'dumb, dumber',
        'seo_description' => 'dumb is dumb',
        'title' => 'dumb',
        'details' => $faker->paragraph().' '.$faker->paragraph(),
        'is_published' => 1,
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});
