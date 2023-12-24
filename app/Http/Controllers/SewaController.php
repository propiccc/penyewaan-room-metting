<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SewaController extends Controller
{
    public function SewaCreate($uuid){
        $room = Room::where('uuid', $uuid)->first();
        
        return view('Page.Sewa.SewaForm', [
            'room' => $room
        ]);
    }

    public function SewaStore(Request $request, $uuid){
        
        $waktuSekarang = Carbon::now('Asia/Jakarta')->format('H:i');
        $tanggalSekarang = Carbon::now('Asia/Jakarta')->startOfDay();

        $validate = Validator::make($request->all(), [
            'tanggal_sewa' => ['required','date','after_or_equal:' . $tanggalSekarang->toDateString()],
            'waktu_sewa_mulai' => ['required','date_format:H:i','after_or_equal:' . $waktuSekarang],
            'waktu_sewa_selesai' => ['required','date_format:H:i','after:waktu_sewa_mulai',],
        ]);
        
        if($validate->fails()){
            foreach ($validate->errors()->all() as $item) {
                toastr()->error($item);
            }
            return redirect()->route('room.sewa.create', ['uuid' => $uuid]);
        }

        // * Check tanggal dan waktu ada yang memesan atau tidak 
        $check =  Sewa::where([
            'tanggal_sewa'  => $request->tanggal_sewa,
            'waktu_sewa_mulai' => $request->waktu_sewa_mulai,
            'status_pembayaran' => 'lunas',
        ])->first();

        if(isset($check)){
            return redirect()->route('room.sewa.create',['uuid' => $uuid])->with('warning', 'Waktu Pada Tanggal Itu Sudah Di Sewa !!!');
        }

        $room = Room::where('uuid', $uuid)->first();
        if(!isset($room)){
            return redirect()->route('room.sewa.create', ['uuid' => $uuid])->with('error', 'Room Tidak Di Temukan !!!');
        }

        // $tanggal_sewa = Carbon::createFromFormat('Y-m-d', $request->tanggal_sewa)->setTimezone('Asia/Jakarta')->startOfDay();;
        // $waktu_sewa_mulai = Carbon::createFromFormat('H:i', $request->waktu_sewa_mulai);
        // $waktu_sewa_selesai = Carbon::createFromFormat('H:i', $request->waktu_sewa_selesai);

        $time_start = Carbon::parse($request->waktu_sewa_mulai);
        $time_end   = Carbon::parse($request->waktu_sewa_selesai);
    
        // if($waktu_sewa_mulai->lt($waktuSekarang) || $tanggal_sewa->lt($tanggalSekarang) || $waktu_sewa_selesai->lt($waktu_sewa_mulai)){
        //     return redirect()->route('room.sewa.create', ['uuid' => $uuid])->with('error', 'Masukan Tanggal Dan Waktu Yang Benar');
        // }

        $jam = $time_end->diffInMinutes($time_start, true);
        if ($jam % 60 !== 0) {
            $jam = (int)($jam / 60) + 1; 
        } else {
            $jam = $jam / 60; 
        }

        $randomNumber = rand(pow(10, 4-1), pow(10, 4)-1);
        $randomNumberString = (string) $randomNumber;
        $HARGA_SEWA = $room->price * $jam;
        $KODE_BOKING = date('dmYHis') . $randomNumberString;

        $sewaRoom =  Sewa::create([
            'tanggal_sewa' => $request->tanggal_sewa,
            'waktu_sewa_mulai' => $request->waktu_sewa_mulai,
            'waktu_sewa_selesai' => $request->waktu_sewa_selesai,
            'room_id' => $room->id,
            'user_id' => Auth::user()->id,
            'price' => $HARGA_SEWA,
            'kode_boking' => $KODE_BOKING
        ]);

        if ($sewaRoom) {
            return redirect()->route('home')->with('success', 'Data Penyewaan Berhasil Di Buat !!!');
        } else {
            return redirect()->route('room.sewa.create', ['uuid'  => $uuid])->with('error', 'Data Gagal Di Buat !!!');
        }
    
    }
}
