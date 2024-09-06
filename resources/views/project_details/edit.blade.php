<x-app-layout>
    @include('project_details.form', [
        'form_submit_url' => route('project.detail.update', $projectDetail->id), 
        'is_update' => true
    ])
</x-app-layout>