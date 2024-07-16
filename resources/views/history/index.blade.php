@extends('layout.app')

@section('content')
<div class="p-4 flex flex-col justify-center">
    <div class="flex w-16 ">
        <div class="flex items-center">
            <h2 class=" text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-xl dark:text-white">HISTORY</h2>
        </div>
        <a href="{{ route('dashboard') }}">
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class=" ml-4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
            </button>
        </a>
    </div>
    <div class="w-full p-4 bg-neutral border rounded-lg mt-4">
            <h6 class="text-lg font-bold dark:text-white mb-4">Data Absen</h6>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Datang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pulang
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($attedances->isEmpty())
                            <p class="flex items-center justify-center mb-4 text-gray-700 dark:text-gray-400">Data Departemen Masih Kosong.</p>
                        @else
                        @endif
                        @foreach($attedances as $index => $attedance)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $index + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $attedance->date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $attedance->entry_time }}
                            </td> 
                            <td class="px-6 py-4">
                                {{ $attedance != null && $attedance->home_time != null ? $attedance->home_time : 'Belum Absen' }}
                            </td>           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
        <div class="w-full p-4 bg-neutral border rounded-lg mt-4">
            <h6 class="text-lg font-bold dark:text-white mb-4">Data Cuti</h6>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
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
                        @if ($leaves->isEmpty())
                            <p class="flex items-center justify-center mb-4 text-gray-700 dark:text-gray-400">Data Cuti Masih Kosong.</p>
                        @else
                        @endif
                        @foreach($leaves as $index => $leave)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $index + 1 }}
                            </th>
                            <td class="px-6 py-4">
                            {{ $leave->date_start }}
                            <span>-</span>
                            {{ $leave->date_end }}
                            </td>
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
</div> 

@endsection

@section('extra-js')
@endsection