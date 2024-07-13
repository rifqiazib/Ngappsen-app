@extends('layout.app')

@section('content')
<div class="p-4 sm:ml-64">
        <div class="flex items-center">
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
            <h1>Aprroval Menu</h1>
        </div>
        
        <div class="p-4 bg-neutral border rounded-lg  mt-14">
            <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alasan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaves as $leave)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $leave->date_start }}
                            <span>-</span>
                            {{ $leave->date_end }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $leave->status }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $leave->explanation }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $leave->status_approved }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div> 
       
        @if (!$leaves->isEmpty())
        <div class="flex flex-col items-center mt-4">
            <!-- Help text -->
            <span class="text-sm text-gray-700 dark:text-gray-400">
                Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $leaves->firstItem() }}</span> 
                to <span class="font-semibold text-gray-900 dark:text-white">{{ $leaves->lastItem() }}</span> 
                of <span class="font-semibold text-gray-900 dark:text-white">{{ $leaves->total() }}</span> Entries
            </span>
            <!-- Buttons -->
            <div class="inline-flex mt-2 xs:mt-0">
                @if ($leaves->previousPageUrl())
                <a href="{{ $departments->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Prev
                </a>
                @else
                <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-400 rounded-l cursor-not-allowed dark:bg-gray-600 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" disabled>
                    Prev
                </button>
                @endif

                @if ($leaves->nextPageUrl())
                <a href="{{ $departments->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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
        $("#leave_app").submit(function (event) {
            var date_start = $("#date_start").val();
            var date_end = $("#date_end").val();
            var status = $("#status").val();
            var explanation = $("#explanation").val();

            if (date_start == "") {
                Swal.fire({
                    title: 'Whoops!',
                    text: 'Tanggal Mulai Harus Diisi',
                    icon: 'warning',
                });
                event.preventDefault(); // Mencegah submit form jika validasi gagal
            } else if (date_end == "") {
                 Swal.fire({
                    title: 'Whoops!',
                    text: 'Tanggal Selesai Harus Diisi',
                    icon: 'warning',
                });
                event.preventDefault();
            } else if (status == "") {
                Swal.fire({
                    title: 'Whoops!',
                    text: 'Status Harus Diisi',
                    icon: 'warning',
                });
                event.preventDefault();
            } else if (explanation == "") {
                Swal.fire({
                    title: 'Whoops!',
                    text: 'Keterangan Harus Diisi',
                    icon: 'warning',
                });
                event.preventDefault();
            }
        });
    });
    </script>
@endsection