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
        Schema::create('userinfos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key
            $table->json("project_implemented_type")->comment("実施プロジェクトの種別:");
            $table->enum("coporate_type", ['application', 'credit'])->comment("法人タイプ:");
            $table->string('corporate_number')->comment("法人番号: ");
            $table->string('corporate_name')->comment("法人名: ");
            $table->string('representative_title')->comment("代表者役職名: ");
            $table->string('representative_name')->comment("代表者名: ");
            $table->string('main_phone_number')->comment("代表電話番号: ");
            $table->string('postal_code')->comment("郵便番号: ");
            $table->string('prefecture')->comment("都道府県: ");
            $table->string('city_town')->comment("市町村区: ");
            $table->string('address_beyond_city_town')->comment("市区町村以降の住所: ");
            $table->string('other_credit_history')->comment("他クレジット実績: ");
            $table->date('corporate_account_registration_date')->comment("法人アカウント登録日: ");
            $table->string('department_name')->comment("担当部署名: ");
            $table->string('personal_title')->comment("担当者役職名: ");
            $table->string('personal_name')->comment("担当者名: ");
            $table->string('contact_phone_number')->comment("連絡用電話番号: ");
            $table->string('email_address')->comment("メールアドレス: ");
            $table->string('project_history')->comment("プロジェクト履歴: ");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userinfos');
    }
};
