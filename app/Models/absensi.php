<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    public static function getAllDataByJadwalId($jadwalId)
    {
        $absensi = DB::table('absensis')
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->where('absensis.id_jadwal', '=', $jadwalId)
            ->select('users.nama_lengkap', 'users.alamat', 'absensis.status')
            ->get();
        return $absensi;
    }
}
