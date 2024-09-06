<x-app-layout>
    @csrf
    <div class="mt-4  font-bold text-2xl text-center">{{__('Project information')}}</div>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 ">
        <div class="w-full max-w-4xl mt-6 mb-4 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <!-- メイン設定 -->
            <div class="row mx-1 justify-between">
                <div class="font-xl font-bold">
                【 {{__('Project Overview')}} 】
                </div>
                @if(!($isEvaluator ?? ''))
                <button type="button" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-600" onclick="location.href='{{ route('project.detail.edit', $projectDetail->id ?? '') }}'">
                    {{ __('Edit Project Details') }}
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </button>
                @endif
            </div>
            
            <div class="row">
                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('Project Number').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->project_number ?? ''}}</div>
                </div>

                <div class="mt-4  col-md-6 flex items-center">
                    <x-input-label :value="__('Project Name').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->project_name ?? ''}}</div>
                </div>

                <div class="mt-4  col-md-6 flex items-center">
                    <x-input-label :value="__('Project Type').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->project_type ?? ''}}</div>
                </div>

                <div class="mt-4  col-md-6 flex items-center">
                    <x-input-label :value="__('Application methodology').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->application_methodology ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('Implementation Location').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->implementation_location ?? ''}}</div>
                </div>

                <div class="mt-4  col-md-6 flex items-center">
                    <x-input-label :value="__('base start date').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->base_start_date ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('certification period start date').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->certification_period_start_date ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('certification period end date').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->certification_period_end_date ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('initial certification start date').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->initial_certification_start_date ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('initial certification end date').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->initial_certification_end_date ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('project application date').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->project_application_date ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('project registration date').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->project_registration_date ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('project before implementation').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->project_before_implementation ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('project during implementation').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->project_during_implementation ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('project mid longterm plan').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->project_mid_longterm_plan ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('project overview') . ':'" class="mb-0" />
                    <x-file-download-button :link="($projectDetail->project_overview ?? '')" :filename="$projectDetail->project_overview ?? ''" />
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('implementing body credit holder').':'" class="mb-0" />
                    <x-file-download-button :link="$projectDetail->implementing_body_credit_holder ?? ''" :filename="$projectDetail->implementing_body_credit_holder ?? ''" />
                </div>
            </div>

            <hr class="mt-4">

            <div class="mt-4 mb-4 font-xl font-bold">
                【 {{__('プロジェクト計画書 (PDD-1)    ')}} 】
            </div>
            <div class="row">
                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('emission source before project').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->emission_source_before_project ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('emission from production1').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->emission_from_production1 ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('facilities after project').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->facilities_after_project ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('emission from production2').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->emission_from_production2 ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('methodology requirements').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->methodology_requirements ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('additionality requirements').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->additionality_requirements ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('expected credit amount').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->expected_credit_amount ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('payback year').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->payback_year ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('decarbonization pioneering regions').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->decarbonization_pioneering_regions ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('subside environmental value').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->subside_environmental_value ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('dobule counting prevent measures').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->dobule_counting_prevent_measures ?? ''}}</div>
                </div>
            </div>

            <hr class="mt-4">

            <div class="mt-4 mb-4 font-xl font-bold">
                【 {{__('プロジェクト計画書 (PDD-2)')}} 】
            </div>
            <div class="row">

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('emission reduction plan table').':'" class="mb-0" />
                    <x-file-download-button :link="$projectDetail->emission_reduction_plan_table ?? ''" :filename="$projectDetail->emission_reduction_plan_table ?? ''" />
                </div>
            

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('increased emission risk').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->increased_emission_risk ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('calculation method sheet').':'" class="mb-0" />
                    <x-file-download-button :link="$projectDetail->calculation_method_sheet ?? ''" :filename="$projectDetail->calculation_method_sheet ?? ''" />
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('initial certification period amount').':'" class="mb-0" />
                    <x-file-download-button :link="$projectDetail->initial_certification_period_amount ?? ''" :filename="$projectDetail->initial_certification_period_amount ?? ''" />
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('above based raw data').':'" class="mb-0" />
                    <x-file-download-button :link="$projectDetail->above_based_raw_data ?? ''" :filename="$projectDetail->above_based_raw_data ?? ''" />
                </div>
            </div>

            <hr class="mt-4">

            <div class="mt-4 mb-4 font-xl font-bold">
                【 {{__('プロジェクト計画書 (PDD-3)')}} 】
            </div>
            <div class="row">

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('person responsible monitoring data').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->person_responsible_monitoring_data ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('monitoring staff').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->monitoring_staff ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('recording storage monitoring data').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->recording_storage_monitoring_data ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('monitoring frequency').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->monitoring_frequency ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('data storage period').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->data_storage_period ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('monitoring items').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->monitoring_items ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('monitoring point diagram').':'" class="mb-0" />
                    <x-file-download-button :link="$projectDetail->monitoring_point_diagram ?? ''" :filename="$projectDetail->monitoring_point_diagram ?? ''" />
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('measurement activity amount').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->measurement_activity_amount ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('coefficient1 basic unit').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->coefficient1_basic_unit ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('coefficient2 emission').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->coefficient2_emission ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('coefficient3 other').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->coefficient3_other ?? ''}}</div>
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('risk occourrence missing values').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->risk_occourrence_missing_values ?? ''}}</div>
                </div>
                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('concept correction missing values').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->concept_correction_missing_values ?? ''}}</div>
                </div>
            </div>

            <hr class="mt-4">

            <div class="mt-4 mb-4 font-xl font-bold">
                【 {{__('ESG+E評価')}} 】
            </div>
            <div class="row">
                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('esg economic evaluation').':'" class="mb-0" />
                    <x-file-download-button :link="$projectDetail->esg_economic_evaluation ?? ''" :filename="$projectDetail->esg_economic_evaluation ?? ''" />
                </div>

                <div class="mt-4 col-md-6 flex items-center">
                    <x-input-label :value="__('pledge compliance').':'" class="mb-0" />
                    <div class="text-base font-semibold ml-2">{{$projectDetail->pledge_compliance ?? ''}}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>