<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;




class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Membuat 5 data invoice palsu
        foreach (range(1, 20) as $index) {
            $subtotal = $faker->randomFloat(2, 1000000, 10000000);
            $total_payment = $subtotal - $faker->randomFloat(2, 500000, 1500000);
            $remaining_payment = $subtotal - $total_payment;

            DB::table('invoices')->insert([
                'no_invoice' => 'INV-' . strtoupper($faker->bothify('???-#####')),
                'bill_to' => $faker->name . "\n" . $faker->address,
                'subtotal' => $subtotal,
                'total_payment' => $total_payment,
                'remaining_payment' => $remaining_payment,
                'payment_intructions' => $faker->sentence(5),
                'terms' => $faker->paragraph(3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
