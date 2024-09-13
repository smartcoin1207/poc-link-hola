@props([
    'title' => 'Container Title',
    'description' => 'Container description...',
    'name' => 'File upload Name',
    'link' => '',
    'date' => '',
    'tooltip_title' => ''
])

<div {!! $attributes->merge(['class' => 'p-4 border rounded-lg shadow-md bg-white position-relative file-upload-container']) !!}>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <x-input-label for="project_mid_longterm_plan" :value="$title" :title="$tooltip_title" />
            <p class="text-xs text-gray-500">{!! nl2br(e($description)) !!}</p>
        </div>
        <button type="button" class="text-gray-400 position-absolute btn-close" style="top: 0.625rem; right: 0.625rem;" aria-label="Close" onclick="removeContainer(this)">
        </button>
    </div>
    @if($link)
    <div class="mt-2 flex items-center space-x-2 text-gray-700">
        <div class="font-semibold">
            {{ __('Attached file') }}:
        </div>
        <div>
            <a href="{{ Storage::url($link) }}" target="_blank" class="underline hover:text-blue-500">{{ Str::limit(basename($link), 20) }}</a>
            <div>{{$date}}</div>
        </div>
        <a href="{{ Storage::url($link) }}" download="{{ $link }}" class="text-blue-500 hover:text-blue-700">
            <i class="fa fa-download"></i>
        </a>
    </div>
    @endif  

    <div class="mt-4 d-flex justify-content-end">
        {{ $slot }}
        <x-custom-file-upload name="{{$name}}" />
    </div>
</div>

<script>
function removeContainer(button) {
    // Find the closest parent div with the class 'file-upload-container' and remove it
    var container = button.closest('.file-upload-container');
    if (container) {
        container.remove();
    }
}
</script>
