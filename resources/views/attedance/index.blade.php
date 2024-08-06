@extends('layout.app')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="flex items-center mt-8">
            <h1 class="text-lg font-bold dark:text-white mb-4">Attedance Data</h1>
        </div>
        <div class="flex mb-4 border-t-2">
            <form action="{{ route('attedance') }}" method="GET">
                <div id="date-range-picker" date-rangepicker class="flex items-center mt-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="datepicker-range-start" name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" value="{{ old('end', $filterStart) }}">
                    </div>
                    <span class="mx-4 text-gray-500">to</span>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="datepicker-range-end" name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" value="{{ old('end', $filterEnd) }}">
                    </div>
                    <div class="">
                        <button type="submit" class=" ml-4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
            <a href="{{ route('attedance') }}">
                <button type="submit" class="ml-4 mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    Reset
                </button>
            </a>
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
                                {{ date('d-m-Y', strtotime($attedance->date)) }}
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