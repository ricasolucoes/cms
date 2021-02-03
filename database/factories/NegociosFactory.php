<?php

/*
|--------------------------------------------------------------------------
| Subscription Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Cms\Models\Negocios\Subscription::class, function (Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'token' => \Illuminate\Support\Str::random(64),
    ];
});

/*
|--------------------------------------------------------------------------
| Faq Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Cms\Models\Negocios\Faq::class, function (Faker\Generator $faker) {
    return [
        'question'        => $faker->sentence,
        'answer'         => $faker->paragraph(60),
        'is_published' => 1,
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});


/*
|--------------------------------------------------------------------------
| Links Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Cms\Models\Negocios\Link::class, function (Faker\Generator $faker) {
    return [
        'name' => 'dumb',
        'external' => 1,
        'page_id' => 0,
        'menu_id' => 1,
        'external_url' => 'http://facebook.com',
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),

    ];
});


/*
|--------------------------------------------------------------------------
| Page Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Cms\Models\Negocios\Page::class, function (Faker\Generator $faker) {
    return [
        'title' => 'dumb',
        'url' => 'dumb',
        'seo_keywords' => 'dumb, dumber',
        'seo_description' => 'dumb is dumb',
        'entry' => $faker->paragraph().' '.$faker->paragraph(),
        'is_published' => 1,
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});


/*
|--------------------------------------------------------------------------
| Menu Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Cms\Models\Negocios\Menu::class, function (Faker\Generator $faker) {
    return [
        'name' => 'dumb menu',
        'slug' => 'testerSLUG',
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),

    ];
});


/*
|--------------------------------------------------------------------------
| Promotion Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Cms\Models\Negocios\Promotion::class, function (Faker\Generator $faker) {
    return [
        'published_at' => $faker->datetime()->format('Y-m-d H:i'),
        'finished_at' => $faker->datetime()->format('Y-m-d H:i'),
        'slug' => 'dumb',
        'details' => $faker->paragraph().' '.$faker->paragraph(),
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});


/*
|--------------------------------------------------------------------------
| Widget Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Cms\Models\Negocios\Widget::class, function (Faker\Generator $faker) {
    return [
        'name' => 'test',
        'slug' => 'tester',
        'content' => implode(' ', $faker->paragraphs(3)),
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});
