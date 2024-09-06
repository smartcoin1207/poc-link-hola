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
        Schema::create('solar_csvs', function (Blueprint $table) {
            $table->id();
            $table->string('filename')->comment('アップロードするソーラー csv のファイル名');
            $table->boolean('corrected_csv')->comment('補正または非補正');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_csvs');
    }
};
