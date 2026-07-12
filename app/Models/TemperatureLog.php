<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemperatureLog extends Model
{
    //
    protected $fillable = [
        'temperature',
        'humidity',
        'status',
        'alarm',
    ];

    protected $casts = [
        'temperature' => 'decimal:2',
        'humidity' => 'decimal:2',
        'alarm' => 'boolean',
    ];
}
