<x-app-layout>
    <div class="container mt-4">
        <div class="row">
           <div class="col d-flex justify-content-end">
                <a href="{{ route('solar.calculate.upload') }}" class="btn btn-primary" >{{__('CSVアップロード')}}</a>
           </div>
        </div>
        <div class="jumbotron">
            <div class="row">   
                @php
                $months = [
                1 => '1月',
                2 => '2月',
                3 => '3月',
                4 => '4月',
                5 => '5月',
                6 => '6月',
                7 => '7月',
                8 => '8月',
                9 => '9月',
                10 => '10月',
                11 => '11月',
                12 => '12月'
                ];
                $defaultMonth = 4; // Set default month to April
                @endphp

                <div class="form-inline">
                    <label for="email" style="margin-right: 15px;">年別集計の日付範囲</label>
                    <select name="start_month" id="start_month" class="form-control" style="width: 100px;">
                        @foreach ($months as $key => $month)
                        <option value="{{ $key }}" {{ $key == $defaultMonth ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom: 30px; justify-content: center;">
                <div style="text-align: center; font-weight: 600; margin-bottom: 20px;">「太陽光」計算</div>
                <table border="1" class="table table-hover" id="solar_light_calculate_table" style="align-items: center;">
                    <thead style="text-align: center;">
                        <tr>
                            <th></th> <!-- Empty cell for alignment -->
                            @foreach($processedData as $year => $data)
                            @if($year != 'all_years')
                            <th>{{ $year }}年度</th>
                            @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
                        <tr>
                            <td>自家消費(kWh)</td>
                            @foreach($processedData as $year => $data)
                            @if($year != 'all_years')
                            <td>{{ $data['total_self_consumption'] }}</td>
                            @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>発電量(kWh)</td>
                            @foreach($processedData as $year => $data)
                            @if($year != 'all_years')
                            <td>{{ $data['total_generation_billing'] }}</td>
                            @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>余剰売電(kWh)</td>
                            @foreach($processedData as $year => $data)
                            @if($year != 'all_years')
                            <td>{{ $data['total_power_sales'] }}</td>
                            @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>
            <hr>
            <hr>

            <div class="row" style="margin-bottom: 30px; margin-top: 30px; justify-content: center;">
                <div style="text-align: center; font-weight: 600; margin-bottom: 20px;">排出削減量（合計）</div>
                <table border="1" class="table table-hover" id="solar_emissions_reduction_table" style="align-items: center;">
                    <thead style="text-align: center;">
                        <tr>
                            <th></th> <!-- Empty cell for alignment -->
                            @foreach($processedData as $year => $data)
                            <th>
                                @if($year == 'all_years')
                                合計
                                @else
                                {{ $year }}年度
                                @endif
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
                        <tr>
                            <td>会員数</td>
                            @foreach($processedData as $data)
                            <td>{{ $data['customer_count'] }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>プロジェクト実施後排出量 (ｔ-CO2)</td>
                            @foreach($processedData as $data)
                            <td>{{ $data['project_implement_emission'] }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>ベースライン排出量 (ｔ-CO2)</td>
                            @foreach($processedData as $data)
                            <td>{{ $data['baseline_emission'] }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>排出削減量 (ｔ-CO2)</td>
                            @foreach($processedData as $data)
                            <td>{{ $data['reduction_emission'] }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
        <hr>
        <hr>
        @include('global.solar_datatable')
    </div>

    <script>
        window.onload = function() {
            $(document).ready(function() {
                
                
                $('#missing_value_checkbox').click(function() {
                    function getQueryParam(param) {
                        const urlParams = new URLSearchParams(window.location.search);
                        return urlParams.get(param);
                    }

                    // Function to build a new URL and reload the page
                    function reloadWithParam(param, value) {
                        const urlParams = new URLSearchParams(window.location.search);
                        if (value === null) {
                            urlParams.delete(param);
                        } else {
                            urlParams.set(param, value);
                        }
                        const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
                        window.location.href = newUrl;
                    }

                    // Get the 'is_missing' parameter from the URL
                    const isMissing = getQueryParam('is_missing');
                    if (isMissing === '1') {
                        // Remove the 'is_missing' parameter from the URL
                        reloadWithParam('is_missing', null);
                    } else {
                        // Set 'is_missing' to true
                        reloadWithParam('is_missing', '1');
                    }
                });

                function updateSolarLightCalculateTable(processedData) {
                    // Clear existing table content
                    $('#solar_light_calculate_table thead').empty();
                    $('#solar_light_calculate_table tbody').empty();

                    // Get the years and sort them in descending order
                    var years = Object.keys(processedData).filter(year => year != 'all_years').sort((a, b) => b - a);

                    // Create header row
                    var headerRow = '<tr><th></th>'; // Empty cell for alignment
                    years.forEach(year => {
                        headerRow += '<th>' + year + '年度</th>';
                    });
                    headerRow += '</tr>';
                    $('#solar_light_calculate_table thead').append(headerRow);

                    // Create rows for each data category
                    var selfConsumptionRow = '<tr><td>自家消費(kWh)</td>';
                    var generationRow = '<tr><td>発電量(kWh)</td>';
                    var powerSalesRow = '<tr><td>余剰売電(kWh)</td>';

                    // Iterate over the sorted years and add to the rows
                    years.forEach(year => {
                        var data = processedData[year];
                        selfConsumptionRow += '<td>' + data.total_self_consumption + '</td>';
                        generationRow += '<td>' + data.total_generation_billing + '</td>';
                        powerSalesRow += '<td>' + data.total_power_sales + '</td>';
                    });

                    selfConsumptionRow += '</tr>';
                    generationRow += '</tr>';
                    powerSalesRow += '</tr>';

                    // Append the rows to the table body
                    $('#solar_light_calculate_table tbody').append(selfConsumptionRow);
                    $('#solar_light_calculate_table tbody').append(generationRow);
                    $('#solar_light_calculate_table tbody').append(powerSalesRow);
                }

                function updateSolarEmissionsReductionTable(processedData) {
                    // Clear existing table content
                    $('#solar_emissions_reduction_table thead').empty();
                    $('#solar_emissions_reduction_table tbody').empty();

                    // Get the years and sort them in descending order
                    var years = Object.keys(processedData).sort((a, b) => {
                        if (a === 'all_years') return 1;
                        if (b === 'all_years') return -1;
                        return b - a;
                    });

                    // Create header row
                    var headerRow = '<tr><th></th>'; // Empty cell for alignment
                    years.forEach(year => {
                        if (year === 'all_years') {
                            headerRow += '<th>合計</th>';
                        } else {
                            headerRow += '<th>' + year + '年度</th>';
                        }
                    });
                    headerRow += '</tr>';
                    $('#solar_emissions_reduction_table thead').append(headerRow);

                    // Create rows for each data category
                    var customerCountRow = '<tr><td>会員数</td>';
                    var projectImplementEmissionRow = '<tr><td>プロジェクト実施後排出量 (ｔ-CO2)</td>';
                    var baselineEmissionRow = '<tr><td>ベースライン排出量 (ｔ-CO2)</td>';
                    var reductionEmissionRow = '<tr><td>排出削減量 (ｔ-CO2)</td>';

                    // Iterate over the sorted years and add to the rows
                    years.forEach(year => {
                        var data = processedData[year];
                        customerCountRow += '<td>' + data.customer_count + '</td>';
                        projectImplementEmissionRow += '<td>' + data.project_implement_emission + '</td>';
                        baselineEmissionRow += '<td>' + data.baseline_emission + '</td>';
                        reductionEmissionRow += '<td>' + data.reduction_emission + '</td>';
                    });

                    customerCountRow += '</tr>';
                    projectImplementEmissionRow += '</tr>';
                    baselineEmissionRow += '</tr>';
                    reductionEmissionRow += '</tr>';

                    // Append the rows to the table body
                    $('#solar_emissions_reduction_table tbody').append(customerCountRow);
                    $('#solar_emissions_reduction_table tbody').append(projectImplementEmissionRow);
                    $('#solar_emissions_reduction_table tbody').append(baselineEmissionRow);
                    $('#solar_emissions_reduction_table tbody').append(reductionEmissionRow);
                }

                //Change start month of year.
                $('#start_month').change(function() {
                    var selectedMonth = $(this).val();

                    $.ajax({
                        url: "{{ route('solar.calculate.processed_data') }}", // Replace with your backend endpoint
                        method: 'get',
                        data: {
                            month: selectedMonth,
                            _token: '{{ csrf_token() }}' // Laravel CSRF token
                        },
                        success: function(response) {
                            let processedData = response.processedData;

                            if (processedData) {
                                console.log(processedData)
                                updateSolarLightCalculateTable(processedData);
                                updateSolarEmissionsReductionTable(processedData);
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors
                            console.error(error);
                        }
                    });
                });
            });
        }
    </script>
</x-app-layout>