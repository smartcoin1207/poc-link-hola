<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\BikeResult;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

class BikeCalculateController extends Controller
{
    public function form(Request $request) 
    {
        return view('bike.form');
    }
    public function action(Request $request) 
    {
        DB::beginTransaction();

        try {
            $calculate_data = $request->all();
            #EMBL ベースライン排出量 (EMBL)
            $embl = $calculate_data['distance_year'] / $calculate_data['fuel_efficiency'] * $calculate_data['emission_factor'];
            #EMPJ プロジェクト実施後排出量 (EMPJ)（tCO2）
            $empj = $calculate_data['distance_year'] / $calculate_data['ele_consum_efficiency'] * $calculate_data['co2_count'];
            #ER 排出削減量 (ER) （tCO2）= (1) - (2)
            $er = $embl - $empj;
    
            $new_project = Project::create([
                'name' => $calculate_data['project_name'],
                'company_name' => $calculate_data['company_name'],
                'contact_name' => $calculate_data['user_name'],
                'contact_email' => $calculate_data['contact'],
            ]);
    
            Bike::create([
                'project_id' => $new_project->id,
                'bike_type_electric' => $calculate_data['bike_kind'],
                'number_of_units' => $calculate_data['bike_count'],
                'annual_distance' => $calculate_data['distance_year'],
                'bike_type_baseline' => $calculate_data['base_line_bike_kind'],
                'fuel_efficiency' => $calculate_data['fuel_efficiency'],
                'fuel_emission_factor' => $calculate_data['emission_factor'],
                'electric_efficiency' => $calculate_data['ele_consum_efficiency'],
                'electric_emission_factor' => $calculate_data['co2_count'],
            ]);
    
            DB::commit();

            BikeResult::create([
                'project_id' => $new_project->id,
                'embl' => $embl,
                'empj' => $empj,
                'er' => $er
            ]);

            return redirect()->route('bike.check', [
                'project_id' => $new_project->id,
                'embl' => $embl,
                'empj' => $empj,
                'er' => $er,
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Error creating project and bike: ' . $e->getMessage());
    
            return redirect()->back()->withErrors(['message' => 'There was an error processing your request. Please try again.']);
        }
    }

    public function check(Request $request)
    {   
        $project_id = $request->query('project_id');
        $embl = $request->query('embl');
        $empj = $request->query('empj');
        $er = $request->query('er');

        return view('bike.check', compact('project_id', 'embl', 'empj', 'er'));
    }
}
