<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\ResultDetail;
use App\Http\Controllers\ApiController;

use DB;

class VisitByRoomController extends Controller
{

    public function index()
    {
        $filters = ApiController::getFilters();
        $result = ApiController::getResults($filters)
            ->select(DB::raw('count(id_ruang) as jml_ruang'), 'nm_ruang')
            ->groupBy('nm_ruang')
            ->get();

        return view('report.room.index', compact('filters','result'));
    }
}
