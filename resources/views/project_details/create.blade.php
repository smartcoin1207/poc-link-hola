<x-app-layout>
    @include('project_details.form', [
        'form_submit_url' => route('project.detail.store'), 
        'is_update' => false
    ])
</x-app-layout>