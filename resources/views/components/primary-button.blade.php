@props(['submit' => 'submit', 'disabled' => false])

@php
    $classes = 'inline-flex align-items-center px-4 py-2 btn btn-dark';
    
    // Conditionally add classes based on the disabled state
    if ($disabled) {
        $classes .= ' bg-gray-400 text-gray-800 cursor-not-allowed';
    } else {
        $classes .= ' bg-gray-800 text-white hover:btn-link';
    }
@endphp

<button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['type' => $submit, 'class' => $classes]) }}>
    {{ $slot }}
</button>
