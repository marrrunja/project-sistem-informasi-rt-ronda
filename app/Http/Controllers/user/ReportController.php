<?php

namespace App\Http\Controllers\user;

use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function laporan()
    {
        $laporan = DB::table('reports')
                    ->join('kategoris', 'reports.kategori_id','=' ,'kategoris.id')
                    ->join('users', 'reports.user_id', '=' ,'users.id')
                    ->select("users.nama_lengkap", "reports.*", 'kategoris.kategori')
                    ->orderBy('reports.id', 'desc')
                    ->limit(3)
                    ->get();

        return view('user.laporan', [
            'reports' => $laporan
        ]);
    }
    
    public function laporanAll()
    {
        return view('user.laporan-all');
    }

    public function tambahLaporan(Request $request){
        $data = [
            'foto' => $request->file('foto'),
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi
        ];

        $validate = [
            'kategori' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'deskripsi' => 'required'
        ];
        $pesan_validasi = [
            'kategori.required' => "Kategori harus dipilih!",
            'deskripsi.required' => 'Deskripsi harus diisi!',
            'foto.image' => 'Anda mengupload file yang bukan Gambar!',
            'foto.mimes' => 'Foto harus berektensi jpg, jpeg, png atau webpb!'
        ];
        $request->validate($validate, $pesan_validasi);
        
        DB::beginTransaction();
        try{
            $namaGambar = $data['foto'];
            if($namaGambar === null){
                $namaGambar = 'placeholder.png';
            }else{
                $namaGambar = Str::replace(' ', '', Str::uuid().$data['foto']->getClientOriginalName());
                $data['foto']->storeAs('images-report', $namaGambar, 'public');
            }

            Report::insert([
                'isi_laporan' => $data['deskripsi'],
                'foto' => $namaGambar,
                'user_id' => $request->session()->get('user_id'),
                'kategori_id' => $data['kategori'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            DB::commit();

            $flashMessage = [
                'message' => 'Berhasil menambah laporan',
                'alert' => 'primary'
            ];
            return redirect()->back()->with($flashMessage);
        }catch(\Exception $e){
            DB::rollback();
            $flashMessage = [
                'message' => 'Gagal menambah laporan '. $e->getMessage(),
                'alert' => 'danger'
            ];
            return redirect()->back()->with($flashMessage);
        }
    }
}
