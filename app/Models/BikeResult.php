<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeResult extends Model
{
    use HasFactory;

    protected $fillable = [
        "project_id",
        "embl",
        "empj",
        "er",
    ];
}
