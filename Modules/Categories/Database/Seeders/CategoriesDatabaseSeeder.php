<?php

namespace Modules\Categories\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\Entities\Category;

class CategoriesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Category::factory(30)->create();

        $categories = [
            'Business Services',
            'Computers & Internet',
            'Entertainment & Media',
            'Events & Conferences',
            'Finances & Insurance',
            'Food & Drink',
            'Health & Beauty',
            'Legal',
            'Manufacturing & Industry',
            'Shopping',
            'Tourism & Accommodation',
            'Tradesmen & Construction',
            'Transport & Motoring',
            'Public & Social Services',
            'Property',
        ];

        foreach ($categories as $category) {

            $category = Category::create([
                'name' => $category
            ]);
        }
    }
}
