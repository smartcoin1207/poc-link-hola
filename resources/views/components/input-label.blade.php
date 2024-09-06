@props(['value', 'title' => ''])

<div class="flex">
    <label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-gray-700']) }}>
        {{ $value ?? $slot }}
    </label>

    @if($title)
    <div data-toggle="tooltip" data-placement="top" title="{{$title}}"
        class="ml-2 text-blue-500 hover:text-blue-700 focus:outline-none flex items-center justify-center w-6 h-6">
        <i class="fa fa-info-circle"></i>
    </div>
    @endif
</div>
