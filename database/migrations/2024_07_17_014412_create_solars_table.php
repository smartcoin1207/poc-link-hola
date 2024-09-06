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
        Schema::create('solars', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('利用年月');
            $table->string('customer_number')->comment('顧客番号');
            $table->string('serial_number')->comment('GW製造番号');
            $table->string('electricity_number')->comment('電気番号');
            $table->date('connection_date')->comment('連系日');
            $table->date('start_date')->comment('利用開始日');
            $table->date('end_date')->comment('利用終了日');
            $table->string('generation_billing')->comment('発電量_請求');
            $table->string('power_sales')->comment('余剰売電量(kWh)');
            $table->string('self_consumption')->comment('自家消費(kWh)');
            $table->string('meter_reading_date')->comment('基本検針日');
            $table->string('address')->comment('住所');
            $table->string('billing')->comment('請求');
            $table->string('comment')->comment('コメント');
            $table->boolean('is_missing_value')->comment("欠損値");
            $table->boolean('csv_id')->comment('csv id foreign key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solars');
    }
};
