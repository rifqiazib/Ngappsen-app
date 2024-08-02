@extends('layout.app')

@section('content')
<div class="flex justify-center">
    <div class="bg-zinc-50 p-8 w-6/12 rounded">  
            <form method="POST" action="{{ route('leave.store') }}" id="leave_app" class="max-w-md mx-auto ">
                @csrf
                <div class="flex">
                    <a href="{{ route('dashboard') }}">
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class=" ml-4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                            </svg>
                        </button>
                    </a>
                    <h1 class="ml-4  text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-xl dark:text-white">Leave Application</h1>
                </div>
                <div class="flex justify-between">
                    <div>
                        <label for="default" class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white">Start</label>
                        <input type="date" id="date_start" name="date_start">
                    </div>
                    <div>
                        <label for="default" class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white">End</label>
                        <input type="date" id="date_end" name="date_end">
                    </div>
                </div>
                <div class="relative z-0 w-full mb-5 mt-5 group">
                    <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose</option>
                        <option value="i">izin</option>
                        <option value="s">sakit</option>
                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 mt-5 group">
                    <label for="explanation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                    <textarea id="explanation" name="explanation" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""></textarea>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
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