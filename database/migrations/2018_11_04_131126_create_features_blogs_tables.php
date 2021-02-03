<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesBlogsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('entry')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('is_published')->default(0);
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('url');
            $table->dateTime('published_at')->nullable();
            $table->string('template')->default('show');
            $table->text('blocks')->nullable();
            $table->string('hero_image')->nullable();

            $table->string('name')->index();
            $table->string('slug')->index();
            $table->text('description');
            $table->string('cover');
            $table->integer('user_id')->unsigned()->default(0)->index();
            $table->integer('article_count')->unsigned()->default(0);
            $table->integer('subscriber_count')->unsigned()->default(0);
            $table->tinyInteger('is_recommended')->unsigned()->default(0);
            $table->tinyInteger('is_blocked')->unsigned()->default(0);

            // Translation
            $table->string('language_code');
            $table->string('country_code')->nullable();
            $table->foreign('language_code')->references('code')->on('languages');
            $table->foreign('country_code')->references('code')->on('countries');

            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            
            $table->string('slug');
			$table->text('introduction');
			$table->text('content');
			$table->string('source')->nullable();
			$table->string('picture')->nullable();
            $table->boolean('is_published')->default(false);
			$table->integer('position')->nullable();
            
			$table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            
			$table->unsignedInteger('user_id_edited')->nullable();
            $table->foreign('user_id_edited')->references('id')->on('users')->onDelete('set null');
            
			$table->unsignedInteger('category_id')->nullable();
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
	
            // Translation
            $table->string('language_code');
            $table->string('country_code')->nullable();
            $table->foreign('language_code')->references('code')->on('languages');
            $table->foreign('country_code')->references('code')->on('countries');
            
			$table->timestamps();
            $table->softDeletes();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('blogs');
    }
}
