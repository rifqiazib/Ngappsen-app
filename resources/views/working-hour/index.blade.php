@extends('layout.app')

@section('content')
    <div class="p-4 sm:ml-64">
        @include('layout.alert')
        <div class="flex items-center mt-8">
            <h1 class="text-lg font-bold dark:text-white mb-4">Working Hour Data</h1>
            <a href="{{ route('workingHour.create') }}">
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class=" ml-4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                ADD
                </button>
            </a>
        </div>
        <div class="p-4 bg-neutral border rounded-lg mt-4">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Code
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Awal Jam Masuk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jam Masuk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Akhir Jam Masuk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jam Pulang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($hours->isEmpty())
                            <p class="flex items-center justify-center mb-4 text-gray-700 dark:text-gray-400">Data Jam Kerja Masih Kosong.</p>
                        @else
                        @endif
                        @foreach($hours as $index => $hour)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $index + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $hour->working_code }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $hour->working_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $hour->early_entry }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $hour->entry_time }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $hour->end_entry }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $hour->home_time }}
                            </td>
                            <td class="flex items-center justify gap-4 px-6 py-4">
                                <a href="{{ route('workingHour.edit', ['id' => $hour->id]) }}">
                                    <button type="button" 
                                        class="ml-4 block text-white bg-yellow-300 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                                        EDIT
                                    </button>
                                </a>
                                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button"
                                data-id="{{ $hour->id }}">
                                    Delete
                                </button>
                                <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this working hour data?</h3>
                                                <div class="flex justify-center items">
                                                    <form id="delete-form" action="" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Yes, I'm sure
                                                        </button>
                                                    </form>
                                                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
       
        @if (!$hours->isEmpty())
        <div class="flex flex-col items-center mt-4">
            <!-- Help text -->
            <span class="text-sm text-gray-700 dark:text-gray-400">
                Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $hours->firstItem() }}</span> 
                to <span class="font-semibold text-gray-900 dark:text-white">{{ $hours->lastItem() }}</span> 
                of <span class="font-semibold text-gray-900 dark:text-white">{{ $hours->total() }}</span> Entries
            </span>
            <!-- Buttons -->
            <div class="inline-flex mt-2 xs:mt-0">
                @if ($hours->previousPageUrl())
                <a href="{{ $hours->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Prev
                </a>
                @else
                <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-400 rounded-l cursor-not-allowed dark:bg-gray-600 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" disabled>
                    Prev
                </button>
                @endif

                @if ($hours->nextPageUrl())
                <a href="{{ $hours->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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
    <script>
        $(document).ready(function() {
            // Menangani klik pada tombol "Delete"
            $('[data-modal-target="popup-modal"]').on('click', function() {
                // Ambil ID staff dari atribut data-id
                var workId = $(this).data('id');

                // Set nilai action pada form delete-form sesuai dengan ID staff yang dipilih
                $('#delete-form').attr('action', '/working-hour/delete/' + workId);

                // Tampilkan modal konfirmasi
                $('#popup-modal').removeClass('hidden').addClass('block');
            });

            // Menangani klik pada tombol "No, cancel"
            $('[data-modal-hide="popup-modal"]').on('click', function() {
                // Sembunyikan modal konfirmasi
                $('#popup-modal').removeClass('block').addClass('hidden');
            });
        });

    </script>
@endsection