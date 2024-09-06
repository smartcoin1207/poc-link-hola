<?php

namespace App\Http\Controllers;
use App\Models\ProjectDetail;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Collection;
use Symfony\Component\VarDumper\VarDumper;

class ProjectDetailController extends Controller
{
    /**
     * リソースのリストを表示します。
     */
    public function index()
    {
        $projectDetails = ProjectDetail::all();

        return view('project_details.index', compact('projectDetails'));
    }

    public function projectEvaluateIndex()
    {
        $projectDetails = ProjectDetail::where('is_completed', 1)->get();
        $isEvaluator = true;

        return view('project_details.index', compact('projectDetails', 'isEvaluator'));
    }

    /**
     * 新しいリソースを作成するためのフォームを表示します。
     */
    public function create(Request $request)
    {
        $projects = Project::all();
        $projectDetail = session('projectDetail') ?: null;
        $step = session('step', 1);

        return view('project_details.create', compact('step','projects','projectDetail'));
    }

    /**
     * 新しく作成されたリソースをストレージに保存します。
     */
    public function store(Request $request)
    {
        return self::saveProjectDetail($request, 'create');
    }

    public function update(Request $request, $id)
    {
        return self::saveProjectDetail($request, 'update', $id);
    }

    public function handleStepFileUpload($step)
    {
        $files1 = [
            'project_overview',
            'implementing_body_credit_holder',
        ];

        $files2 = [];

        $files3 = [
            'emission_reduction_plan_table',
            'calculation_method_sheet',
            'initial_certification_period_amount',
            'above_based_raw_data',
        ];

        $files4 = [
            'monitoring_point_diagram',
        ];

        $files5 = [
            'esg_economic_evaluation',
        ];

        $files = [];

        switch ($step) {
            case 1:
                $files = $files1;
                break;
            case 2:
                $files = $files2;
                break;          
            case 3:
                $files = $files3;
                break;
            case 4:
                $files = $files4;
                break;
            case 5:
                $files = $files5;
                break;
            case 'all':
                $files = array_merge($files1, $files2, $files3, $files4, $files5);
            default:
                # code...
                break;
        }

        return $files;
    }
    
    public function handleStepValidate($step)
    {   
        $validate1 = [
            'project_id' => 'required|exists:projects,id',
            'project_number' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
            'project_type' => 'required|string|max:255',
            'application_methodology' => 'required|string|max:255',
            'implementation_location' => 'required|string|max:255',
            'base_start_date' => 'required|date',
            'certification_period_start_date' => 'required|date',
            'certification_period_end_date' => 'required|date',
            'initial_certification_start_date' => 'required|date',
            'initial_certification_end_date' => 'required|date',
            'project_application_date' => 'required|date',
            'project_registration_date' => 'required|date',
            'project_before_implementation' => 'nullable|string',
            'project_during_implementation' => 'nullable|string',
            'project_mid_longterm_plan' => 'nullable|string',
            'project_overview' => 'file|max:2048',
            'implementing_body_credit_holder' => 'file|max:2048'
        ];

        $validate2 = [
            'emission_source_before_project' => 'required|string',
            'emission_from_production1' => 'required|string',
            'facilities_after_project' => 'required|string',
            'emission_from_production2' => 'required|string',
            'methodology_requirements' => 'required|string|max:255',
            'additionality_requirements' => 'required|string|max:255',
            'expected_credit_amount' => 'required|string|max:255',
            'payback_year' => 'required|string|max:255',
            'decarbonization_pioneering_regions' => 'required|string|max:255',
            'subside_environmental_value' => 'required|string|max:255',
            'dobule_counting_prevent_measures' => 'required|string|max:255',
        ];

        $validate3 = [
            'emission_reduction_plan_table' => 'file|max:2048',
            'increased_emission_risk' => 'required|string|max:255',
            'calculation_method_sheet' => 'file|max:2048',
            'initial_certification_period_amount' => 'file|max:2048',
            'above_based_raw_data' => 'file|max:2048',
        ];

        $validate4 = [
            'person_responsible_monitoring_data' => 'required|string|max:255',
            'monitoring_staff' => 'required|string|max:255',
            'recording_storage_monitoring_data' => 'required|string|max:255',
            'monitoring_frequency' => 'required|string|max:255',
            'data_storage_period' => 'required|string|max:255',
            'monitoring_items' => 'required|string|max:255',
            'monitoring_point_diagram' => 'file|max:2048',
            'measurement_activity_amount' => 'required|string|max:255',
            'coefficient1_basic_unit' => 'required|string|max:255',
            'coefficient2_emission' => 'required|string|max:255',
            'coefficient3_other' => 'required|string|max:255',
            'risk_occourrence_missing_values' => 'required|string|max:255',
            'concept_correction_missing_values' => 'required|string|max:255',
        ];

        $validate5 = [
            'esg_economic_evaluation' => 'file|max:2048',
            'pledge_compliance' => 'nullable|string|max:255',
        ];

        $validate = [];

        switch ($step) {
            case 1:
                $validate = $validate1;
                break;
            case 2:
                $validate = $validate2;
                break;          
            case 3:
                $validate = $validate3;
                break;
            case 4:
                $validate = $validate4;
                break;
            case 5:
                $validate = $validate5;
                break;
            case 'all':
                $validate = array_merge($validate1, $validate2, $validate3, $validate4, $validate5);
            default:
                # code...
                break;
        }

        return $validate;
    }

