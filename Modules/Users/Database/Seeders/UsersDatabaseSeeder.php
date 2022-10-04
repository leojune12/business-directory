<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Users\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

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

        $admin = User::firstOrCreate([
            "first_name" => "Admin",
            "last_name" => "Admin",
            "email" => "admin@test.com",
            "email_verified_at" => now(),
            "password" => Hash::make("pw@12345"),
            "remember_token" => Str::random(10),
        ]);

        $admin->assignRole('Admin');

        User::factory(100)->create();
    }
}
