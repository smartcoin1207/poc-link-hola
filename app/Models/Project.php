<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class project extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "name",
        "company_name",
        "contact_name",
        "contact_email"
    ];
}
