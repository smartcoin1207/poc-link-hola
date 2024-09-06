<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarCsv extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'corrected_csv'
    ];
}