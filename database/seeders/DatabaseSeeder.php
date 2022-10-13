<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Categories\Database\Seeders\CategoriesDatabaseSeeder;
use Modules\Roles\Database\Seeders\RolesDatabaseSeeder;
use Modules\Subcategory\Database\Seeders\SubcategoryDatabaseSeeder;
use Modules\Users\Database\Seeders\UsersDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesDatabaseSeeder::class,
            CategoriesDatabaseSeeder::class,
            SubcategoryDatabaseSeeder::class,
            UsersDatabaseSeeder::class,
        ]);
    }
}
