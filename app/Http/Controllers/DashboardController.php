<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Result;
use App\Models\ResultDetail;
use App\Models\Slider;

use Carbon\Carbon;

use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sliders = Slider::distinct()->get();

        $tipe = request()->get('tipe', 'month');
        $filters = ApiController::getFilters();
        $result = ApiController::getResults($filters)
            ->select(DB::raw("date_trunc('".$tipe."', created_at) as tanggal"), DB::raw('count(id) as jumlah'))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        foreach($result as $res){
            $tanggal[] = "'". Carbon::parse($res->tanggal)->format('F Y') ."'";
            $jumlah[] = "'".$res->jumlah."'";
        }

        $tanggal = '['.implode(',', $tanggal).']';
        $jumlah = '['.implode(',', $jumlah).']';

        return view('dashboard', compact('filters','tanggal', 'jumlah','sliders'));
    }
}
