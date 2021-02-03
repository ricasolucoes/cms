<?php

/*
|--------------------------------------------------------------------------
| Blog Factory
|--------------------------------------------------------------------------
*/

$factory->define(\Cms\Models\Blog\Blog::class, function (Faker\Generator $faker) {
    return [
        'title' => 'dumb',
        'entry' => $faker->paragraph().' '.$faker->paragraph(),
        'is_published' => 1,
        'url' => 'dumb',
        'updated_at' => $faker->datetime(),
        'created_at' => $faker->datetime(),
    ];
});


/*
|--------------------------------------------------------------------------
| Blog Outro Modulo
|--------------------------------------------------------------------------
*/

// $factory->define(App\Models\Blog\Article::class, function (Generator $faker) {
//     return [
//         'created_by_user_id' => (new User)->newQuery()->inRandomOrder()->firstOrFail()->id,
//         'description' => $faker->sentence,
//         'title'        => $faker->sentence,
//         'body'         => $faker->paragraph(30),
//         'user_id'      => rand(1, 10),
//         'category_id'  => rand(1, 10),
//         'is_published' => rand(0, 1),
//         'language_code' => rand(1, 3),
//         'category_id' => rand(1, 2),
//         'title' => $faker->sentence,
//         'slug' => $faker->slug,
//         'introduction' => $faker->paragraph,
//         'content' => $faker->text,
//         'source' => $faker->url,
//     ];
// });
// $factory->define(App\Models\Blog\Post::class, function (Generator $faker) {
//     return [
//         'created_by_user_id' => (new User)->newQuery()->inRandomOrder()->firstOrFail()->id,
//         'description' => $faker->sentence,
//         'title'        => $faker->sentence,
//         'body'         => $faker->paragraph(30),
//         'user_id'      => rand(1, 10),
//         'category_id'  => rand(1, 10),
//         'is_published' => rand(0, 1),
//         'language_code' => rand(1, 3),
//         'category_id' => rand(1, 2),
//         'title' => $faker->sentence,
//         'slug' => $faker->slug,
//         'introduction' => $faker->paragraph,
//         'content' => $faker->text,
//         'source' => $faker->url,
//     ];
// });


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Cms\Models\Blog\Category::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => $faker->slug,
    ];
});

/*
|--------------------------------------------------------------------------
| Blog Outro Modulo
|--------------------------------------------------------------------------
*/


$factory->define(Facilitador\Models\Comment::class, function (Generator $faker) {
    return [
        'user_id' => rand(1, 10),
        'post_id' => rand(1, 25),
        'body'    => $faker->paragraph
    ];
});
