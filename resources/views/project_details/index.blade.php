<x-app-layout>
    @csrf
    <div class="mt-4  font-bold text-2xl text-center">{{__('プロジェクト一覧')}}</div>

    <div class="row flex w-full max-w-4xl m-auto justify-end">
        @if(!($isEvaluator ?? ''))
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="location.href='{{ route('project.detail.create') }}'">
            {{ __('Register a new project') }}
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </button>
        @endif
    </div>
    
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 ">
        <div class="w-full max-w-6xl mt-6 mb-4 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{__('Project Number')}}</th>
                    <th>{{__('Project Name')}}</th>

                    @if(!($isEvaluator ?? ''))
                    <th>{{__('Register Completed Status')}}</th>
                    @endif

                    <th>{{__('Co2 Credit')}}</th>

                    @if($isEvaluator ?? '')
                    <th>{{__('Project Evaluate')}}</th>
                    @endif

                    <th>{{__('Application Date')}}</th>
                    <th>{{__('Validation Date')}}</th>
                    <th>{{__('Verification Date')}}</th>
                    <th>{{__('Credit Date')}}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($projectDetails as $projectDetail)
                    <tr>
                        <td>{{ $projectDetail->project_number }}</td>
                        <td>{{ $projectDetail->project_name }}</td>

                        @if(!($isEvaluator ?? ''))
                        <td>
                            @if($projectDetail->is_completed)
                                <span class="px-2 py-1 text-xs font-light text-white bg-green-500 rounded-full">
                                    {{ __('Completed') }}
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-light text-white bg-red-500 rounded-full">
                                    {{ __('Not Completed') }}
                                </span>
                            @endif
                        </td>
                        @endif

                        <td class="text-center">
                            @if(($projectDetail->project_application_steps ?? '') == 'credit')
                            <span class="inline-flex items-center justify-center w-7 h-7 bg-green-500 rounded-full">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            @endif
                        </td>

                        @if($isEvaluator ?? '')
                            <td>
                                <form action="{{ route('project.detail_evaluate.approve', $projectDetail->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-2 dark:bg-green-400 dark:hover:bg-green-500 dark:focus:ring-green-600">
                                        承認
                                    </button>
                                </form>

                                <form action="{{ route('project.detail_evaluate.reject', $projectDetail->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-red-400 dark:hover:bg-red-500 dark:focus:ring-red-600">
                                        拒否
                                    </button>
                                </form>
                            </td>
                        @endif

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td>
                            <a href="{{ ($isEvaluator ?? '') ? route('project.detail_evaluate.show', $projectDetail->id) : route('project.detail.show', $projectDetail->id) }}" class="btn btn-primary">表示</a>
                            @if(!($isEvaluator ?? ''))
                            <a href="{{ ($isEvaluator ?? '') ? route('project.detail.edit', $projectDetail->id) : route('project.detail.edit', $projectDetail->id) }}" class="btn btn-warning">編集</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</x-app-layout>