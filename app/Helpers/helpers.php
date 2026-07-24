<?php

use App\Models\Kategori;
use Carbon\Carbon;




function formatTanggalIndonesia(string $tanggal):string{
    return Carbon::parse($tanggal)->translatedFormat('j F Y');
}



function showAlertOriginal(string $type, string $message):string{

    return "<div class=\"alert alert-$type\" role=\"alert\">
                $message
            </div>";
}

function formatColorStatusLaporan(string &$status, ?string &$color = null):string{
    $color = 'primary';
    switch ($status) {
        case 'diajukan':
            $color = 'primary';
            return $color;
        case 'ditinjau':
            $color = 'warning';
            return $color;
        case 'selesai':
            $color = 'success';
            return $color;
        default:
            return $color;
    }
}


