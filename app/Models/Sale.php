<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'invoice_number',
        'user_id',
        'customer',
        'sub_total',
        'discount',
        'total',
        'paid',
        'change',
        'sold_at',
    ];

    protected $casts = [
        'sold_at' => 'datetime',
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->attributes['sub_total'] ?? null;
    }
}
