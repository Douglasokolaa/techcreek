<?php

namespace Database\Factories;

use App\Domains\Custom\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Hidehalo\Nanoid\Client;
use Hidehalo\Nanoid\GeneratorInterface;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $client = new Client();
        return [
            'name' => $this->faker->name,
            'status' => $this->faker->random_int(1,3),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => str_replace('+','', $this->faker->e164PhoneNumber),
            'gender' => $this->faker->randomElement(['male','female']),
            'type'  => $this->faker->randomElement(['daily', 'monthly', 'yearly']),
            'address' => $this->faker->address,
            'duration' => $this->faker->numberBetween(1,30),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date('Y-m-d', '+ 1 year'),
            'amount' => $this->faker->randomDigit,
            'reference' =>  $client->formattedId($alphabet = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', $size = 6),
            'product_id' => $this->faker->randomElement([1,2]),
        ];
    }
}
