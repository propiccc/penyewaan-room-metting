<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script defer src="{{asset('build/assets/app-800ca8d0.js')}}"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ env('VITE_MIDRANS_CLIENT_KEY') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('build/assets/app-26f72382.css')}}">
    <title>@yield('title')</title>
</head>

<body>
    <div class="bg-[#0b024a] scrollbar-none flex overflow-scroll min-h-screen max-h-screen">

        {{-- Menu Start --}}
        <div class="bg-[#0b024a] w-[350px] flex flex-col text-white">
            <a href="{{ '/' }}"
                class="bg-[#0b024a] h-[70px] text-3xl font-semibold flex items-center justify-center text-[#04b034] border-b-2 border-white">
                Rent<span class="text-white">Room</span>
            </a>
            <div class="bg-[#0b024a] flex flex-col h-full overflow-scroll scrollbar-none px-3 py-5 gap-y-2 text-white">
                <a href="{{ route('admin.dashboard') }}"
                    class="w-full  min-h-[50px] flex items-center justify-center font-semibold text-xl rounded-md cursor-pointer {{ request()->path() == 'admin/dashboard' ? 'bg-white text-black' : 'bg-transparent text-white' }}">Dashboard</a>
                <a href="{{ route('user.index') }}"
                    class="w-full  min-h-[50px] flex items-center justify-center font-semibold text-xl rounded-md cursor-pointer {{ request()->path() == 'admin/user' || request()->path() == 'admin/user/create' || Request::is('admin/user/*/edit') || request()->path() == 'admin/user/search' ? 'bg-white text-black' : 'bg-transparent text-white' }}">User</a>
                <a href="{{ route('room.index') }}"
                    class="w-full  min-h-[50px] flex items-center justify-center font-semibold text-xl rounded-md cursor-pointer {{ request()->path() == 'admin/room' || request()->path() == 'admin/room/create' || Request::is('admin/room/*/edit') || request()->path() == 'admin/room/search' ? 'bg-white text-black' : 'bg-transparent text-white' }}">Room</a>
                <a href="{{ route('admin.pemesanan.index') }}"
                    class="w-full  min-h-[50px] flex items-center justify-center font-semibold text-xl rounded-md cursor-pointer {{ request()->path() == 'admin/pemesanan' || request()->path() == 'admin/pemesanan/create' || Request::is('admin/pemesanan/*/edit') || request()->path() == 'admin/pemesanan/search' ? 'bg-white text-black' : 'bg-transparent text-white' }}">Pemesanan</a>
                {{-- <a href="{{route('pengaduan.index')}}" class="w-full  min-h-[50px] flex items-center justify-center font-semibold text-xl rounded-md cursor-pointer {{request()->path() == 'admin/pengaduan' ? 'bg-white text-black' : 'bg-transparent text-white'}}">Pengaduan</a> --}}
                {{-- <a href="{{route('bunga.index')}}" class="w-full  min-h-[50px] flex items-center justify-center font-semibold text-xl rounded-md cursor-pointer {{request()->path() == 'dashboard/bunga' || request()->path() == 'dashboard/bunga/create' || Request::is('dashboard/bunga/*/edit')  || request()->path() == 'dashboard/bunga/search' ? 'bg-blue-800' : 'bg-transparent text-black'}}">Bunga</a>
                    <a href="{{route('pemesanan.index')}}" class="w-full  min-h-[50px] flex items-center justify-center font-semibold text-xl rounded-md cursor-pointer {{request()->path() == 'dashboard/pemesanan' || request()->path() == 'dashboard/pemesanan/create' || Request::is('dashboard/pemesanan/*/edit')  || request()->path() == 'dashboard/pemesanan/search' ? 'bg-blue-800' : 'bg-transparent text-black'}}">Pemesanan</a>             --}}
            </div>
        </div>
        {{-- Menu End --}}

        {{-- Container Content Start --}}
        <div class="bg-[#0b024a] w-full flex flex-col">
            {{-- Navbar Start --}}
            <div class="bg-[#0b024a] h-[70px] flex items-center justify-end px-5 gap-x-4 border-b-2 border-white">
                <a href="{{ route('home') }}" class="font-semibold text-lg hover:text-gray-300 text-white">Home</a>
                <a href="{{ route('logout') }}" class="font-semibold text-lg hover:text-gray-300 text-white">Logout</a>
            </div>
            {{-- Navbar End --}}
            <div class="bg-gray-300 h-full p-10 overflow-hidden">
                <div class="bg-transparent max-h-full overflow-scroll scrollbar-none p-5">
                    @yield('content')
                </div>
            </div>
        </div>
        {{-- Container Content Start --}}
    </div>
    @yield('scripts')
</body>
<style>
    .scrollbar-none::-webkit-scrollbar {
        display: none;
    }
</style>

</html>
