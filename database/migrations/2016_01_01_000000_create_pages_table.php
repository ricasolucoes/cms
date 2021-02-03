<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Cms\Models\Negocios\Page;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create(
            'pages', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('author_id');
                $table->string('title');
                $table->string('url')->nullable();
                $table->string('slug')->nullable();
                $table->text('entry')->nullable();
                $table->string('seo_description')->nullable();
                $table->string('seo_keywords')->nullable();
                $table->boolean('is_published')->default(0);
                $table->text('excerpt')->nullable();
                $table->text('body')->nullable();
                $table->string('image')->nullable();
                $table->text('meta_description')->nullable();
                $table->text('meta_keywords')->nullable();
    
                $table->text('blocks')->nullable();
                $table->string('hero_image')->nullable();

                // Translation
                $table->string('language_code');
                $table->string('country_code')->nullable();
                $table->foreign('language_code')->references('code')->on('languages');
                $table->foreign('country_code')->references('code')->on('countries');
    
                $table->dateTime('published_at')->nullable();

                $table->enum('status', Page::$statuses)->default(Page::STATUS_INACTIVE);
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
