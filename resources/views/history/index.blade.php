@extends('layout.app')

@section('content')
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
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
                @foreach($attedances as $attedance)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $attedance->date }}
                    </th>
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
@endsection

@section('extra-js')
@endsection