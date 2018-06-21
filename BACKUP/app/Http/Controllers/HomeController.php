<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Result;
use App\Models\ResultDetail;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $filters = ApiController::getFilters();
        if (Auth::user()->roles == 'officer') {
            return view('result.summary.create', compact('filters'));
        }else{
            return redirect('dashboard');
        }
    }
}
