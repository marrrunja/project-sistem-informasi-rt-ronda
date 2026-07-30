<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AbsensiController extends Controller
{
    public function add(Request $request):JsonResponse
    {
        $users = $request->users;
        $jadwal_id = $request->id;
        if(count($users) < 1 || $jadwal_id === null){
            return response()->json([
                "status" => "Gagal",
                "message" => "Terjadi kesalahan, silahkan periksa kembali jadwal serta warga yang ditambahkan",
                "icon" => "error",
            ]);
        }

        DB::beginTransaction();
        try {
           
            foreach($users  as $id){
                $userInSameJadwal = DB::table("absensis")
                                    ->where("id_jadwal", $jadwal_id)
                                    ->where("user_id", $id)
                                    ->count();

                if($userInSameJadwal > 0) throw new \Exception();
                DB::table("absensis")->insert([
                    "status" => 0,
                    "id_jadwal" => $jadwal_id,
                    "user_id" => $id,
                ]);
            }
            DB::commit();
            return response()->json([
                'message' => "Berhasil menambahkan warga ke dalam jadwal",
                'icon' => 'success',
                'status' => 'Berhasil'
            ]);
           
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => "Gagal menambahkan warga ke dalam jadwal",
                'icon' => 'error',
                'status' => 'Gagal'
            ]);
        }
    }

    public function hapus(Request $request):JsonResponse{
        $id = $request->id;
        if($id == null){
            return response()->json([
                'status' => 'Gagal',
                'message' => 'id tidak boleh kosong',
                'icon' => 'error'
            ]);
        }
        $delete = DB::table('absensis')->where('id', $id)->delete();
        if($delete > 0){
             return response()->json([
                'status' => 'Berhasil',
                'message' => 'Berhasil menghapus warga dari jadwal',
                'icon' => 'success',
            ]);
        }
        return response()->json([
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

        if($isPast->isPast() && !$isPast->isCurrentDay()){
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
        $jadwals = DB::table('jadwals')
            ->where(DB::raw("DATE_FORMAT(jadwals.jadwal_masuk, '%Y-%m')"), $bulanIni)
            ->orderBy('jadwals.jadwal_masuk', 'desc')
            ->get();

        // Ambil absensi berdasarkan bulan ini
        // $dataAbsensi = DB::table('absensis')
        //     ->join('users', 'users.id', '=', 'absensis.user_id')
        //     ->join('jadwals', 'jadwals.id', '=', 'absensis.id_jadwal')
        //     ->select(
        //         'users.nama_lengkap',
        //         'jadwals.jadwal_masuk',
        //         'absensis.status'
        //     )
        //     ->where(DB::raw("DATE_FORMAT(jadwals.jadwal_masuk, '%Y-%m')"), $bulanIni)
        //     ->orderBy('jadwals.jadwal_masuk', 'desc')
        //     ->get();

        // Generate MPDF
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4'
        ]);
        $data = [
            'absens' => $jadwals
        ];
        $mpdf->writeHTML(view('admin.cetak-absensi',$data));
        $mpdf->Output('Absensi warga bulan ini.pdf','I');
    }


    public function searchAnggota(Request $request):string
    {
          $absensiAktif = DB::table('absensis')
                ->join('jadwals', 'absensis.id_jadwal', '=', 'jadwals.id')
                ->join('users', 'absensis.user_id', 'users.id')
                ->where('jadwals.is_aktif', 1)
                ->select('users.id');


        $username = $request->input('username');
        $users = DB::table("users")
                ->whereNotIn("id", $absensiAktif)
                ->whereNotIn("id", json_decode($request->input("ids")))
                ->where("nama_lengkap", "like", '%'.$username.'%')
                ->where("status", 1)
                ->where("is_admin", 0)
                ->select("id", "nama_lengkap")
                ->get();

        return view("partial.list-anggota-ronda", ["users" => $users])->render();
    }

    public function deleteUsers(Request $request){
        $idsAbsen = $request->idsAbsensi;
        if(count($idsAbsen) < 1){
            return response()->json([
                'message' => "Tidak ada warga yang dipilih",
                'icon' => 'error',
                'status' => 'Gagal'
            ]);
        }
        DB::beginTransaction();
        try {
            $clearAbsen = DB::table("absensis")
                        ->whereIn("id", $idsAbsen)
                        ->where("status", 1)
                        ->count();
            if($clearAbsen > 0) throw new \Exception();
            foreach($idsAbsen as $id){
                DB::table("absensis")->where("id", $id)->delete();
            }
            DB::commit();
            return response()->json([
                'message' => "Berhasil menghapus warga di dalam jadwal",
                'icon' => 'success',
                'status' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => "Terjadi kesalahan, gagal menghapus warga di jadwal",
                'icon' => 'error',
                'status' => 'Gagal'
            ]);
        }
    }
}
