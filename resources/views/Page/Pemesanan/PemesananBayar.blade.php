@extends('Layouts.default')
@section('title')
    SEWA ROOM | ROOM DETAIL
@endsection
@section('content')
    <div class="bg-gray-200 flex justify-center min-h-[calc(100vh-60px)] max-h-[calc(100vh-60px)] w-full">
        <div
            class="bg-gray-200 w-[1300px] h-[calc(100vh-60px)] border-x-[2px] border-gray-400 p-5 overflow-scroll scrollbar-none">
            <div class="h-[400px] bg-white px-6">
                <img class="h-[400px] w-full object-contain bg-white" src="{{ $room->imagedir }}">
            </div>
            <div class="flex gap-x-2 flex-col xl:flex-row">
                <div class="bg-white rounded-sm mt-2 p-6 flex-col w-full">
                    <span class="text-4xl font-semibold">Large Room</span>
                    <div class="h-[2px] bg-gray-800 my-3"></div>
                    <span class="text-4xl font-semibold">Rp {{ $room->price }}/Jam</span>
                </div>
                <div class="bg-white rounded-sm mt-2 p-6 flex-col w-full">
                    <span class="text-4xl font-semibold">Capacity</span>
                    <div class="h-[2px] bg-gray-800 my-3"></div>
                    <span class="text-4xl font-semibold">
                        {{ $room->capacity }} Orang
                    </span>
                </div>
            </div>
            <div class="bg-white rounded-sm mt-2 p-6 flex-col">
                <span class="text-4xl font-semibold">Description</span>
                <div class="h-[2px] bg-gray-800 my-3"></div>
                <div class="text-md">
                    {!! $room->description !!}
                </div>
            </div>
            <div class="bg-white rounded-sm mt-2 p-6 flex-col">
                <span class="text-4xl font-semibold">Detail Sewa</span>
                <div class="h-[2px] bg-gray-800 my-3"></div>
                <div class="text-md flex flex-col">
                    <span class="mb-3 text-black font-semibold dark:text-gray-400">Harga Sewa : Rp {{$pemesanan->price}}</span>
                        <span class="mb-3 text-black  dark:text-gray-400">Tanggal :  {{$pemesanan->tanggal_sewa}}</span>
                        <span class="mb-3 text-black  dark:text-gray-400">Waktu Sewa :   {{$pemesanan->waktu_sewa_mulai}} s/d {{$pemesanan->waktu_sewa_selesai}}</span>
                        <span class="mb-3 text-black  dark:text-gray-400">
                            Pembayaran :  
                            <span class="{{$pemesanan->status_pembayaran == 'lunas' || $pemesanan->status_pembayaran == 'process'  ? 'text-green-600' : 'text-red-600'}}">
                                {{strtoupper($pemesanan->status_pembayaran)}}
                            </span>
                        </span>
                        <span class="mb-3 text-black  dark:text-gray-400">
                            Status Sewa :  
                            <span>
                                {{strtoupper($pemesanan->status_sewa)}}
                            </span>
                        </span>
                        <span class="mb-3 text-black  dark:text-gray-400">Image Pembayaran : </span>
                        <div class=" flex justify-center bg-gray-200 p-2">
                            @if ($pemesanan->image_pembayaran != null)
                                <a href="{{$pemesanan->imagedir}}" target="_blank">
                                    <img src="{{$pemesanan->imagedir}}" alt="">
                                </a>
                            @else
                                <span class="font-semibold text-lg">Belum Bayar</span>
                            @endif
                        </div>
                </div>
            </div>
            @if ($pemesanan->status_pembayaran == 'pending')
                <div class="bg-white rounded-sm mt-2 p-6 flex gap-x-2 flex-col">
                    <div class="">
                        <span class="text-3xl font-semibold">Form Pembayaran</span>
                    </div>
                <div class="h-[2px] bg-gray-800 my-4"></div>
                        <form action="{{route('pemesanan.bayar.store', ['uuid' => $pemesanan->uuid])}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('POST')
                            <div class="flex gap-x-2 flex-col">
                                <div class="flex bg-gray-400 rounded-md p-5 flex-col">
                                    <span class="text-2xl font-semibold">Info Pembayaran</span>
                                    <div class="h-[2px] bg-black my-3"></div>
                                    <p>Silakan Bayar Sesuai No Rekening Dibawah Ini</p>
                                    
                                    <span class="text-xl font-semibold">Nama Pemilik Rekening : </span>
                                    <span class="text-xl font-semibold">No Rekening : </span>
                                    
                                </div>
                                <div class="h-[2px] bg-black my-3"></div>
                                <div class="flex flex-col w-full">
                                    <label for="image_pembayaran" class="font-semibold text-black text-xl mb-1">Tanggal Sewa : <span class="text-sm">Masukan Bukti Foto Pembayaran Di Sini</span></label>
                                    <input type="file" class="border-[2px] border-black" id="image_pembayaran" name="image_pembayaran" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="flex flex-col w-full mt-2">
                                <button type="submit" class="bg-green-700 w-full rounded-lg font-semibold text-white p-2 mb-2 text-xl active:scale-95 transition-all duration-50">Submit</button>
                            </div>
                        </form>
                        @endif
                        <div class="text-lg mt-3 bg-white p-6">
                            Click Di Sini Untuk <a class="text-blue-600" href="/pemesanan">Kembali</a>
                        </div>
                    </div>
                </div>
    </div>
@endsection
