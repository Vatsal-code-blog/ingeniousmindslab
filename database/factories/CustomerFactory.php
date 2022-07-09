<?php

namespace Database\Factories;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shop_id' => rand(1,500),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'avatar' => "https://png.pngtree.com/element_our/20190531/ourmid/pngtree-customer-service-avatar-image_1288891.jpg",
            'city' => $this->faker->city(),
            'birthdate' => $this->faker->date($format = 'Y-m-d', $max = '2018',$min = '1990'),
        ];
    }
}
