@extends('layout.app')

@section('content')
<div class="p-4 sm:ml-64">
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

    <div class="flex items-center">
        <h1>Set Working Hour Staff</h1>
    </div>
    <div class="">
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-4 bg-neutral border rounded-lg mt-2">
            <div class="flex gap-8 mt-4">
                <div>
                    <span>Nama :</span>
                    {{ $staff->name }}
                </div>
                <div>
                    <span>Position :</span>
                    {{ $staff->position }}
                </div>
            </div>
            <div class="relative overflow-x-auto mt-4">
                <form action="{{ route('staff.configStore') }}" method="POST" class="">
                    @csrf
                    <div class="w-full">
                    <input type="hidden" name ="id_user" value="{{ $staff->id }}">
                        @foreach($days as $day)
                        <div class="mb-5">
                            <label for="{{ $day }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $day }}</label>
                            <input type="hidden" name="days[]" value="{{ $day }}">
                            <select id="{{ $day }}" name="id_working_hour[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Select working hour</option>
                                @foreach($hours as $hour)
                                <option value="{{ $hour->id }}" required="">{{ $hour->working_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>
                    <div class="flex justify-start w-3/4">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
