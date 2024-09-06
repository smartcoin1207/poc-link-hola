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
        Schema::create('projects_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->comment('project id'); // Foreign key
            $table->string('project_number')->default('0')->comment("プロジェクト番号: ");
            $table->string('project_name')->default('')->comment("プロジェクト名: ");
            $table->string('project_type')->default('')->comment("種類: ");
            $table->enum('project_application_steps', ['application', 'credit'])->default('application')->comment('プロジェクト申請フェーズ');
            $table->string('application_methodology')->default('')->comment("適用法方法論: ");
            $table->string('implementation_location')->default('')->comment("実施場所: ");
            $table->date('base_start_date')->nullable()->comment("稼働開始日_基準日: ");
            $table->date('certification_period_start_date')->nullable()->comment("認証対象期間 開始日: ");
            $table->date('certification_period_end_date')->nullable()->comment("認証対象期間 終了日: ");
            $table->date('initial_certification_start_date')->nullable()->comment("初回認証(検証)対象	開始日: ");
            $table->date('initial_certification_end_date')->nullable()->comment("初回認証(検証)対象 終了日: ");
            $table->date('project_application_date')->nullable()->comment("プロジェクト申請日: ");
            $table->date('project_registration_date')->nullable()->comment("プロジェクト登録日: ");
            $table->string('project_before_implementation')->default('')->comment("導入前 プロジェクト説明: ");
            $table->string('project_during_implementation')->default('')->comment("活動時 プロジェクト説明: ");
            $table->string('project_mid_longterm_plan')->default('')->comment("プロジェクト中長期計画: ");
            $table->string('project_overview')->default('')->comment("プロジェクト概要図: ");
            $table->string('implementing_body_credit_holder')->default('')->comment("実施主体/クレジット保有主体: ");
            $table->date('project_overview_upload_date')->nullable()->comment("プロジェクト概要図 アップロード日");
            $table->date('implementing_body_credit_holder_upload_date')->nullable()->comment("実施主体/クレジット保有主体 アップロード日: ");

            //プロジェクト計画書（PDD-1）
            $table->string('emission_source_before_project')->default('')->comment("プロジェクト前の排出源: ");
            $table->string('emission_from_production1')->default('')->comment("プロジェクト前の生産・物流由来の排出: ");
            $table->string('facilities_after_project')->default('')->comment("プロジェクト後の設備等: ");
            $table->string('emission_from_production2')->default('')->comment("プロジェクト後の生産・物流由来の排出: ");
            $table->string('methodology_requirements')->default('')->comment("方法論の要件: ");
            $table->string('additionality_requirements')->default('')->comment("追加性要件: ");
            $table->string('expected_credit_amount')->default('')->comment("想定クレジット量: ");
            $table->string('payback_year')->default('')->comment("投資回収年: ");
            $table->string('decarbonization_pioneering_regions')->default('')->comment("脱炭素先行地域: ");
            $table->string('subside_environmental_value')->default('')->comment("補助金の環境価値帰属: ");
            $table->string('dobule_counting_prevent_measures')->default('')->comment("ダブルカウント防止措置: ");
            
            //PDD-2
            $table->string('emission_reduction_plan_table')->default('')->comment("排出削減計画表: ");    
            $table->string('increased_emission_risk')->default('')->comment("排出量が増えるリスク: ");    
            $table->string('calculation_method_sheet')->default('')->comment("算定方法のシート: ");    
            $table->string('initial_certification_period_amount')->default('')->comment("初回認証期間と当該排出削減量: ");    
            $table->string('above_based_raw_data')->default('')->comment("上記根拠となるRaw Data: ");

            $table->date('emission_reduction_plan_table_upload_date')->nullable()->comment("排出削減計画表 アップロード日: ");    
            $table->date('calculation_method_sheet_upload_date')->nullable()->comment("算定方法のシート アップロード日: ");    
            $table->date('initial_certification_period_amount_upload_date')->nullable()->comment("初回認証期間と当該排出削減量 アップロード日: ");    
            $table->date('above_based_raw_data_upload_date')->nullable()->comment("上記根拠となるRaw Data アップロード日: ");

            //PDD-3
            $table->string('person_responsible_monitoring_data')->default('')->comment("モニタリングデータ責任者: ");    
            $table->string('monitoring_staff')->default('')->comment("モニタリング担当者: ");    
            $table->string('recording_storage_monitoring_data')->default('')->comment("モニタリングデータの収集・記録・保管: ");    
            $table->string('monitoring_frequency')->default('')->comment("モニタリング頻度: ");    
            $table->string('data_storage_period')->default('')->comment("データ保管期間: ");    
            $table->string('monitoring_items')->default('')->comment("モニタリング項目: ");    
            $table->string('monitoring_point_diagram')->default('')->comment("モニタリングポイント図: ");
            $table->date('monitoring_point_diagram_upload_date')->nullable()->comment("モニタリングポイント図 アップロード日: ");        
            $table->string('measurement_activity_amount')->default('')->comment("活動量の計量・実測方法: ");    
            $table->string('coefficient1_basic_unit')->default('')->comment("係数1：原単位: ");    
            $table->string('coefficient2_emission')->default('')->comment("係数2：排出係数: ");    
            $table->string('coefficient3_other')->default('')->comment("係数3：その他: ");    
            $table->string('risk_occourrence_missing_values')->default('')->comment("欠損値の発生リスク: ");    
            $table->string('concept_correction_missing_values')->default('')->comment("欠損値の補正の考え方: ");

            // 3.ESG＋E評価
            $table->string('esg_economic_evaluation')->default('')->comment("ESG+E(経済)評価: ");    
            $table->date('esg_economic_evaluation_upload_date')->nullable()->comment("ESG+E(経済)評価 アップロード日: ");    

            $table->string('pledge_compliance')->default('')->comment("法令遵守の宣誓: ");    

            $table->integer('temp_save_step')->default(0)->comment('temp save step');
            $table->integer('completed_step')->default(0)->comment('completed step');
            $table->integer('is_completed')->default(0)->comment('created completely');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_projects_details');
    }
};
