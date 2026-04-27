<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    //
    protected $fillable = [
        'purchase_id',
        'medicine_id',
        'quantity_ordered',
        'quantity_received',
        'unit_cost',
        'subtotal',
        'expiry_date',
        'batch_number',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
