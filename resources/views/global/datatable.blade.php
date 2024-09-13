@push('scripts')
    {{ $dataTable->scripts() }}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                // Open the modal when the page is loaded and there is a success message
                $('#successModal').modal('show');
            @endif
        });
    </script>
@endpush
<x-app-layout :assets="$assets ?? []">
<div class="mt-4">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">{{ __('User List') }}</h4>
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

   <!-- Success Modal -->
   <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">{{ __('アカウントを正常に作成しました。') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body alert alert-success">
                    {!! session('success') !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
