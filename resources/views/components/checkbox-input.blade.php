@props(['checked' => false, 'disabled' => false])

<input type="checkbox" 
       {{ $checked ? 'checked' : '' }} 
       {{ $disabled ? 'disabled' : '' }}
       {!! $attributes->merge([
           'class' => 'appearance-none border-gray-300 rounded-sm shadow-sm mr-2
                       checked:bg-black checked:border-black
                       focus:ring-indigo-100 focus:border-indigo-100
                       focus:checked:bg-black focus:checked:border-black
                       unchecked:bg-gray-400 unchecked:border-black
                       checked:text-white unchecked:text-gray-400
                       hover:checked:bg-gray-800 hover:checked:border-gray-800'
       ]) !!}>
       