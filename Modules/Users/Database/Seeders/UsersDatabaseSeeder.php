<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Users\Entities\User;
use Modules\Address\Entities\City;
use Illuminate\Support\Facades\Hash;
use Modules\Product\Entities\Product;
use Modules\Service\Entities\Service;
use Illuminate\Database\Eloquent\Model;
use Modules\Address\Entities\Barangay;
use Modules\Businesses\Entities\Business;
use Modules\Categories\Entities\Category;

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

            $admin->assignRole('admin');
        }

        User::factory(50)->create()->each(function($user) {

            $role = Arr::random(["owner", "customer"]);

            $user->assignRole($role);

            if ($role == "owner") {

                // Create Business
                Business::factory(5)->create([

                    'user_id' => $user->id,

                ])->each(function($business) {

                    $cities = City::where('provCode', 619)->get();
                    $city = $cities->random();
                    $business->city_id = $city->citymunCode;

                    $barangays = Barangay::where('citymunCode', $city->citymunCode)->get();
                    $barangay = $barangays->random();
                    $business->barangay_id = $barangay->brgyCode;

                    $street = fake()->streetName();
                    $business->street = $street;

                    $business->full_address = $street . ', ' . $barangay->brgyDesc . ', ' . ucwords(Str::lower($city->citymunDesc)) . ', Capiz';

                    // Add Category and Subcategory
                    $category_id = rand(1, 15);
                    $business->category_id = $category_id;
                    $business->save();

                    $business->subcategories()->attach(Category::find($category_id)->subcategories->random(3));

                    // Add Product
                    // Product::factory(1)->create([
                    //     'business_id' => $business->id
                    // ]);

                    // Add Service
                    // Service::factory(1)->create([
                    //     'business_id' => $business->id
                    // ]);
                });
            }
        });
    }
}
