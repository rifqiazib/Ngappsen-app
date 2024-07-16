@extends('layout.app')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="flex items-center mt-8">
            <h1 class="text-lg font-bold dark:text-white mb-4">Attedance Data</h1>
        </div>
        <div class="p-4 bg-neutral border rounded-lg">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Entry Time
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Home Time
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Entry Location
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Home Location
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($attedances->isEmpty())
                            <p class="flex items-center justify-center mb-4 text-gray-700 dark:text-gray-400">Data Staff Masih Kosong.</p>
                        @else
                        @endif
                        @foreach($attedances as $index => $attedance)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $index + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $attedance->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $attedance->date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $attedance->entry_time }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $attedance->home_time }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $attedance->entry_location }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $attedance->home_location }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
       
        @if (!$attedances->isEmpty())
        <div class="flex flex-col items-center mt-4">
            <!-- Help text -->
            <span class="text-sm text-gray-700 dark:text-gray-400">
                Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $attedances->firstItem() }}</span> 
                to <span class="font-semibold text-gray-900 dark:text-white">{{ $attedances->lastItem() }}</span> 
                of <span class="font-semibold text-gray-900 dark:text-white">{{ $attedances->total() }}</span> Entries
            </span>
            <!-- Buttons -->
            <div class="inline-flex mt-2 xs:mt-0">
                @if ($attedances->previousPageUrl())
                <a href="{{ $attedances->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Prev
                </a>
                @else
                <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-400 rounded-l cursor-not-allowed dark:bg-gray-600 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" disabled>
                    Prev
                </button>
                @endif

                @if ($attedances->nextPageUrl())
                <a href="{{ $attedances->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Next
                </a>
                @else
                <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-400 border-0 border-s border-gray-700 rounded-r cursor-not-allowed dark:bg-gray-600 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" disabled>
                    Next
                </button>
                @endif
            </div>
        </div>
        @endif
    </div>  
@endsection

@section('extra-js')
@endsection