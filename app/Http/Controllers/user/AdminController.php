<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        // ============================================
        // 1. DATA DASAR DASHBOARD
        // ============================================

        // Total laporan
        $totalLaporan = DB::table('reports')->count();

        // Total warga (non-admin)
        $totalWarga = DB::table('users')
            ->where('is_admin', 0)
            ->count();


        // ============================================
        // 2. PERSENTASE KEHADIRAN MINGGU INI
        // ============================================
        $formatWaktu = 'Asia/Jakarta';
        $startOfWeek = now($formatWaktu)->startOfWeek(); // Senin
        $endOfWeek   = now($formatWaktu)->endOfWeek();   // Minggu

        // dump($startOfWeek);
        // dd($endOfWeek);


        // Ambil semua jadwal minggu ini
        $jadwalMingguanIds = DB::table('jadwals')
            ->where('is_aktif', 1) // hanya yang aktif
            ->whereBetween('jadwal_masuk', [$startOfWeek, $endOfWeek])
            ->pluck('id');
        if ($jadwalMingguanIds->isEmpty()) {
            $persentaseKehadiran = 0;
        } else {
            $totalAbsensi = DB::table('absensis')
                ->whereIn('id_jadwal', $jadwalMingguanIds)
                ->count();

            $totalHadir = DB::table('absensis')
                ->whereIn('id_jadwal', $jadwalMingguanIds)
                ->where('status', 1)
                ->count();

            $persentaseKehadiran = $totalAbsensi > 0
                ? round(($totalHadir / $totalAbsensi) * 100)
                : 0;
        }


        // ============================================
        // 3. GRAFIK — BERDASARKAN 7 JADWAL AKTIF TERAKHIR
        // ============================================

        $jadwals = DB::table('jadwals')
            ->where('is_aktif', 1) // hanya jadwal aktif
            ->orderBy('jadwal_masuk', 'desc')
            ->take(7)
            ->get();

        // TOTAL JADWAL HANYA YANG AKTIF
        $totalJadwal = DB::table('jadwals')
            ->where('is_aktif', 1)
            ->count();

        $labels = [];
        $data = [];

        foreach ($jadwals as $jadwal) {

            $hadir = DB::table('absensis')
                ->where('id_jadwal', $jadwal->id)
                ->where('status', 1)
                ->count();
            $jumlahWargaDalamAbsensi = DB::table('absensis')
                            ->where('id_jadwal', '=', $jadwal->id)
                            ->get()
                            ->count();

            $persentase = $jumlahWargaDalamAbsensi > 0
                ? round(($hadir / $jumlahWargaDalamAbsensi) * 100)
                : 0;

            $labels[] = \Carbon\Carbon::parse($jadwal->jadwal_masuk)->format('d M');
            $data[] = $persentase;
        }


        // ============================================
        // 4. DATA DIKIRIM KE VIEW
        // ============================================

        $data = [
            'labels' => $labels,
            'data' => $data,
            'total_warga' => $totalWarga,
            'total_jadwal' => $totalJadwal,
            'persentase_kehadiran' => $persentaseKehadiran,
            'total_laporan' => $totalLaporan
        ];

        return view('admin.main', $data);
    }
    public function laporan(Request $request)
    {
        $laporan = DB::table('reports')
                    ->join('kategoris', 'reports.kategori_id','=' ,'kategoris.id')
                    ->join('users', 'reports.user_id', '=' ,'users.id')
                    ->select("users.nama_lengkap", "reports.*", 'kategoris.kategori')
                    ->orderBy('reports.id', 'desc')
                    ->paginate(10);
        $data = [
            'reports' => $laporan
        ];
        return view('admin.laporan', $data);
    }
    public function detailLaporan(Request $request)
    {
        $id = $request->id;
        $laporan = DB::table('reports')
                    ->join('kategoris', 'reports.kategori_id','=' ,'kategoris.id')
                    ->join('users', 'reports.user_id', '=' ,'users.id')
                    ->select("users.nama_lengkap", "reports.*", 'kategoris.kategori')
                    ->where('reports.id', '=', $id)
                    ->orderBy('reports.id', 'desc')
                    ->first();
        
        $data = [
            'report'=> $laporan
        ];
        return view('admin.detail-laporan', $data);
    }

    public function ubahLaporan(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $isFail = $id == null || $status == null;

        if($isFail){
            return redirect()->back()->with([
                'status' => 'Gagal',
                'message' => 'Gagal mengupdate laporan, laporan mungkin telah berada di status selesai!',
                'icon' => 'error',
            ]);
        }
        
        $update = DB::table('reports')->where('id', '=', $id)->update([
            'status' => $status
        ]
        );

        if($update > 0 ){
            return redirect()->back()->with([
                'status' => 'Berhasil diubah',
                'message' => 'Berhasil mengupdate status laporan',
                'icon' => 'success',
            ]);
        }
     
        return redirect()->back()->with([
            'status' => 'Tidak ada yang diubah',
            'message' => 'Belum ada yang di update',
            'icon' => 'info'
        ]);
        
    }

    public function manage(Request $request)
    {
        $users = DB::table('users')->where('is_admin', '=', 0)->paginate(15);
        return view('admin.manage-warga',[
            'users' => $users
        ]);
    }

    public function doBlokir(Request $request)
    {
        $id = $request->id;

        $blokir = DB::table('users')->where('id', '=', $id)->update([
            'status' => "0"
        ]);
        if($blokir > 0){
            return response()->json([
                'status' => 'Berhasil',
                'message' => 'Akun user berhasil diblokir',
                'icon' => 'success',
            ]);
        }
        return response()->json([
            'status' => 'Tidak berhasil',
            'message' => 'Akun user gagal diblokir',
            'icon' => 'info',
        ]);
    }
    public function bukaBlokir(Request $request)
    {
        $id = $request->id;

        $blokir = DB::table('users')->where('id', '=', $id)->update([
            'status' => "1"
        ]);
        if($blokir > 0){
            return response()->json([
                'status' => 'Berhasil',
                'message' => 'Akun user berhasil diaktifkan',
                'icon' => 'success',
            ]);
        }
        return response()->json([
            'status' => 'Tidak berhasil',
            'message' => 'Akun user gagal diaktifkan',
            'icon' => 'info',
        ]);
    }

    public function jadwal(Request $request)
    {
       $jadwals = DB::table('jadwals')
            ->leftJoin('absensis', 'jadwals.id', '=', 'absensis.id_jadwal')
            ->select(
                'jadwals.id',
                'jadwals.jadwal_masuk',
                'jadwals.is_aktif',
                DB::raw('COUNT(absensis.user_id) as total_anggota')
            )
            ->groupBy(
                'jadwals.id',
                'jadwals.jadwal_masuk',
                'jadwals.is_aktif'
            )
            ->orderBy('jadwals.is_aktif', 'desc')
            ->orderBy('jadwals.id', 'desc')
            ->paginate(9);
        return view('admin.jadwal', [
            'jadwals' => $jadwals
        ]);
    }
    public function makeJadwal(Request $request):JsonResponse
    {
        $tanggal = Carbon::parse($request->tanggal);

        if($tanggal === "" || $tanggal->isPast()){
            return response()->json([
                'status' => 'Gagal',
                'message' => 'Anda belum mengisi tanggal atau tanggal sudah lewat!',
                'icon' => 'error'
            ]);
        }
        $jadwalIdb = DB::table('jadwals')->where('jadwal_masuk', '=', $tanggal)->first();
        if($jadwalIdb){
            return response()->json([
                'status' => 'Gagal',
                'message' => 'Jadwal sudah ada atau sudah lewat!',
                'icon' => 'error'
            ]);
        }
        $insert = DB::table('jadwals')->insert([
            'jadwal_masuk' => $tanggal
        ]);

        if($insert > 0){
            return response()->json([
                'status' => 'Berhasil',
                'message' => 'Berhasih menambah jadwal',
                'icon' => 'success'
            ]);
        }
        return response()->json([
            'status' => 'Gagal',
            'message' => 'Gagal menambah jadwal, terdapat kesalahan, tolong diperiksa kembali!',
            'icon' => 'error'
        ]);
    }

    public function detailJadwal(Request $request):Response
    {
        $id = $request->id;
        $jadwal = DB::table('jadwals')->where('id', '=', $id)->first();
        $absensiAktif = DB::table('absensis')
                ->join('jadwals', 'absensis.id_jadwal', '=', 'jadwals.id')
                ->join('users', 'absensis.user_id', 'users.id')
                ->where('jadwals.is_aktif', 1)
                ->select('users.id');

        $users = DB::table('users')->where('is_admin', '=', 0)->where('status', '=', 1)->whereNotIn('id', $absensiAktif)->get();
        $jadwals = DB::table('absensis')
                    ->join('jadwals', 'absensis.id_jadwal', '=', 'jadwals.id')
                    ->join('users', 'absensis.user_id', '=', 'users.id')
                    ->where('absensis.id_jadwal', '=', $id)
                    ->select('absensis.id', 'absensis.status', 'users.nama_lengkap')
                    ->get();
        $data = [
            'jadwal_id' => $id,
            'jadwal' => $jadwal,
            'users' => $users,
            'jadwals' =>$jadwals
        ];

        return response()->view('admin.detail-jadwal', $data);
    }

    public function nonaktif(Request $request)
    {
       $id = $request->id;
       $jadwal = DB::table('jadwals')->where('id', $id);
       
       if($jadwal->first()->is_aktif === 0){
        return redirect()->back()->with([
            'status' => 'Gagal',
            'message' => 'Jadwal Sudah di nonaktifkan!',
            'icon' => 'error'
        ]);
       }
       $update = $jadwal->update([
        'is_aktif' => 0
       ]);
       if($update > 0){
        return redirect()->back()->with([
            'status' => 'Berhasil',
            'message' => 'Jadwal berhasil di nonaktifkan',
            'icon' => 'success'
        ]);
       }
       return redirect()->back()->with([
            'status' => 'Gagal',
            'message' => 'Terdapat kesalahan',
            'icon' => 'error'
        ]);
    }
    public function aktifkan(Request $request){
        $id = $request->id;
        $jadwal = DB::table('jadwals')->where('id', $id);
        $tanggal_jadwal = Carbon::parse($jadwal->first()->jadwal_masuk);
       
        if($jadwal->first()->is_aktif === 1){
            return redirect()->back()->with([
                'status' => 'Gagal',
                'message' => 'Jadwal Sudah di aktifkan!',
                'icon' => 'error'
            ]);
       }
       if($tanggal_jadwal->isPast()){
        return redirect()->back()->with([
            'status' => 'Gagal',
            'message' => 'Jadwal tidak bisa diaktifkan karena sudah berlalu!!',
            'icon' => 'error'
        ]);
       }
        $update = $jadwal->update([
        'is_aktif' => 1
       ]);
       if($update > 0){
        return redirect()->back()->with([
            'status' => 'Berhasil',
            'message' => 'Jadwal berhasil di aktifkan',
            'icon' => 'success'
        ]);
       }
       return redirect()->back()->with([
            'status' => 'Gagal',
            'message' => 'Terdapat kesalahan',
            'icon' => 'error'
        ]);
    }


}
