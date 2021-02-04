<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        // Schema::create('settings', function (Blueprint $table) {
        //     $table->engine = 'InnoDB';
        //     $table->string('code'); //->unique();
        //     // $table->primary('code');
        //     $table->string('value')->default(false);
        //     $table->string('business_code')->nullable();
        //     // $table->foreign('business_code')->references('code')->on('businesses');
        //     $table->timestamps();
        //     $table->softDeletes();
            
        //     $table->primary(['code', 'business_code']);
        // });

        Schema::create(
            'features', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('code')->unique();
                $table->primary('code');
                $table->string('name', 255);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'featureables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('featureable_id');
                $table->string('featureable_type', 255);
                $table->string('feature_code');
                $table->foreign('feature_code')->references('code')->on('features');
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
        Schema::dropIfExists('featureables');
        Schema::dropIfExists('features');
    }

}
