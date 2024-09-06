<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solar;
use App\Models\BikeResult;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // すべてのレコードを取得
        $results = BikeResult::all();

        // 合計を計算する `embl`, `empj`, and `er`
        $totalBikeBaseLine = $results->sum('embl');
        $totalBikeProjectImplement = $results->sum('empj');
        $totalBikeReducing = $results->sum('er');

        $start_month = 4;
        $solarData = Solar::all();
        $processedData = $solarData->groupBy(function($item) use ($start_month) {
            $date = Carbon::parse($item->date);
            // 4月から始まる会計年度に基づいて年を調整します
            if ($date->month < $start_month) {
                $fiscalYear = $date->year - 1;
            } else {
                $fiscalYear = $date->year;
            }
            return $fiscalYear; // 会計年度別にグループ化
        })->map(function($yearGroup) {
            return [
                'total_self_consumption' => $yearGroup->sum('self_consumption'),
                'total_power_sales' => $yearGroup->sum('power_sales'),
                'total_generation_billing' => $yearGroup->sum('generation_billing'),
                'customer_count' => $yearGroup->groupBy('customer_number')->count()
            ];
        })->sortKeysDesc();

        $emission_factors = array(
            '2023' => 0.672,
            '2022' => 0.649,
            '2021' => 0.692
        );

        $project_implement_emissions = array(
            '2023' => 0,
            '2022' => 0,
            '2021' => 0
        );

        $baseline_emission_all_year_sum = 0;
        $reduction_emissioin_all_year_sum = 0;
        foreach ($processedData as $key => &$row) {
            $emission_factor = isset($emission_factors[$key]) ? $emission_factors[$key] : 1;
            $total_power_sales = $row['total_power_sales'];
            $total_generation_billing = $row['total_generation_billing'];
            
            $baseline_emission = round(($total_generation_billing - $total_power_sales) * $emission_factor/1000, 1);
            $project_implement_emission = isset($project_implement_emissions[$key]) ? $project_implement_emissions[$key] : 0;
            
            $reduction_emission = $baseline_emission - $project_implement_emission;
            $baseline_emission_all_year_sum += $baseline_emission;
            $reduction_emissioin_all_year_sum += $reduction_emission;
        }

        $totalBaseline = round( $totalBikeBaseLine +  $baseline_emission_all_year_sum, 1);
        $totalProjectImplemented = round($totalBikeProjectImplement + 0, 1);
        $totalReduction = round( $totalBikeReducing + $reduction_emissioin_all_year_sum, 1);
        $totalCredit = $totalReduction;

        return view('dashboard', ['total_baseline' => $totalBaseline, 'total_project' => $totalProjectImplemented, 'total_co2_reduction' => $totalReduction, 'total_co2_credit' => $totalCredit]);
    }
}
