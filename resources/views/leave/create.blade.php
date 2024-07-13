@extends('layout.app')

@section('content')
    <div class="flex justify-center">
        <div class="bg-zinc-50 p-8 w-6/12 rounded">  
            <form method="POST" action="{{ route('leave.store') }}" id="leave_app" class="max-w-md mx-auto ">
                @csrf
                <h1>Leave Application</h1>
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
                        <option selected>izin/sakit</option>
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

    <div class="relative overflow-x-auto mt-4">
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