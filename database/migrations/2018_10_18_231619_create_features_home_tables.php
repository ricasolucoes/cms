<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesHomeTables extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('contacts')) {
            Schema::create('contacts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('site');
                $table->string('email');
                $table->string('name');
                $table->string('subject');
                $table->text('text')->nullable();
                $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        if (!Schema::hasTable('menus')) {
            Schema::create('menus', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('slug');
                $table->string('value');
                $table->integer('user_id')->unsigned()->nullable();
                $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->nullableTimestamps();
                $table->softDeletes();
            });
        }
        if (!Schema::hasTable('links')) {
            Schema::create('links', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->boolean('external')->default(0);
                $table->integer('page_id');
                $table->integer('menu_id');
                $table->string('external_url')->nullable();
                $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->nullableTimestamps();
                $table->softDeletes();
            });
        }
        if (!Schema::hasTable('faqs')) {
            Schema::create('faqs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('question');
                $table->text('answer');
                $table->boolean('is_published')->default(0);
                $table->dateTime('published_at')->nullable();
                $table->string('business_code');
                // $table->foreign('business_code')->references('code')->on('businesses');
                $table->nullableTimestamps();
                $table->softDeletes();
            });

        }
        if (!Schema::hasTable('promotions')) {
            Schema::create('promotions', function (Blueprint $table) {
                $table->increments('id');
                $table->dateTime('published_at')->nullable();
                $table->dateTime('finished_at')->nullable();
                $table->string('slug');
                $table->text('details')->nullable();
                $table->nullableTimestamps();
                $table->softDeletes();
            });

        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('promotions');
        Schema::drop('contacts');
		Schema::drop('identity_girls');
	}

}
