<?php

namespace Database\Seeders;

use App\Domains\Custom\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::factory()->times(30)->create();
    }
}
