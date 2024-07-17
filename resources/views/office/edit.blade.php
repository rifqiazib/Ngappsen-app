@extends('layout.app')

@section('content')
    <div class="p-4 sm:ml-64">
        @include('layout.alert')
        <div class="flex items-center">
            <h1 class="text-lg font-bold dark:text-white mb-4">Edit Office Location Data</h1>
        </div>
        <div class="p-4 bg-neutral border rounded-lg  mt-14">
            <div class="relative overflow-x-auto">
                <form action="{{ route('office.update', ['id' => $offices->id]) }}" method="POST" class="max-w-sm mx-auto">
                    @method('PUT')
                    @csrf
                    <div class="mb-5">
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                        <input type="string" id="location" name="location" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ $offices->location }}" required />
                    </div>
                    <div class="mb-5">
                        <label for="radius" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Radius</label>
                        <input type="radius" id="radius" name="radius" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ $offices->radius }}" required />
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Data</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>     
@endsection

@section('extra-js')
@endsection