    private function getFileValidateData(Request $request, $files, $validatedData) 
    {
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $uploadedFile = $request->file($file);
                $filename = self::generateFilename($uploadedFile, $file);
                $validatedData[$file] = $uploadedFile->storeAs('uploads', $filename, 'public');
                $validatedData[$file . "_upload_date"] = Carbon::now()->toDateString();
            }
        }

        return $validatedData;
    }

    public function setDataWithFiles($data, $validatedData, $files)
    {
        $tempData = $data;
        foreach ($files as $file) {
            if(isset($validatedData[$file])){
                $tempData[$file] = $validatedData[$file];
                $tempData[$file . "_upload_date"] = $validatedData[$file . "_upload_date"];
            }
        }

        return $tempData;
    }

    public function saveProjectDetail(Request $request, $method = 'create', $id='')
    {   
        $step = $request->input('step');
        $action = $request->input('action');

        //tempoary save
        if ($action === 'temporary_save') {
            $data = $request->all();

            $data = Collection::make($data)->filter(function ($value) {
                return !is_null($value);
            })->all();

            $data['completed'] = 0;
            $data['temp_save_step'] = $step;

            $id = ($id ?? '') ? '' : ($request->id ?? '');

            if($id) {
                $projectDetail = ProjectDetail::findOrFail($id);
                $projectDetail->update($data);
            } else {
                $projectDetail = ProjectDetail::create($data);
            }

            return redirect()->back()->with([
                'projectDetail' => $projectDetail,
                'step' => $step
            ]);
        } elseif($action == 'prev_step') {
            $id = ($id ?? '') ? '' : ($request->id ?? '');
            $projectDetail = ProjectDetail::findOrFail($id);

            $step  = $step > 1 ? $step - 1 : $step;

            return redirect()->back()->with([
                'projectDetail' => $projectDetail,
                'step' => $step
            ]);
        }

        $files = self::handleStepFileUpload($step);
        $validate = self::handleStepValidate($step);
        $validatedData = $request->validate($validate);
        $validatedData = self::getFileValidateData($request, $files, $validatedData);

        $data = [];
        switch ($step) {
            case 1:
                $data = [
                    'project_id' => $request->project_id ?? '',
                    'project_number' => $request->project_number ?? '',
                    'project_name' => $request->project_name ?? '',
                    'project_type' => $request->project_type ?? '',
                    'application_methodology' => $request->application_methodology ?? '',
                    'implementation_location' => $request->implementation_location ?? '',
                    'base_start_date' => $request->base_start_date ?? '',
                    'certification_period_start_date' => $request->certification_period_start_date ?? '',
                    'certification_period_end_date' => $request->certification_period_end_date ?? '',
                    'initial_certification_start_date' => $request->initial_certification_start_date ?? '',
                    'initial_certification_end_date' => $request->initial_certification_end_date ?? '',
                    'project_application_date' => $request->project_application_date ?? '',
                    'project_registration_date' => $request->project_registration_date ?? '',
                    'project_before_implementation' => $request->project_before_implementation ?? '',
                    'project_during_implementation' => $request->project_during_implementation ?? '',
                    'project_mid_longterm_plan' => $request->project_mid_longterm_plan ?? '',
                ];

                break;
            
            case 2:
                $data = [
                    'emission_source_before_project' => $request->emission_source_before_project ?? '',
                    'emission_from_production1' => $request->emission_from_production1 ?? '',
                    'facilities_after_project' => $request->facilities_after_project ?? '',
                    'emission_from_production2' => $request->emission_from_production2 ?? '',
                    'methodology_requirements' => $request->methodology_requirements ?? '',
                    'additionality_requirements' => $request->additionality_requirements ?? '',
                    'expected_credit_amount' => $request->expected_credit_amount ?? '',
                    'payback_year' => $request->payback_year ?? '',
                    'decarbonization_pioneering_regions' => $request->decarbonization_pioneering_regions ?? '',
                    'subside_environmental_value' => $request->subside_environmental_value ?? '',
                    'dobule_counting_prevent_measures' => $request->dobule_counting_prevent_measures ?? '',
                ];

                break;
            
            case 3:
                $data = [
                    'increased_emission_risk' => $request->increased_emission_risk ?? '',
                ];

                break;

            case 4:
                $data = [
                    'person_responsible_monitoring_data' => $request->person_responsible_monitoring_data ?? '',
                    'monitoring_staff' => $request->monitoring_staff ?? '',
                    'recording_storage_monitoring_data' => $request->recording_storage_monitoring_data ?? '',
                    'monitoring_frequency' => $request->monitoring_frequency ?? '',
                    'data_storage_period' => $request->data_storage_period ?? '',
                    'monitoring_items' => $request->monitoring_items ?? '',
                    'measurement_activity_amount' => $request->measurement_activity_amount ?? '',
                    'coefficient1_basic_unit' => $request->coefficient1_basic_unit ?? '',
                    'coefficient2_emission' => $request->coefficient2_emission ?? '',
                    'coefficient3_other' => $request->coefficient3_other ?? '',
                    'risk_occourrence_missing_values' => $request->risk_occourrence_missing_values ?? '',
                    'concept_correction_missing_values' => $request->concept_correction_missing_values ?? '',
                ];
                break;

            case 5:
                $data = [
                    'pledge_compliance' => $request->pledge_compliance ?? '',
                ];
                break;
            
            default:
                # code...
                break;
        }

        $data = self::setDataWithFiles($data, $validatedData, $files);
        if($method == 'create') {
            $data['completed_step'] = $step;
            if($step == 5) {
                $data['is_completed'] = 1;
            }
            
            $projectDetail = null;
            if($step == 1) {
                $id = $request->id ?? '';
                $projectDetail = $id ? ProjectDetail::findOrFail($id)->update($data) : ProjectDetail::create($data);
                if($id) {
                    $projectDetail = ProjectDetail::findOrFail($id);
                    $projectDetail->update($data);
                } else {
                    $projectDetail = ProjectDetail::create($data);
                }
            } else {
                $id = $request->id ?? '';
                $projectDetail = ProjectDetail::findOrFail($id);
                if($projectDetail->completed_step == 5) {
                    $data['is_completed'] = 1;
                }
                $projectDetail->update($data);
            }

            if ($step < 5) {
                $step = $step + 1;
    
                return redirect()->route('project.detail.create')
                                 ->with('projectDetail', $projectDetail)
                                 ->with('step', $step);
            }
            
            $request->session()->forget('step');
            return redirect()->route('project.detail.index')->with('success', 'プロジェクトの詳細が正常に作成されました。');
        } elseif($method == 'update') {
            $projectDetail = ProjectDetail::findOrFail($id);
            if($projectDetail->completed_step == 5) {
                $data['is_completed'] = 1;
            }
            $projectDetail->update($data);

            if ($step < 5) {
                $step = $step + 1;
    
                return redirect()->route('project.detail.edit', ['id' => $id])
                ->with('step', $step);
            }
    
            return redirect()->route('project.detail.index')->with('success', 'プロジェクトの詳細が正常に作成されました。');
        }
    }

    // 指定されたリソースを表示します。
    public function show(ProjectDetail $projectDetail)
    {
        return view('project_details.show', compact('projectDetail'));
    }

    public function evaluateShow(ProjectDetail $projectDetail)
    {
        $isEvaluator = true;
        return view('project_details.show', compact('projectDetail', 'isEvaluator'));
    }

    // 指定されたリソースを編集するためのフォームを表示します。
    public function edit(string $id)
    {
        $projects = Project::all();
        $projectDetail = ProjectDetail::findOrFail($id);
        $step = session('step', 1);
        return view('project_details.edit', compact('projectDetail', 'projects', 'step'));
    }

    // 指定されたリソースをストレージから削除します。
    public function destroy(ProjectDetail $projectDetail)
    {
        $projectDetail->delete();

        return redirect()->route('project_details.index')->with('success', 'Project Detail deleted successfully.');
    }

    /**
     * ファイルからファイル名を生成します。
     */
    private function generateFilename($file, $field)
    {
        $timestamp = now()->format('YmdHis');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        return "{$field}_{$timestamp}_{$originalName}.{$extension}";
    }

    public function approve(string $id)
    {
        $projectDetail = ProjectDetail::findOrFail($id);
        
        $projectDetail->update(['project_application_steps' => 'credit']); // Example update
        return redirect()->back()->with('success', 'Project approved successfully.');
    }

    public function reject(string $id)
    {
        $projectDetail = ProjectDetail::findOrFail($id);
        $projectDetail->delete();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Project rejected and deleted successfully.');
    }
}
