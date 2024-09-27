<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Invoice;
use App\Models\InvoiceDetail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name'=>'admin',
            'username'=>'admin123',
            'password'=> bcrypt(123),
        ]);

        Invoice::create([
            'no_invoice'=>'INV-123',
            'bill_to'=>'Bapa asep',
            'subtotal'=>500000,
            'total_payment'=>250000,
            'remaining_payment'=>250000,
        ]);
        // $this->call([
        //     InvoiceSeeder::class,
        //     InvoiceDetailSeeder::class,
        // ]);

        
        


    }
}
