<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InvoiceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $invoices = DB::table('invoices')->pluck('id'); // Ambil semua ID dari tabel invoices

        foreach ($invoices as $invoice_id) {
            // Untuk setiap invoice, buat antara 1 sampai 5 item
            foreach (range(1, rand(1, 5)) as $index) {
                $qty = $faker->numberBetween(1, 10); // Jumlah item acak
                $harga_item = $faker->randomFloat(2, 50000, 500000); // Harga item acak
                $amount = $qty * $harga_item; // Total amount (qty * harga_item)

                DB::table('invoice_details')->insert([
                    'invoice_id' => $invoice_id, // Relasi ke tabel invoices
                    'deskripsi_item' => $faker->sentence(3), // Deskripsi item acak
                    'qty' => $qty,
                    'harga_item' => $harga_item,
                    'amount' => $amount,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
