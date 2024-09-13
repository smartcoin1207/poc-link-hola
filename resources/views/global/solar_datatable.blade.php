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
        });
    }
</script>   