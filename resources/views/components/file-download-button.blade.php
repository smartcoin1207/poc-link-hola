@props(['link' => '', 'filename' => ''])

<a href="{{ Storage::url($link) }}" download="{{$filename}}" class="text-base font-medium ml-2 underline py-1 px-2 text-sm font-medium text-gray-900 focus:outline-none bg-gray-200 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
    {{__('ダウンロード')}}
</a>
