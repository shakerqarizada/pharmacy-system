<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //
    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'slug',
        'unit',
        'purchase_price',
        'selling_price',
        'stock',
        'low_stock_threshold',
        'expiry_date',
        'description',
        'is_active'
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'stock' => 'decimal:2',
        'expiry_date' => 'date',
        'is_active' => 'boolean',
    ];


    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
