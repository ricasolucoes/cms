<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ScopeForBusinessInTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('analytics') && ! Schema::hasColumn('analytics', 'business_code')) {
            Schema::table('analytics', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('blogs') && ! Schema::hasColumn('blogs', 'business_code')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('posts') && ! Schema::hasColumn('posts', 'business_code')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('articles') && ! Schema::hasColumn('articles', 'business_code')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('pages') && ! Schema::hasColumn('pages', 'business_code')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('menus') && ! Schema::hasColumn('menus', 'business_code')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('promotions') && ! Schema::hasColumn('promotions', 'business_code')) {
            Schema::table('promotions', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('widgets') && ! Schema::hasColumn('widgets', 'business_code')) {
            Schema::table('widgets', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('cards') && ! Schema::hasColumn('cards', 'business_code')) {
            Schema::table('cards', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('user_meta') && ! Schema::hasColumn('user_meta', 'business_code')) {
            Schema::table('user_meta', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('products') && ! Schema::hasColumn('products', 'business_code')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
            });
        }
        if (Schema::hasTable('settings') && ! Schema::hasColumn('settings', 'business_code')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');

                $table->unique(['setting_key', 'business_code']);
            });
        }
        if (Schema::hasTable('followables') && ! Schema::hasColumn('followables', 'business_code')) {
            Schema::table('followables', function (Blueprint $table) {
                $table->string('business_code');
                $table->foreign('business_code')->references('code')->on('businesses');
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
    }
}
