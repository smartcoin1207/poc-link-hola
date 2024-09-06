<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('bike_type_electric')->comment('電動バイクの種類');
            $table->integer('number_of_units')->comment('導入台数');
            $table->decimal('annual_distance', 10, 2)->comment('年間走行距離（km/年）');
            $table->string('bike_type_baseline')->comment('ベースラインのガソリンバイクの種類');
            $table->decimal('fuel_efficiency', 10, 2)->comment('燃料消費効率（km/L）');
            $table->decimal('fuel_emission_factor', 10, 2)->comment('使用燃料の排出係数（tCO2/L）');
            $table->decimal('electric_efficiency', 10, 2)->comment('電力消費効率（km/kWh）');
            $table->decimal('electric_emission_factor', 10, 2)->comment('電力のCO2排出係数（tCO2/kWh）');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bikes');
    }
};
