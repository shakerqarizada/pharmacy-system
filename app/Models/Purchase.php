<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $fillable = [
        'reference_number',
        'supplier_id',
        'user_id',
        'total_amount',
        'paid_amount',
        'status',
        'ordered_at',
        'received_at',
        'notes',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
