@extends('layout.app')

@section('content')
    @role('Staff')
    <div class="ml-4 mr-4 p-4">
        <div class="w-full p-6 bg-zinc-50 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex">
                @if(Auth::check())
                    <h5 class="text-xl font-bold dark:text-white">Halo </h5>
                    <h6 class="ml-4 text-lg font-bold dark:text-white">{{ Auth::user()->name }}</h6>
                @endif
                <div id="clock" class="ml-40">
                    <div id="time" class="text-xl font-medium text-gray-900 dark:text-white">
                        <div clas="flex">
                            <span id="hours" >00</span>       
                            <span id="minutes">00</span>
                            <span id="seconds">00</span>
                            <span id="amOrpm">AM</span>
                        </div>
                    </div>
                    <div id="cal" class="text-xl font-medium text-gray-900 dark:text-white">
                        <span id="fullyear">25 Januari 2021</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-between space-x-4 mt-8">
                <div class="w-full"> 
                    <a href="#" class="block w-full p-6 bg-green-200 border border-gray-200 rounded-lg shadow hover:bg-green-300 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">ABSEN MASUK </h5>
                        <p class="text-xl font-medium text-gray-900 dark:text-white">{{ $attedance != null && $attedance->entry_time != null ? $attedance->entry_time : "Belum Absen" }}</p>
                    </a>
                </div>
                <div class="w-full"> 
                    <a href="#" class="block w-full p-6 bg-red-200 border border-gray-200 rounded-lg shadow hover:bg-red-300 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">ABSEN KELUAR</h5>
                        <p class="text-xl font-medium text-gray-900 dark:text-white">{{ $attedance != null && $attedance->home_time != null ? $attedance->home_time : 'Belum Absen' }}</p>
                    </a>
                </div>
            </div>
            <a href="{{ route('attedance.create') }}" class="flex justify-center mt-4 items-center px-4 py-2 text-sm font-medium text-center text-black bg-zinc-200 rounded-lg hover:bg-zinc-300 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-zinc-400 dark:focus:ring-blue-800">
                <span class="text-xl font-medium text-gray-900 dark:text-white">ABSEN</span>
            </a>
            <div class="mt-5 border-t-2 border-zinc-100 w-full">
                <div class="flex items-center justify-around space-x-4 mt-5">
                    <a href="{{ route('leave.create') }}" class="flex-col w-30 items-center px-4 py-2 text-sm font-medium text-center text-black bg-zinc-200 rounded-lg hover:bg-zinc-300 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <div class="flex items-center flex-col">
                            <svg class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                            </svg>
                            <span>CUTI</span>
                        </div>
                    </a>
                    <a href="{{ route('history') }}" class="flex-col w-30 items-center px-4 py-2 text-sm font-medium text-center text-black bg-zinc-200 rounded-lg hover:bg-zinc-300 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <div class="flex flex-col items-center">
                            <svg class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 24 24">
                                <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                            </svg>
                            <span>HISTORI</span>
                        </div>
                    </a>
                    <a href="{{ route('logout') }}" class="flex-col w-30 items-center px-4 py-2 text-sm font-medium text-center text-black bg-zinc-200 rounded-lg hover:bg-zinc-300 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <div class="flex flex-col items-center">
                            <svg class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 24 24">
                                <path stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2"/>
                            </svg>
                            <span>SIGN OUT</span>
                        </div>
                    </a>
                </div>
            </div>
        </div> 
        <div class="flex justify-center gap-36 mt-4">
            <div class="relative inline-flex items-center">
                <div class="flex flex-col items-center bg-zinc-50 p-4 border rounded">
                    <div class="flex justify-center items-center p-2  mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M10 2a3 3 0 0 0-3 3v1H5a3 3 0 0 0-3 3v2.382l1.447.723.005.003.027.013.12.056c.108.05.272.123.486.212.429.177 1.056.416 1.834.655C7.481 13.524 9.63 14 12 14c2.372 0 4.52-.475 6.08-.956.78-.24 1.406-.478 1.835-.655a14.028 14.028 0 0 0 .606-.268l.027-.013.005-.002L22 11.381V9a3 3 0 0 0-3-3h-2V5a3 3 0 0 0-3-3h-4Zm5 4V5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1h6Zm6.447 7.894.553-.276V19a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-5.382l.553.276.002.002.004.002.013.006.041.02.151.07c.13.06.318.144.557.242.478.198 1.163.46 2.01.72C7.019 15.476 9.37 16 12 16c2.628 0 4.98-.525 6.67-1.044a22.95 22.95 0 0 0 2.01-.72 15.994 15.994 0 0 0 .707-.312l.041-.02.013-.006.004-.002.001-.001-.431-.866.432.865ZM12 10a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Notifications</span>
                        <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">{{ $recapAttedanceUser->total_attedance }}</div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-medium  text-gray-500 dark:text-gray-400">Hadir</span>
                    </div>
                </div>
            </div>
            <div class="relative inline-flex items-center">
                <div class="flex flex-col items-center bg-zinc-50 p-4 border rounded">
                    <div class="flex justify-center items-center p-2  mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Notifications</span>
                        <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">{{ $recapAttedanceUser->total_late }}</div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-medium  text-gray-500 dark:text-gray-400">Terlambat</span>
                    </div>
                </div>
            </div>
            <div class="relative inline-flex items-center">
                <div class="flex flex-col items-center bg-zinc-50 p-4 border rounded">
                    <div class="flex justify-center items-center p-2  mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Notifications</span>
                        <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">{{ $recapLeaveUser->total_permit ?? 0}}</div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-medium  text-gray-500 dark:text-gray-400">Izin</span>
                    </div>
                </div>
            </div>
            <div class="relative inline-flex items-center">
                <div class="flex flex-col items-center bg-zinc-50 p-4 border rounded">
                    <div class="flex justify-center items-center p-2  mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M18 5.05h1a2 2 0 0 1 2 2v2H3v-2a2 2 0 0 1 2-2h1v-1a1 1 0 1 1 2 0v1h3v-1a1 1 0 1 1 2 0v1h3v-1a1 1 0 1 1 2 0v1Zm-15 6v8a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-8H3ZM11 18a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1a1 1 0 1 0-2 0v1h-1a1 1 0 1 0 0 2h1v1Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="sr-only">Notifications</span>
                        <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">{{ $recapLeaveUser->total_sick ?? 0}}</div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-medium  text-gray-500 dark:text-gray-400">Sakit</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
    @role('Admin')
    <div class="p-4 sm:ml-64">
        <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-4">
        <h2 class="mb-8 text-3xl font-extrabold  leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Dashboard</h2>
            <div class="flex flex-row justify-between gap-4 mb-4">
                <div class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700">
                    <div class="flex gap-4">
                        <div class="flex justify-center items-center p-2  mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-medium  text-gray-500 dark:text-gray-400">{{ $recapAttedance->total_late }}</span>
                            <span class="font-medium  text-gray-500 dark:text-gray-400">Karyawan Terlambat</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700">
                    <div class="flex gap-4">
                        <div class="flex justify-center items-center p-2  mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-medium  text-gray-500 dark:text-gray-400">{{ $recapAttedance->total_attedance }}</span>
                            <span class="font-medium  text-gray-500 dark:text-gray-400">Karyawan Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700">
                    <div class="flex gap-4">
                        <div class="flex justify-center items-center p-2  mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-medium  text-gray-500 dark:text-gray-400">{{ $recapLeave->total_permit }}</span>
                            <span class="font-medium  text-gray-500 dark:text-gray-400">Karyawan Izin</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700">
                    <div class="flex gap-4">
                        <div class="flex justify-center items-center p-2  mb-2 bg-gray-200 dark:bg-gray-600 rounded-full w-[48px] h-[48px] max-w-[48px] max-h-[48px]">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M18 5.05h1a2 2 0 0 1 2 2v2H3v-2a2 2 0 0 1 2-2h1v-1a1 1 0 1 1 2 0v1h3v-1a1 1 0 1 1 2 0v1h3v-1a1 1 0 1 1 2 0v1Zm-15 6v8a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-8H3ZM11 18a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1a1 1 0 1 0-2 0v1h-1a1 1 0 1 0 0 2h1v1Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-medium  text-gray-500 dark:text-gray-400">{{ $recapLeave->total_sick }}</span>
                            <span class="font-medium  text-gray-500 dark:text-gray-400">Karyawan Sakit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection

@section('extra-js')
<script>
    function SettingCurrentTime() {
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();
    var amOrPm = hours < 12 ? "AM" : "PM";
    hours = hours === 0 ? 12 : hours > 12 ? hours - 12 : hours;
    hours = addZero(hours);
    minutes = addZero(minutes);
    seconds = addZero(seconds);
    var currentDate = currentTime.getDate();
    var currentMonth = ConvertMonth(currentTime.getMonth());
    var currentYear = currentTime.getFullYear();
    var fullDateDisplay = `${currentDate} ${currentMonth} ${currentYear}`;
    document.getElementById("hours").innerText = hours;
    document.getElementById("minutes").innerText = minutes;
    document.getElementById("seconds").innerText = seconds;
    document.getElementById("amOrpm").innerText = amOrPm;
    document.getElementById("fullyear").innerText = fullDateDisplay;
    var timer = setTimeout(SettingCurrentTime, 1000);
}
function addZero(component) {
    return component < 10 ? "0" + component : component;
}
function ConvertMonth(component) {
    month_array = new Array('Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');    
    return month_array[component];
}
SettingCurrentTime();
</script>
@endsection