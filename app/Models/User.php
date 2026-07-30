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
       
        $absensi = DB::table('absensis')
                    ->join('jadwals', 'absensis.id_jadwal', '=', 'jadwals.id')
                    ->join('users','absensis.user_id', 'users.id')
                    ->where('jadwals.id', '=', $jadwalId)
                    ->where('users.id', '=', $userId)
                    ->where('jadwals.is_aktif', '=', 1)
                    ->select('users.id')
                    ->get();
       
        return $absensi;

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
