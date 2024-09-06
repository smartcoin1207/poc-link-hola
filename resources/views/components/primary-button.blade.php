@props(['submit' => 'submit', 'disabled' => false])

@php
    $classes = 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150';
    
    // Conditionally add classes based on the disabled state
    if ($disabled) {
        $classes .= ' bg-gray-400 text-gray-800 cursor-not-allowed';
    } else {
        $classes .= ' bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900';
    }
@endphp

<button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['type' => $submit, 'class' => $classes]) }}>
    {{ $slot }}
</button>
