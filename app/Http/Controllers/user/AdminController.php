<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

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

        $startOfWeek = now($formatWaktu)->startOfWeek();
        $endOfWeek   = now($formatWaktu)->endOfWeek();

        // dump($startOfWeek);
        // dd($endOfWeek);

        // Ambil semua jadwal minggu ini
        $jadwalMingguanIds = DB::table('jadwals')
            ->where('is_aktif', 1)
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
        // 3. GRAFIK (7 JADWAL AKTIF TERAKHIR)
        // ============================================

        $jadwals = DB::table('jadwals')
            ->where('is_aktif', 1)
            ->orderBy('jadwal_masuk', 'desc')
            ->take(7)
            ->get();

        // Total jadwal aktif
        $totalJadwal = DB::table('jadwals')
            ->where('is_aktif', 1)
            ->count();

        $labels = [];
        $dataHadir = [];
        $dataIzin = [];
        $dataBelumAbsen = [];

        foreach ($jadwals as $jadwal) {

            // Jumlah peserta pada jadwal tersebut
            $jumlahPeserta = DB::table('absensis')
                ->where('id_jadwal', $jadwal->id)
                ->count();

            // Jumlah hadir
            $hadir = DB::table('absensis')
                ->where('id_jadwal', $jadwal->id)
                ->where("clear_absen", 1)
                ->where('status', 1)
                ->count();

            // Jumlah izin
            $izin = DB::table('absensis')
                ->where('id_jadwal', $jadwal->id)
                ->where("clear_absen", 1)
                ->where('status', 0)
                ->count();

             // Belum Absen
            $belumAbsen = DB::table('absensis')
                ->where('id_jadwal', $jadwal->id)
                ->where('clear_absen', 0)
                ->count();


            // Persentase hadir
            $persentaseHadir = $jumlahPeserta > 0
                ? round(($hadir / $jumlahPeserta) * 100)
                : 0;

            // Persentase izin
            $persentaseIzin = $jumlahPeserta > 0
                ? round(($izin / $jumlahPeserta) * 100)
                : 0;
            $persentaseBelumAbsen = $jumlahPeserta > 0 ? round(($belumAbsen / $jumlahPeserta) * 100) : 0;

            $labels[] = Carbon::parse($jadwal->jadwal_masuk)->format('d M');

            $dataHadir[] = $persentaseHadir;
            $dataIzin[] = $persentaseIzin;
            $dataBelumAbsen[] = $persentaseBelumAbsen;
        }



        // statistik Laporan
        $totalLaporan = DB::table("reports")->count();
        $idCategory = DB::table("kategoris")->pluck("id", )->toArray();
        $reportsPerCategories = DB::table("reports AS r")
                                ->leftJoin("kategoris AS k", "r.kategori_id", "k.id")
                                ->whereIn("r.kategori_id", $idCategory)
                                ->selectRaw('k.kategori, COUNT(*) as count_kategori')
                                ->groupBy("k.id", "k.kategori")
                                ->get();
        
        $labelCategories = $reportsPerCategories->pluck("kategori");
        $dataCategories = $reportsPerCategories->pluck("count_kategori");


        // ============================================
        // 4. KIRIM KE VIEW
        // ============================================

        return view('admin.main', [
            'labels' => $labels,
            'dataHadir' => $dataHadir,
            'dataIzin' => $dataIzin,
            'total' => $totalJadwal,
            'dataBelumAbsen' => $dataBelumAbsen,
            'total_warga' => $totalWarga,
            'total_jadwal' => $jadwalMingguanIds->count(),
            'persentase_kehadiran' => $persentaseKehadiran,
            'total_laporan' => $totalLaporan,
            "labelCategories" => $labelCategories,
            "dataCategories" => $dataCategories,
        ]);
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
        DB::beginTransaction();
        try {
            $update = DB::table('reports')->where('id', '=', $id)->update([
                    'status' => strtolower($status)
                ]
            );
            if($status == "Selesai"){
                DB::table("history_reports")->insert([
                   "report_id" => $id,
                   "title" => "Laporan selesai",
                   "description" => "Laporan telah selesai diproses. Terima kasih atas partisipasi Anda dalam membantu menjaga lingkungan.",
                   "tanggal_aksi" => Carbon::now()->toDateString(),
                   "created_at" => Carbon::now(),
                   "updated_at" => Carbon::now(),
               ]);
            } else if($status == "Ditinjau"){
                DB::table("history_reports")->insert([
                   "report_id" => $id,
                   "title" => "Laporan sedang ditinjau",
                   "description" => "Laporan sedang diproses dan ditinjau oleh Ketua RT. Mohon menunggu hingga proses peninjauan selesai.",
                   "tanggal_aksi" => Carbon::now()->toDateString(),
                   "created_at" => Carbon::now(),
                   "updated_at" => Carbon::now(),
               ]);
            }
            $message = "";
            $statusUpdate = "";
            $icon = "";

            if($update > 0){
                $message = "Berhasil mengupdate status laporan";
                $statusUpdate = "Berhasil diubah";
                $icon = "success";
            } else{
                $message = "Belum ada yang di update";
                $statusUpdate = "Tidak ada yang diubah";
                $icon = "info";
                DB::rollBack();
            }

            DB::commit();
            return redirect()->back()->with([
                'status' => $statusUpdate,
                'message' => $message,
                'icon' => $icon,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'status' => 'Terjadi kesalahan',
                'message' => 'Gagal mengupdate laporan',
                'icon' => 'info'
            ]);
        }
        
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
                    ->select('absensis.id', 'absensis.status', 'users.nama_lengkap', 'absensis.clear_absen')
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
       
        if($jadwal->first()->is_aktif == 1){
            return redirect()->back()->with([
                'status' => 'Gagal',
                'message' => 'Jadwal Sudah di aktifkan!',
                'icon' => 'error'
            ]);
       }

      
       if($tanggal_jadwal->isPast() && !$tanggal_jadwal->isCurrentDay()){
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

    public function getDetailWarga(Request $request):View
    {
        $user = User::where("id", $request->id)->where("is_admin", 0)->first();
        $statistikUser = [];

        $totalJadwal = DB::table("absensis")->where("user_id", $user->id)->count();
        $totalLaporan = DB::table("reports")->where("user_id", $user->id)->count();
        $totalHadir = DB::table("absensis")
                        ->where("user_id", $user->id)
                        ->where("clear_absen", 1)
                        ->where("status", 1)
                        ->count();
        $totalIzin = DB::table("absensis")
                        ->where("user_id", $user->id)
                        ->where("clear_absen", 1)
                        ->where("status", 0)
                        ->count();
        $totalBelumAbsen = DB::table("absensis")
                        ->where("user_id", $user->id)
                        ->where("clear_absen", 0)
                        ->count();
        $riwayatKehadiran = DB::table("absensis AS a")
                            ->join("jadwals AS j", "a.id_jadwal", "j.id")
                            ->join("users AS u", "a.user_id", "u.id")
                            ->where("u.id", $user->id)
                            ->orderBy("j.jadwal_masuk", "DESC")
                            ->select("j.jadwal_masuk", "a.status", "a.clear_absen")
                            ->get();
        $riwayatLaporan = DB::table("reports AS r")
                        ->join("kategoris AS k", "r.kategori_id", "k.id")
                        ->where("r.user_id", $user->id)
                        ->orderBy("r.created_at", "DESC")
                        ->select("k.kategori", "r.created_at", "r.id", "r.status")
                        ->get();

        $persentaseHadir = $totalHadir > 0 ? round(($totalHadir/$totalJadwal) * 100, 2) : 0;
        $persentaseIzin = $totalIzin > 0 ? round(($totalIzin/$totalJadwal) * 100, 2) : 0;
        $persentaseBelumAbsen = $totalBelumAbsen > 0 ? round(($totalBelumAbsen/$totalJadwal) * 100, 2) : 0;


        $statistikUser["total_laporan"] = $totalLaporan;
        $statistikUser["total_jadwal"] = $totalJadwal;
        $statistikUser["total_hadir"] = $totalHadir;
        $statistikUser["total_izin"] = $totalIzin;
        $statistikUser["total_belum_absen"] = $totalBelumAbsen;
        $statistikUser["persentase_hadir"] = $persentaseHadir;
        $statistikUser["persentase_izin"] = $persentaseIzin;
        $statistikUser["persentase_belum_absen"] = $persentaseBelumAbsen;


        $data = [
            "user" => $user,
            "statistikUser" => $statistikUser,
            "riwayatKehadiran" => $riwayatKehadiran,
            "riwayatLaporan" => $riwayatLaporan,
        ];

        return view("admin.detail-warga", $data);
    }


}
