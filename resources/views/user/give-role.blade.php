@extends('layout.app')

@section('content')
    <div class="p-4 sm:ml-64">
        @include('layout.alert')
        <div class="flex items-center">
            <h1 class="text-lg font-bold dark:text-white mt-10 mb-4">Add User Role</h1>
        </div>
        <div class="p-4 bg-neutral border rounded-lg mt-4">
            <div class="relative overflow-x-auto">
                <form action="{{ route('user.storeGiveRole', ['id' => $user->id]) }}" method="POST" class="">
                    @csrf
                 
                    <div class="w-full">
                        <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</span>
                        </div>
                        <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $user->email }}</span>
                        </div>
                        <div class="mb-5">
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                            <select id="edit-role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->name }}" required="">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-start w-3/4">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Data</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>     
@endsection

@section('extra-js')
@endsection