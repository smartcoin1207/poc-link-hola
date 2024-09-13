@props(['name'])

<div class="position-relative d-flex justify-content-end align-items-center">
    <div class="d-flex align-items-center">
        <!-- Display the selected file name here -->
        <span id="{{ $name }}-file-name" class="me-2 text-sm text-gray-500"></span>

        <!-- Hidden file input -->
        <input id="{{ $name }}" type="file" name="{{ $name }}" hidden onchange="document.getElementById('{{ $name }}-file-name').textContent = this.files[0] ? this.files[0].name : ''">
    </div>
    
    <label class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-gray-200 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" for="{{ $name }}">
        {{__('choose file')}}
    </label>
</div>