<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public static function checkUserInJadwal($userId, $jadwalId){
        // $jadwal = DB::table('jadwals')->where('id', '=', $id)->first();
        // $absensiAktif = DB::table('absensis')
        //         ->join('jadwals', 'absensis.id_jadwal', '=', 'jadwals.id')
        //         ->join('users', 'absensis.user_id', 'users.id')
        //         ->where('jadwals.is_aktif', 1)
        //         ->select('users.id');
        $absensi = DB::table('absensis')
                    ->join('jadwals', 'absensis.id_jadwal', '=', 'jadwals.id')
                    ->join('users','absensis.user_id', 'users.id')
                    ->where('jadwals.id', '=', $jadwalId)
                    ->where('users.id', '=', $userId)
                    ->where('jadwals.is_aktif', '=', 1)
                    ->select('users.id')
                    ->get();
        // $absensi = DB::table('absensis')->where('user_id', '=', $userId)->first();
        // $users = DB::table('users')->whereNotIn('id', $absensiAktif)->get();
        // $user = User::where('username', $request->session()->get('username'))->first();
        return $absensi;



        // $jadwal = DB::table('jadwals')->where('is_aktif', '=', 1)->get();
        // foreach($jadwals as $jadwal)
        // $users = User::checkUserInJadwal($jadwal->id)
        // endforeach

    }
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
