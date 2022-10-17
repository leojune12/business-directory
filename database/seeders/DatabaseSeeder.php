<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Roles\Database\Seeders\RolesDatabaseSeeder;
use Modules\Users\Database\Seeders\UsersDatabaseSeeder;
use Modules\Address\Database\Seeders\AddressDatabaseSeeder;
use Modules\Categories\Database\Seeders\CategoriesDatabaseSeeder;
use Modules\Subcategory\Database\Seeders\SubcategoryDatabaseSeeder;

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
            AddressDatabaseSeeder::class,
            UsersDatabaseSeeder::class,
        ]);
    }
}
