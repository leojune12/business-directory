<?php

namespace Modules\Businesses\Database\factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Businesses\Entities\Business::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = fake()->company();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            // 'address' => fake()->address(),
            'contact_number' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'website' => "https://roxas-index.herokuapp.com",
            'facebook_link' => "www.facebook.com/ljbdu",
            'map_location' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12469.776493332698!2d-80.14036379941481!3d25.907788681148624!2m3!1f357.26927939317244!2f20.870722720054623!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x88d9add4b4ac788f%3A0xe77469d09480fcdb!2sSunny%20Isles%20Beach!5e1!3m2!1sen!2sth!4v1642869952544!5m2!1sen!2sth",
            'description' => fake()->paragraph(),
            // 'street' => fake()->streetName(),
            'region_id' => 6,
            'province_id' => 619,
            // 'city_id' => 61914,
            // 'barangay_id' => 61914004
            'rating' => rand(1, 5),
        ];
    }
}

