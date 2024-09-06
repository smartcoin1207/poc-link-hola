<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solar extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'customer_number',
        'serial_number',
        'electricity_number',
        'connection_date',
        'start_date',
        'end_date',
        'generation_billing',
        'power_sales',
        'self_consumption',
        'meter_reading_date',
        'address',
        'billing',
        'is_missing_value',
        'comment',
        'csv_id'
    ];
}