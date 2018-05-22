<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\ResultDetail;
use App\Http\Controllers\ApiController;

class SummaryController extends Controller
{

    public function index()
    {
        $filters = ApiController::getFilters();
        $result = ApiController::getResults($filters)->get();

        return view('report.summary.index', compact('filters','result'));
    }

    public function show($id)
    {
        $result = Result::with(['details' => function($query){
            $query->orderBy('kd_acc')
                ->orderBy('id_lab');
        }], 'histogram')->find($id);
        return view('report.summary.show', compact('result'));
    }
}
