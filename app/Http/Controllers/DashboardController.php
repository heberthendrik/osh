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

        $filters = ApiController::getFilters();

        $data['today'] = ApiController::getResults($filters)
            ->where(DB::raw("date_trunc('day', created_at)"), Carbon::today())->get()
            ->count();

        $data['todayComplete'] = ApiController::getResults($filters)
            ->where(DB::raw("date_trunc('day', created_at)"), Carbon::today())->get()
            ->where("kd_acc", '1')
            ->count();

        $data['todayPending'] = $data['today'] - $data['todayComplete'];

        $data['todayCustomer'] = ApiController::getResults($filters)
            ->select('no_rm')
            ->where(DB::raw("date_trunc('day', created_at)"), Carbon::today())
            ->groupBy('no_rm')->get()
            ->count();

        $limit = 29;
        $last = Carbon::today()->subDays($limit);
        $resultGenerated = ApiController::getResults($filters)->select(DB::raw("date_trunc('day', created_at) as tanggal"), DB::raw('count(id) as jumlah'))
            ->where(DB::raw("date_trunc('day', created_at)"), '>=', Carbon::today()->subDays($limit))
            ->groupBy('tanggal')
            ->orderBy('tanggal');

        $resultApproved = ApiController::getResults($filters)->select(DB::raw("date_trunc('day', dt_acc) as tanggal"), DB::raw('count(id) as jumlah'))
            ->where(DB::raw("date_trunc('day', dt_acc)"), '>=', Carbon::today()->subDays($limit))
            ->groupBy('tanggal')
            ->orderBy('tanggal');

        for ($j = 0; $j <= $limit; $j++) {
            $resultMonthly = $resultGenerated->where(DB::raw("date_trunc('day', created_at)"), $last);
            $countMonthly = $resultMonthly->get();

            $resultMonthlyApproved = $resultApproved->where(DB::raw("date_trunc('day', created_at)"), $last);
            $countMonthlyApproved = $resultApproved->get();

            if ($countMonthly->count() > 0) {
                $valueMonthly = $resultMonthly->first()->jumlah;
            } else {
                $valueMonthly = 0;
            }

            if ($countMonthlyApproved->count() > 0) {
                $valueMonthlyApproved = $resultMonthlyApproved->first()->jumlah;
            } else {
                $valueMonthlyApproved = 0;
            }

            $hasilDaily[$j] = $valueMonthly;
            $hasilDailyApproved[$j] = $valueMonthlyApproved;

            $hasilMonthly[$j] = "['" . $last->format('d F') . "', " . $valueMonthly . "]";
            $hasilMonthlyApproved[$j] = "['" . $j . "', " . $valueMonthlyApproved . "]";
            $last->addDay();
        }
        $data['MonthlyResult'] = implode(",", $hasilMonthly);
        $data['MonthlyResultApproved'] = implode(",", $hasilMonthlyApproved);

        $limitWeekly = 6;
        $lastWeekly = Carbon::today()->subDays($limitWeekly);
        $gap = $limit-$limitWeekly;

        for ($k = 0; $k <= $limitWeekly; $k++) {
            $valueWeeklyGenerated = $hasilDaily[$k + $gap];
            $valueWeeklyApproved = $hasilDailyApproved[$k+$gap];

            $valueWeeklyPending = $valueWeeklyGenerated - $valueWeeklyApproved;

            $hasilWeeklyGenerated[$k] = "['" . $lastWeekly->format('l') . "', " . $valueWeeklyGenerated . "]";
            $hasilWeeklyApproved[$k] = "['" . $lastWeekly->format('l') . "', " . $valueWeeklyApproved . "]";
            $hasilWeeklyPending[$k] = "['" . $lastWeekly->format('l') . "', " . $valueWeeklyPending . "]";

            $lastWeekly->addDay();
        }

        $data['WeeklyResult'] = implode(",", $hasilWeeklyGenerated);
        $data['WeeklyApproved'] = implode(",", $hasilWeeklyApproved);
        $data['WeeklyPending'] = implode(",", $hasilWeeklyPending);

        $totalAll = ApiController::getResults($filters)->get()->count();
        $totalComplete = ApiController::getResults($filters)->where("kd_acc", '1')->get()->count();

        $data['resultComplete'] = isset($totalAll) ? ($totalComplete / $totalAll) * 100 : '0';

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

        $data['latestData'] = ApiController::getResults($filters)->where('dt_print', NULL)->orderBy('id', 'DESC')->get();

        return view('dashboard', compact('filters', 'sliders', 'data'));
    }
}
