<?php

namespace Database\Seeders;

use App\Domains\Custom\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name'           => 'Open Cafe',
            'slug'           => 'open_cafe',
            'price_monthly'  => '5000',
            'price_yearly'   => '60000',
        ]);

        Product::create([
            'name'           => 'Co-Working',
            'slug'           => 'coworking',
            'price_daily'    => '1500',
            'price_monthly'  => '30000',
            'price_yearly'   => '350000',
        ]);
    }
}
