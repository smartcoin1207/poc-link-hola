<?php

namespace App\Http\Controllers;

use App\DataTables\SolarDataTable;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solar;
use App\Models\SolarCsv;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SolarCalculateController extends Controller
{
    /**
     * リソースのリストを表示します。
     */
    public function index1(Request $request)
    {
        //修正されたcsvを確認する
        $allSolarCsvRecords = SolarCsv::all();
        $lastSolarCsvRecord = SolarCsv::orderBy('created_at', 'desc')->first();
        $is_corrected_csv = (isset($lastSolarCsvRecord['corrected_csv']) && $lastSolarCsvRecord['corrected_csv']) ? 1 : 0;

        $processedData = self::getProcessedData();

        $perPageNumber = 10;
        $perPage = $request->input('per_page', $perPageNumber); // Default to 10 if not specified
        $is_missing = $request->input('is_missing', 0);

        if($is_missing) {
            $solars = Solar::where('is_missing_value', 1)->paginate($perPage)->appends(['is_missing' => $is_missing]);
        } else {
            $solars = Solar::paginate($perPage);
        }
        
        $currentPage = $solars->currentPage();

        return view('solar.index', 
            [
                'solars' => $solars, 
                'perPageNumber' => $perPageNumber, 
                'currentPage' => $currentPage, 
                'processedData' => $processedData, 
                'is_missing' => $is_missing,
                'corrected_csv' => $is_corrected_csv == 1 ? "補正データ" : "非補正データ"
            ]);
    }

    public function index(SolarDataTable $dataTable)
    {
        $allSolarCsvRecords = SolarCsv::all();
        $lastSolarCsvRecord = SolarCsv::orderBy('created_at', 'desc')->first();
        $is_corrected_csv = (isset($lastSolarCsvRecord['corrected_csv']) && $lastSolarCsvRecord['corrected_csv']) ? 1 : 0;

        $processedData = self::getProcessedData();

        $lastSolarCsvRecord = SolarCsv::orderBy('created_at', 'desc')->first();
        $is_corrected_csv = (isset($lastSolarCsvRecord['corrected_csv']) && $lastSolarCsvRecord['corrected_csv']) ? 1 : 0;
        $pageTitle = 'ソーラーテーブル' . ($is_corrected_csv ? "(補正データ)" : "(非補正データ)");

        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('solar.index', compact('pageTitle','assets', 'processedData'));
    }
    

    public function processedData(Request $request)
    {
        $month = $request->month;
        $processedData = self::getProcessedData($month);

        return response()->json([
            'success' => true,
            'processedData' => $processedData,
        ]);
    }

    /**
     * 処理されたデータを取得する
     */
    private function getProcessedData($start_month = 4)
    {   
        if(!$start_month) {
            $start_month = 4;
        }
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

        $newProcessedData = $processedData;
        $baseline_emission_all_year_sum = 0;
        foreach ($processedData as $key => &$row) {
            $emission_factor = isset($emission_factors[$key]) ? $emission_factors[$key] : 1;
            $total_self_consumption = $row['total_self_consumption'];
            $total_power_sales = $row['total_power_sales'];
            $total_generation_billing = $row['total_generation_billing'];
            $customer_count = $row['customer_count'];
            
            $baseline_emission = round(($total_generation_billing - $total_power_sales) * $emission_factor/1000, 1);
            $project_implement_emission = isset($project_implement_emissions[$key]) ? $project_implement_emissions[$key] : 0;
            
            $reduction_emission = $baseline_emission - $project_implement_emission;
            $baseline_emission_all_year_sum += $baseline_emission;
            $newProcessedData[$key] = [
                'total_self_consumption' => $total_self_consumption,
                'total_power_sales' => $total_power_sales,
                'total_generation_billing' => $total_generation_billing,
                'project_implement_emission' => $project_implement_emission,
                'baseline_emission' => $baseline_emission,  
                'reduction_emission' => $reduction_emission,
                'customer_count' => $customer_count
            ];
        }
        $newProcessedData['all_years'] = [
            'total_self_consumption' => '',
            'total_power_sales' => '',
            'total_generation_billing' => '',
            'project_implement_emission' => '',
            'baseline_emission' => round($baseline_emission_all_year_sum, 1),  
            'reduction_emission' => round($baseline_emission_all_year_sum, 1),
            'customer_count' => ''
        ];

        return $newProcessedData;
    }

    /**
     * Csv ファイルのアップロード フォームを表示します。
     */
    public function upload()
    {
        return view('solar.upload');
    }

    /**
     * CSVファイルをアップロード
     */
    public function uploadCsv(Request $request)
    {
        // アップロードしたファイルを検証する
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $is_correction_data = $request->is_correction_data ? $request->is_correction_data : 0;

        // アップロードされたファイルを取得する
        $file = $request->file('csv_file');
        $fileName = $file->getClientOriginalName();

        if (($handle = fopen($file, 'r')) !== false) {
            $header = null;
            $all_rows = [];
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                if ($header === null && $this->isHeaderRow($data)) {
                    $header = $data;
                    continue;
                }

                if ($header === null) {
                    continue;
                }

                $all_rows[] = array_combine($header, $data);
            }
            fclose($handle);

            self::saveToDatabase($all_rows, $fileName, $is_correction_data);
        } else {
            return response()->json(['error' => 'Unable to open the file.'], 500);
        }

        return redirect()->route('solar.calculate.index');
    }

    private function isHeaderRow($row)
    {
        // 予想されるヘッダー列を定義する
        $expectedHeaders = ['利用年月', '顧客番号', 'GW製造番号']; // 実際のヘッダー名に置き換えます

        // 行が期待されるヘッダーと一致しているかどうかを確認します
        return !array_diff($expectedHeaders, $row);
    }
    
    /**
     * ファイルをデータベースに読み込む
     */
    function saveToDatabase($all_rows, $fileName, $correct) {
        $solarCsv = SolarCsv::create([
            'filename' => $fileName,
            'corrected_csv' => $correct,
        ]);

        $csvId = $solarCsv->id;

        Solar::truncate();

        // データベース接続
        foreach ($all_rows as $row) {
            $isMissingValue = empty($row['利用年月']) ||
                          empty($row['顧客番号']) ||
                          empty($row['GW製造番号']) ||
                          empty($row['電気番号']) ||
                          empty($row['連系日']) ||
                          empty($row['利用開始日']) ||
                          empty($row['利用終了日']) ||
                          empty($row['発電量_請求']) ||
                          empty($row['余剰売電量(kWh)']) ||
                          empty($row['自家消費(kWh)']) ||
                          empty($row['基本検針日']) ||
                          empty($row['住所']) ||
                          empty($row['請求']);
            
            // 新しいソーラーレコードを作成する
            try {
                Solar::create([
                    'date' => !empty($row['利用年月']) ? \Carbon\Carbon::createFromFormat('n/j/Y', $row['利用年月'])->format('Y-m-d') : '1970-01-01',
                    'customer_number' => $row['顧客番号'],
                    'serial_number' => $row['GW製造番号'],
                    'electricity_number' => $row['電気番号'],
                    'connection_date' => !empty($row['連系日']) ? \Carbon\Carbon::createFromFormat('n/j/Y', $row['連系日'])->format('Y-m-d') : '1970-01-01',
                    'start_date' => !empty($row['利用開始日']) ? \Carbon\Carbon::createFromFormat('n/j/Y', $row['利用開始日'])->format('Y-m-d') : '1970-01-01',
                    'end_date' => !empty($row['利用終了日']) ? \Carbon\Carbon::createFromFormat('n/j/Y', $row['利用終了日'])->format('Y-m-d') : '1970-01-01',
                    'generation_billing' => $row['発電量_請求'],
                    'power_sales' => $row['余剰売電量(kWh)'],
                    'self_consumption' => $row['自家消費(kWh)'],
                    'meter_reading_date' => $row['基本検針日'],
                    'address' => $row['住所'],
                    'billing' => $row['請求'],
                    'is_missing_value' => $isMissingValue,
                    'comment' => '',
                    'csv_id' => $csvId
                ]);

            } catch (\Throwable $th) {
                Log::error('Failed to insert row: ' . $th->getMessage(), ['row' => $row]);
            }
        }
    }

    /**
     * 新しいリソースを作成するためのフォームを表示します。
     */
    public function create()
    {
        //
    }

    /**
     * 新しく作成されたリソースをストレージに保存します。
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 指定されたリソースを表示します。
     */
    public function show(string $id)
    {
        //
    }

    /**
     * 指定されたリソースを編集するためのフォームを表示します。
     */
    public function edit(string $id)
    {
        try {
            // $idに基づいてデータベースから太陽光記録を取得します
            $solar = Solar::findOrFail($id);
    
            // 太陽データを含むJSONレスポンスを返す
            return response()->json([
                'success' => true,
                'solar' => $solar,
            ]);
    
        } catch (\Exception $e) {
            // 太陽記録が見つからない場合の例外を処理する
            return response()->json([
                'success' => false,
                'message' => 'Solar record not found.',
            ], 404); // 必要に応じてステータスコードを調整できます
        }
    }

    /**
     * ストレージ内の指定されたリソースを更新します。
     */
    public function update(Request $request, string $id)
    {
        // リクエストデータを検証する
        $request->validate([
            'date' => 'required|date',
            'customer_number' => 'required|numeric',
            'serial_number' => 'required|string',
            'electricity_number' => 'required|string',
            'connection_date' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'generation_billing' => 'required|numeric',
            'power_sales' => 'required|numeric',
            'self_consumption' => 'required|numeric',
            'meter_reading_date' => 'required|numeric',
            'address' => 'string',
            'billing' => 'string',
        ]);

        // IDでSolarレコードを検索する
        $solar = Solar::findOrFail($id);

        // 太陽の記録を更新
        $solar->update([
            'date' => $request->date,
            'customer_number' => $request->customer_number,
            'serial_number' => $request->serial_number,
            'electricity_number' => $request->electricity_number,
            'connection_date' => $request->connection_date,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'generation_billing' => $request->generation_billing,
            'power_sales' => $request->power_sales,
            'self_consumption' => $request->self_consumption,
            'meter_reading_date' => $request->meter_reading_date,
            'address' => $request->address,
            'billing' => $request->billing,
            'comment' => $request->comment ? $request->comment : ''
        ]);

        // オプションで、成功を示す応答を返すことができます
        return response()->json(['success' => true, 'message' => 'Solar record updated successfully']);
    }

    /**
     * 指定されたリソースをストレージから削除します。
     */
    public function destroy(string $id)
    {
        //
    }
}
