<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Result;
use App\Models\ResultDetail;
use App\Models\Slider;
use App\Models\Customer;

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

        $tipe = request()->get('tipe', 'day');
        $filters = ApiController::getFilters();
        $result = ApiController::getResults($filters)
            ->select(DB::raw("date_trunc('" . $tipe . "', created_at) as tanggal"), DB::raw('count(id) as jumlah'))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $i=0;
        foreach ($result as $res) {
//           $hasil2[] = "[".Carbon::parse($res->tanggal)->format('d F Y') .", ".$res->jumlah."]";
            $hasil2[] = "[". $i .", ".$res->jumlah."]";
            $i++;
        }
        $hasil = implode(", ", $hasil2);

        $customer = Customer::distinct();
        ApiController::visibleData($customer);
        $data['customer'] = $customer->count();

        $male_customer = Customer::where("sex", "L");
        ApiController::visibleData($male_customer);
        $data['male_customer'] = ($male_customer->count() / $data['customer']) * 100;

        $female_customer = Customer::where("sex", "P");
        ApiController::visibleData($female_customer);
        $data['female_customer'] = ($female_customer->count() / $data['customer']) * 100;

        $age_customer = Customer::select(
            DB::raw("SUM(CASE WHEN date_part('year', age(tgl_lahir)) < 20 then 1 END) as under20"),
            DB::raw("SUM(CASE WHEN date_part('year', age(tgl_lahir)) > 20 AND date_part('year', age(tgl_lahir)) <= 30 then 1 END) as age20"),
            DB::raw("SUM(CASE WHEN date_part('year', age(tgl_lahir)) > 30 AND date_part('year', age(tgl_lahir)) <= 40 then 1 END) as age30"),
            DB::raw("SUM(CASE WHEN date_part('year', age(tgl_lahir)) > 40 then 1 END) as above40"));
        ApiController::visibleData($age_customer);

        $age_customer = $age_customer->get();

        foreach ($age_customer as $rsCustomer) {
            $data['under20'] = ($rsCustomer->under20 / $data['customer']) * 100;
            $data['age20'] = ($rsCustomer->age20 / $data['customer']) * 100;
            $data['age30'] = ($rsCustomer->age30 / $data['customer']) * 100;
            $data['above40'] = ($rsCustomer->above40 / $data['customer']) * 100;
        }

        return view('dashboard', compact('filters', 'sliders', 'data', 'hasil'));
    }
}
