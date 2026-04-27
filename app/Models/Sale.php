<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $fillable = [
        
    'invoice_number',
    'user_id',
    'customer_id',
    'subtotal',
    'discount',
    'total',
    'paid',
    'change', 
    'sold_at',

    ];

    public function cashier()  { return $this->belongsTo(User::class, 'user_id'); }
    public function customer() { return $this->belongsTo(Customer::class); }
    public function items()    { return $this->hasMany(SaleItem::class); }

}
