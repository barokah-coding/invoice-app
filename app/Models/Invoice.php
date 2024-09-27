<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceDetail;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function invoice_detail()  {
        return $this->hasMany(InvoiceDetail::class);
    }
    public function signature(){
        return $this->hasOne(Signature::class);
    }
}
