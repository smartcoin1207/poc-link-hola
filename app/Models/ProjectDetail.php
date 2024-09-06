<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    use HasFactory;

    protected $table = 'projects_details';

    protected $fillable = [
        'project_id',
        'project_number',
        'project_name',
        'project_type',
        'application_methodology',
        'project_application_steps',
        'implementation_location',
        'base_start_date',
        'certification_period_start_date',
        'certification_period_end_date',
        'initial_certification_start_date',
        'initial_certification_end_date',
        'project_application_date',
        'project_registration_date',
        'project_before_implementation',
        'project_during_implementation',
        'project_mid_longterm_plan',
        'project_overview',
        'implementing_body_credit_holder',
        'emission_source_before_project',
        'emission_from_production1',
        'facilities_after_project',
        'emission_from_production2',
        'methodology_requirements',
        'additionality_requirements',
        'expected_credit_amount',
        'payback_year',
        'decarbonization_pioneering_regions',
        'subside_environmental_value',
        'dobule_counting_prevent_measures',
        'emission_reduction_plan_table',
        'increased_emission_risk',
        'calculation_method_sheet',
        'initial_certification_period_amount',
        'above_based_raw_data',
        'person_responsible_monitoring_data',
        'monitoring_staff',
        'recording_storage_monitoring_data',
        'monitoring_frequency',
        'data_storage_period',
        'monitoring_items',
        'monitoring_point_diagram',
        'measurement_activity_amount',
        'coefficient1_basic_unit',
        'coefficient2_emission',
        'coefficient3_other',
        'risk_occourrence_missing_values',
        'concept_correction_missing_values',
        'esg_economic_evaluation',
        'pledge_compliance',
        'temp_save_step',
        'completed_step',
        'is_completed',

        
        // upload date is not required.
        'project_overview_upload_date',
        'implementing_body_credit_holder_upload_date',
        'emission_reduction_plan_table_upload_date',
        'calculation_method_sheet_upload_date',
        'initial_certification_period_amount_upload_date',
        'above_based_raw_data_upload_date',
        'monitoring_point_diagram_upload_date',
        'esg_economic_evaluation_upload_date'
    ];


    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
