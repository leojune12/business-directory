<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Users\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Modules\Businesses\Entities\Business;
use Modules\Categories\Entities\Category;
use Modules\Product\Entities\Product;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        app()['cache']->forget('spatie.permission.cache');

        if (!User::find(1)) {

            $admin = User::firstOrCreate([
                "first_name" => "Admin",
                "last_name" => "Admin",
                "email" => "admin@test.com",
                "email_verified_at" => now(),
                "password" => Hash::make("pw@12345"),
                "remember_token" => Str::random(10),
            ]);

            $admin->assignRole('Admin');
        }

        $categories = Category::factory(10)->create();

        User::factory(50)->create()->each(function($user) use($categories) {

            $role = Arr::random(["owner", "customer"]);

            $user->assignRole($role);

            if ($role == "owner") {

                // Create Business
                Business::factory(2)->create([
                    'user_id' => $user->id
                ])->each(function($business) use($categories) {
                    // Add Category
                    $business->categories()->attach($categories->random(2));
                    // Add Product
                    Product::factory(3)->create([
                        'business_id' => $business->id
                    ]);
                });
            }
        });
    }
}
