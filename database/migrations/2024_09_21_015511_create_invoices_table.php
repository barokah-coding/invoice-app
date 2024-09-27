<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice');
            $table->text('bill_to');
            $table->decimal('subtotal', 20, 2)->nullable();
            $table->bigInteger('total_payment')->nullable();
            $table->decimal('remaining_payment', 20, 2)->nullable();
            $table->text('payment_intructions')->nullable();
            $table->text('terms')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migns.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
