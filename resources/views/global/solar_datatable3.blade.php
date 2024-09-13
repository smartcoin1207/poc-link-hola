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
        <!-- Edit Solar Modal -->
        <div class="modal fade" id="editSolarModal" tabindex="-1" role="dialog" aria-labelledby="editSolarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSolarModalLabel" style="text-align: center; font-weight: 600;">太陽データの編集</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form id="editSolarForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            @include('solar.edit_solar')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                            <button type="submit" class="btn btn-primary">変更を保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">{{ $pageTitle ?? 'List'}}</h4>
                    </div>
                        <div class="card-action">
                            {!! $headerAction ?? '' !!}
                        </div>
                    </div>
                    <div class="card-body px-0">
                    <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table text-center table-striped w-100'],true) }}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            $(document).ready(function() {
                // Handle edit button click
                $('.edit-btn').click(function() {
                    var solarId = $(this).data('id');
                    var url = "{{ route('solar.calculate.edit', ['solar_calculate' => ':id']) }}";
                    url = url.replace(':id', solarId);

                    // Fetch data using AJAX
                    $.get(url, function(data) {
                        $('#editSolarForm').attr('action', "{{ route('solar.calculate.update', ['solar_calculate' => ':id']) }}");
                        $('#editSolarForm').attr('action', $('#editSolarForm').attr('action').replace(':id', solarId));
                        $('#editSolarModal').modal('show');

                        if (data.success) {
                            const solar = data.solar;
                            $('#date').val(solar.date);
                            $('#customer_number').val(solar.customer_number);
                            $('#serial_number').val(solar.serial_number);
                            $('#electricity_number').val(solar.electricity_number);
                            $('#connection_date').val(solar.connection_date);
                            $('#start_date').val(solar.start_date);
                            $('#end_date').val(solar.end_date);
                            $('#generation_billing').val(solar.generation_billing);
                            $('#power_sales').val(solar.power_sales);
                            $('#self_consumption').val(solar.self_consumption);
                            $('#meter_reading_date').val(solar.meter_reading_date);
                            $('#address').val(solar.address);
                            $('#billing').val(solar.billing);
                            $('#comment').val(solar.comment);
                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');
                        }
                    });
                });

                // Handle form submission
                $('#editSolarForm').submit(function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            $('#editSolarModal').modal('hide');
                            // Handle success message or refresh table, etc.
                            location.reload(); // Example: Reload the page
                        },
                        error: function(xhr) {
                            // Handle errors
                            err = xhr.responseJSON;
                            errors = err?.errors;

                            // Clear previous errors
                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');

                            if (errors) {
                                // Loop through the errors object
                                $.each(errors, function(key, value) {
                                    // Find the input field with the matching name attribute
                                    var inputField = $('[name="' + key + '"]');

                                    // Add the is-invalid class to the input field
                                    inputField.addClass('is-invalid');

                                    // Append the error message after the input field
                                    inputField.after('<div class="invalid-feedback">' + value[0] + '</div>');
                                });
                            }
                        }
                    });
                });

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