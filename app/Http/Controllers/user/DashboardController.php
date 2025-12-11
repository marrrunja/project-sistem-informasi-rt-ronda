<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('username', $request->session()->get('username'))->first();
        $jadwal = DB::table('jadwals')->where('is_aktif', '=', 1)
                ->orderBy('jadwal_masuk', 'asc')
                ->get();
        $absensiUser = DB::table('absensis')
                    ->join('jadwals', 'absensis.id_jadwal', 'jadwals.id')
                    ->where('jadwals.is_aktif', '=', 1)
                    ->where('user_id', '=', $user->id)
                    ->select('absensis.id as id_absen','jadwals.jadwal_masuk','absensis.clear_absen', 'jadwals.id as id_jadwal')
                    ->first();

        $jumlahAbsenDB = DB::select('SELECT COUNT(user_id) AS total_absen FROM absensis WHERE user_id = ?', [$user->id])[0]->total_absen;

        $jumlahAbsenUser = DB::select('SELECT COUNT(status) AS total_absen_user FROM absensis WHERE status = 1 AND user_id = ?', [$user->id])[0]->total_absen_user;

        $jumlahLaporan = DB::select('SELECT COUNT(user_id) AS total_laporan FROM reports WHERE user_id = ?', [$user->id])[0]->total_laporan;
        if($jumlahAbsenDB === 0){
            $jumlahAbsenDB = 1;
        }
        $persentasiAbsenUser = $jumlahAbsenUser / $jumlahAbsenDB * 100;
        $laporanUser = DB::table('reports')
                    ->join('kategoris', 'reports.kategori_id','=' ,'kategoris.id')
                    ->join('users', 'reports.user_id', '=' ,'users.id')
                    ->select("reports.status", 'kategoris.kategori')
                    ->orderBy('reports.id', 'desc')
                    ->where('reports.user_id', '=', $request->session()->get('user_id'))
                    ->limit(3)
                    ->get();

        $data= [
            'data' => $user,
            'reports' => $laporanUser,
            'jadwals' => $jadwal,
            'statistik' => [
                'jumlah_db' => $jumlahAbsenDB,
                'jumlah_absen_user' => $persentasiAbsenUser
            ],
            'jumlah_laporan' => $jumlahLaporan,
            'absensi_user' => $absensiUser
        ];
        return view('user.main', $data);
    }

    public function jadwal(Request $request)
    {
        $jadwals = DB::table('jadwals')->where('is_aktif', '=', 1)->orderBy('jadwal_masuk', 'asc')->get();

        return view('user.jadwal', [
            'jadwals' => $jadwals
        ]);
    }



    public function profil(Request $request){
        $user = User::where('id', $request->session()->get('user_id'))->first();
        $data = [
            'user' => $user
        ];
        return view('user.profile', $data);
    }

    public function getDetail(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        return view('partial.detail-user', ['user' => $user])->render();
    }

    public function editData(Request $request):JsonResponse
    {
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'wa' => $request->wa
        ];

        if($data['nama'] === null){
            return response()->json([
                'status' => 'Gagal',
                'message' => 'Nama tidak boleh kosong!',
                'icon' => 'error'
            ]);
        }
        if(strlen($data['nama']) > 12){
              return response()->json([
                'status' => 'Gagal',
                'message' => 'Nama tidak boleh melebihi 12 karakter',
                'icon' => 'error'
            ]);
        }
        $update = DB::table('users')->where('id', '=', $request->id)->update([
            'nama_lengkap' => $data['nama'],
            'alamat' => $data['alamat'] === '-' ? null : $data['alamat'],
            'no_wa' => $data['wa'] === '-' ? null : $data['wa']
        ]);

        if($update > 0){
            return response()->json([
                'status' => 'Berhasil',
                'message' => 'Berhasil mengupdate data',
                'icon' => 'success'
            ]);
        }
        return response()->json([
            'status' => 'Tidak diubah',
            'message' => 'Tidak ada data yang diubah',
            'icon' => 'info'
        ]);


    }
}
