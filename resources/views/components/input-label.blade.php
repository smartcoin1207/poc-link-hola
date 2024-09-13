@props(['value', 'title' => ''])

<div class="d-flex">
    <label {{ $attributes->merge(['class' => 'block fs-6 fw-semibold']) }}>
        {{ $value ?? $slot }}
    </label>

    @if($title)
    <div data-toggle="tooltip" data-placement="top" title="{{$title}}"
        class="ms-2 text-blue-500 hover:text-blue-700 focus:outline-none flex items-center justify-center w-6 h-6">
        <i class="fa fa-info-circle"></i>
    </div>
    @endif
</div>
