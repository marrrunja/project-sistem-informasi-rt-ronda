<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function add(Request $request)
    {
        $user_id = $request->user;
        $jadwal_id = $request->id;
        if($user_id === null || $jadwal_id === null){
            return redirect()->back()->with([
                'status' => 'Gagal',
                'message' => 'User id dan juga jadwal id tidak boleh kosong',
                'icon' => 'error'
            ]);
        }

        $insert = DB::table('absensis')->insert([
            'status' => 0,
            'id_jadwal' => $jadwal_id,
            'user_id' => $user_id
        ]);

        if($insert > 0){
            return redirect()->back()->with([
                'status' => 'Berhasil',
                'message' => 'Berhasil menambahkan user ke dalam jadwal',
                'icon' => 'success'
            ]);
        }
        return redirect()->back()->with([
            'status' => 'Gagal',
            'message' => 'Gagal menambahkan user ke dalam jadwal!',
            'icon' => 'error'
        ]);
    }

    public function hapus(Request $request){
        $id = $request->id;
        if($id == null){
            return redirect()->back()->with([
                'status' => 'Gagal',
                'message' => 'id tidak boleh kosong',
                'icon' => 'error'
            ]); 
        }
        $delete = DB::table('absensis')->where('id', $id)->delete();
        if($delete > 0){
            return redirect()->back()->with([
                'status' => 'Berhasil',
                'message' => 'Berhasil menghapus warga di dalam jadwal',
                'icon' => 'success'
            ]);
        }
        return redirect()->back()->with([
            'status' => 'Gagal',
            'message' => 'Gagal menghapus warga dari jadwal, silahkan coba lagi!',
            'icon' => 'error'
        ]);
    }

    public function ubah(Request $request):JsonResponse{
        $id = $request->id;
        $status = $request->status;
        $query = DB::table('absensis')->where('id', $id);
        $update = 0;

        $tanggal_masuk = DB::table('absensis')
                        ->join('jadwals', 'absensis.id_jadwal', '=','jadwals.id')
                        ->where('absensis.id', '=', $id)
                        ->select('jadwals.jadwal_masuk')
                        ->first()->jadwal_masuk;       
        $isPast = Carbon::parse($tanggal_masuk);

        if($isPast->isPast()){
             return response()->json([
                'message' => "Gagal melakukan absensi, jadwal sudah lewat!!",
                'icon' => 'error',
                'status' => 'Gagal'
            ]);
        }

        if($status === "hadir"){
            $update = $query->update([
                'status' => 1,
                'clear_absen' => 1
            ]);
        }
        else if($status == "izin"){
            $update = $query->update([
                'status' => 0,
                'clear_absen' => 1
            ]);
        }

        if($update > 0){
            return response()->json([
                'message' => "Berhasil melakukan absensi",
                'icon' => 'success',
                'status' => 'berhasil'
            ]);
        }
        else {
            return response()->json([
                'message' => "Gagal melakukan absensi",
                'icon' => 'success',
                'status' => 'berhasil'
            ]);
            
        }
    }
    public function cetakAbsensi()
    {
        $bulanIni = Carbon::now()->format('Y-m');

        // Ambil absensi berdasarkan bulan ini
        $dataAbsensi = DB::table('absensis')
            ->join('users', 'users.id', '=', 'absensis.user_id')
            ->join('jadwals', 'jadwals.id', '=', 'absensis.id_jadwal')
            ->select(
                'users.nama_lengkap',
                'jadwals.jadwal_masuk',
                'absensis.status'
            )
            ->where(DB::raw("DATE_FORMAT(jadwals.jadwal_masuk, '%Y-%m')"), $bulanIni)
            ->orderBy('jadwals.jadwal_masuk', 'desc')
            ->get();

        // Generate MPDF
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4'
        ]);
        $data = [
            'absens' => $dataAbsensi
        ];
        $mpdf->writeHTML(view('admin.cetak-absensi',$data));
        $mpdf->Output('Absensi warga bulan ini.pdf','I');
    }
}
