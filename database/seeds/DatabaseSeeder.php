<?php

use Illuminate\Database\Seeder;
use App\Models\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Unguard
         */
        Model::unguard();

        /**
         * System
         */
        // $this->call(SystemRolesTableSeeder::class);
        // $this->call(SystemUserTableSeeder::class);
        // $this->command->info('Admin User created with username admin@admin.com and password admin');
        // $this->command->info('Test User created with username user@user.com and password user');
        // $this->call(SystemLanguageTableSeeder::class);
        

        /**
         * Features
         */

        $this->call(CalendarSeeder::class);

        $this->call(CmsSeeder::class);

        $this->call(CommerceSeeder::class);
        
        $this->call(MidiaPhotoSeeder::class);

        $this->call(BlogArticleSeeder::class);
        
		// $this->call(WritelabelCardSeeder::class);
        $this->call(WritelabelPageSeeder::class);

        $this->call(TravelsSeeder::class);

        /**
         * Reguard
         */
        Model::reguard();
    }
}
