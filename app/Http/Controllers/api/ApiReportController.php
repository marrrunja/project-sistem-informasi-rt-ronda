<?php

namespace App\Http\Controllers\api;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApiReportController extends Controller
{
    public function getTotalData():JsonResponse{
        return response()->json([
            'total' => Report::count() 
        ]);
    }
    public function getData(Request $request):JsonResponse
    {
        $totalData = Report::count();
        $offset = $request->offset === 0 ? 0 : $request->offset; 
        $limit = 10;

        if($offset > $totalData)
            return response()->json([]);

        $reports = DB::table('reports')
                    ->join('kategoris', 'reports.kategori_id','=' ,'kategoris.id')
                    ->join('users', 'reports.user_id', '=' ,'users.id')
                    ->select("users.nama_lengkap", "reports.*", 'kategoris.kategori')
                    ->orderBy('reports.id', 'desc')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
        
        return response()->json([
            'data'=>$reports
        ]);
    }

    public function getDetailData(Request $request)
    {
        $id = $request->id;
        $report = DB::table('reports')
                    ->join('kategoris', 'reports.kategori_id','=' ,'kategoris.id')
                    ->join('users', 'reports.user_id', '=' ,'users.id')
                    ->select("users.nama_lengkap", "reports.*", 'kategoris.kategori')
                    ->where('reports.id', '=', $id)
                    ->first();
        $data = [
            'report' => $report
        ];
        return view('partial.detail-laporan', $data)->render();
    }

    public function getFoto(Request $request):JsonResponse
    {
        $id = $request->id;
        $foto = DB::table('reports')->select('foto')->where('id', '=', $id)->first();
        return response()->json(['foto' => $foto]);
    }
}
