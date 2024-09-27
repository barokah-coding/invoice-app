<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;


class InvoiceDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function invoice() {
        return $this->belongsTo(invoice::class);
    }
}
