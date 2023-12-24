@extends('Layouts.default')
@section('title')
    Home | SEWA ROOM MEETING
@endsection
@section('content')
    <div class="flex bg-black px-10 py-16">
        <div class="flex flex-col-reverse w-full xl:flex-row">
            <div class="bg-gray-800 text-white p-8 xl:w-1/2 flex flex-col ">
                <span class="font-bold text-4xl">Sewa Room Metting</span>
                <div class="h-[2px] w-full bg-white my-3"></div>
                <p class="text-2xl font-semibold text-start">
                    Selamat datang di tempat penyewaan ruang rapat kami, di mana setiap detail dirancang untuk memenuhi
                    kebutuhan bisnis Anda. Kami menyediakan ruang rapat yang elegan dan fungsional, menjadi tempat ideal
                    untuk pertemuan, presentasi, dan kolaborasi bisnis Anda. Dengan fasilitas yang berkualitas tinggi dan
                    suasana yang profesional, ruang rapat kami dirancang untuk meningkatkan produktivitas dan kreativitas
                    dalam setiap pertemuan.
                    Sewa ruang rapat kami untuk memastikan acara bisnis Anda berjalan dengan sukses dan tak terlupakan.
                    Ruang rapat kami tidak hanya menawarkan kenyamanan, tetapi juga memberikan suasana yang mendukung untuk
                    menjalin ide, inovasi, dan keputusan strategis. Dengan lokasi yang strategis, layanan yang ramah, dan
                    teknologi canggih, kami siap menyediakan tempat yang sempurna untuk memenuhi kebutuhan rapat bisnis
                    Anda.
                </p>
                <div class="flex mt-10">
                    <a href="#shop"
                        class="p-4 border-[2px] border-white hover:bg-white duration-300 transition-all hover:text-black font-semibold">Sewa
                        Room Sekarang</a>
                </div>
            </div>
            <div class="h-full xl:w-1/2">
                <img class="h-full object-fill"
                    src="https://aldironworkspace.com/wp-content/uploads/2022/01/19.-Harga-Sewa-Meeting-Room-Per-Jam-dengan-Fasilitas-Lengkap-1300x731.jpg"
                    alt="">
            </div>
        </div>
    </div>
    {{-- * Card Start --}}
    @if (count($room) != 0)
        <div class="flex w-full flex-col  bg-gray-800 p-8">
            <div class="flex justify-center">
                <span class="font-bold text-4xl text-white">Sewa Room Di Sini</span>
            </div>
            {{-- Produk Start --}}
            <div class="h-[2px] bg-white w-full my-5"></div>
            <div class="flex gap-3 justify-center">
                @foreach ($room as $item)
                    <div
                        class="w-[400px] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a class="" href="{{ route('room.detail', ['uuid' => $item->uuid]) }}">
                            <img class="rounded-t-lg object-cover h-[220px] w-full bg-black" src="{{ $item->imagedir }}"
                                alt="" />
                        </a>
                        <div class="p-5">
                            <a href="{{ route('room.detail', ['uuid' => $item->uuid]) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $item->room_name }}</h5>
                            </a>
                            <div class="h-[150px] overflow-hidden">
                                {!! $item->description !!}
                            </div>
                            <a href="{{ route('room.detail', ['uuid' => $item->uuid]) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Sewa Room
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- Produk End --}}
        </div>
    @endif

    {{-- * Card End --}}

    {{-- * Lokasi Start --}}
    <div class="flex h-[1000px] flex-col">
        <div class="bg-black p-5 flex flex-col items-center">
            <span class="text-5xl font-bold text-center text-white">Kunjungi Lokasi Kami</span>
            <div class="h-[2px] bg-white w-full my-5"></div>
        </div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1013898.8725475085!2d113.99247201736871!3d-6.945151739497945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f9503d619c43%3A0x411d4cbbe989434!2sSMK%20Negeri%202%20Surabaya!5e0!3m2!1sid!2sid!4v1702280181145!5m2!1sid!2sid"
            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    {{-- * Lokasi Ends --}}

    {{-- * Footer Start --}}
    <footer class="bg-white shadow dark:bg-gray-900">
        <div class="w-full max-w-screen-xl mx-auto p-4">
            <div class="sm:flex justify-center">
                <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse justify-center">
                    <span class="text-2xl font-semibold whitespace-nowrap dark:text-white">SEWA ROOM METINGS</span>
                </a>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-center text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a
                    href="https://flowbite.com/" class="hover:underline">SEWAROOMMETTING</a>. All Rights Reserved.</span>
        </div>
    </footer>
    {{-- * Footer End --}}
@endsection
