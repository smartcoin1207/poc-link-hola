<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bike extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "id",
        "project_id",
        "bike_type_electric",
        "number_of_units",
        "annual_distance",
        "bike_type_baseline",
        "fuel_efficiency",
        "fuel_emission_factor",
        "electric_efficiency",
        "electric_emission_factor"
    ];
}
