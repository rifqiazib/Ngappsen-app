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
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Posisi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Department
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mulai Cuti
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Akhir Cuti
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaves as $index => $leave)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $index + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $leave->user->staff->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $leave->user->staff->position ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $leave->user->staff->department->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ date('d-m-Y', strtotime($leave->date_start)) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ date('d-m-Y', strtotime($leave->date_end)) }}
                        </td>
                        <td class="px-6 py-4">
                            @if($leave->status == 'i')
                                Izin
                            @elseif($leave->status == 's')
                                Sakit
                            @else
                                {{ $leave->status }}
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $leave->explanation }}
                        </td>
                        <td class="px-6 py-4">
                            @if($leave->status_approved == 0)
                                Pending
                            @elseif($leave->status_approved == 1)
                                Approved
                            @elseif($leave->status_approved == 2)
                                Rejected
                            @else
                            {{ $leave->status_approved }}
                            @endif
                        </td>
                        <td>
                            @if($leave->status_approved == 0)
                             <!-- Modal toggle -->
                            <button data-modal-target="crud-modal" 
                                    data-id="{{ $leave->id }}"
                                    data-modal-toggle="crud-modal" class=" ml-4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z"/>
                                    <path fill-rule="evenodd" d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <!-- Main modal -->
                            <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Aprroved Leave Data
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form method="POST" action="{{ route('leave.approval', $leave->id) }}" class="p-4 md:p-5">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" id="edit-id" value="{{ $leave->id }}">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-2">
                                                <label for="leave" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Approval</label>
                                                <select id="edit-leave" name="status_approved" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option selected>Select Approval</option>
                                                    <option value="1" required="">Approved</option>
                                                    <option value="2" required="">Rejected</option>
                                                </select>
                                            </div>
                                            </div>
                                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @else
                             <!-- Modal toggle -->
                             <button data-modal-target="popup-modal" 
                                    data-id="{{ $leave->id }}"
                                    data-modal-toggle="popup-modal" class=" ml-4 block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
                                    </svg>
                            </button>
                            <!-- Main modal -->
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
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to cancel this approval?</h3>
                                                <div class="flex justify-center items">
                                                    <form id="delete-form" action="{{ route('leave.approval', $leave->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id" id="edit-id" value="{{ $leave->id }}">
                                                        <input type="hidden" name="status_approved" id="edit-status" value="0">
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
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">No data available</td>
                    </tr>
                @endforelse
                    
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
                <a href="{{ $leaves->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Prev
                </a>
                @else
                <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-400 rounded-l cursor-not-allowed dark:bg-gray-600 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" disabled>
                    Prev
                </button>
                @endif

                @if ($leaves->nextPageUrl())
                <a href="{{ $leaves->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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

    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('[data-modal-toggle="crud-modal"]');

            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    document.getElementById('edit-id').value = id;
                   

                    document.getElementById('edit-modal').classList.remove('hidden');
                });
            });

            const closeModalButton = document.querySelector('[data-modal-toggle="edit-modal"].text-gray-400');
            closeModalButton.addEventListener('click', function() {
                document.getElementById('edit-modal').classList.add('hidden');
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('[data-modal-toggle="popup-modal"]');

            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    document.getElementById('edit-id').value = id;
                   

                    document.getElementById('edit-modal').classList.remove('hidden');
                });
            });

            const closeModalButton = document.querySelector('[data-modal-toggle="edit-modal"].text-gray-400');
            closeModalButton.addEventListener('click', function() {
                document.getElementById('edit-modal').classList.add('hidden');
            });
        });
    </script>
@endsection