<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Models\Result;

use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $tipe = request()->get('tipe', 'day');
        $filters = ApiController::getFilters();
        $result = ApiController::getResults($filters)
            ->select(DB::raw("date_trunc('".$tipe."', created_at) as tanggal"), DB::raw('count(id) as jumlah'))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        foreach($result as $res){
            if($tipe == 'day'){
            $tanggal[] = "'". Carbon::parse($res->tanggal)->format('d F Y') ."'";
            }else if($tipe == 'month'){
                $tanggal[] = "'". Carbon::parse($res->tanggal)->format('F Y') ."'";
            }else{
                $tanggal[] = "'". Carbon::parse($res->tanggal)->format('Y') ."'";
            }
            $jumlah[] = "'".$res->jumlah."'";
        }

        $tanggal = '['.implode(',', $tanggal).']';
        $jumlah = '['.implode(',', $jumlah).']';

        return view('admin.home', compact('filters','tanggal', 'jumlah'));
    }
}
