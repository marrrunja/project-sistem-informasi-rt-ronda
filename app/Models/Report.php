<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        "isi_laporan", "foto", "user_id", "kategori_id", "created_at", "updated_at"
    ];
}
