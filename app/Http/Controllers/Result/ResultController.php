<?php

namespace App\Http\Controllers\Result;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Customer;
use App\Models\Ruang;
use App\Models\Kelas;
use App\Models\Status;
use App\Models\Doctor;
use App\Models\Officer;
use App\Models\User;
use App\Models\ResultDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use PDF;

class ResultController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $filters = ApiController::getFilters();
        $result = ApiController::getResults($filters)->orderBy('created_at', 'desc')->get();

        return view('result.summary.index', compact('filters', 'result'));
    }

    public function create()
    {
        $filters = ApiController::getFilters();
        return view('result.summary.create', compact('filters'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $user = $request->only(['nama', 'alamat', 'no_rm', 'sex', 'tgl_lahir', 'id_rs']);

        $today = Carbon::today();
        $lastResult = Result::distinct()->where('no_lab', 'LIKE', $today->format('ymd') . '%')->max('id');
        $checkData = Customer::where('no_rm', 'LIKE', $data['no_rm'])->where('id_rs', $data['id_rs'])->count();
        if ($checkData == 0) {
            $user['status'] = '1';
            $customer = new Customer($user);
            $customer->save();
        }
        if ($lastResult) {
            $data['id'] = $lastResult + 1;
        } else {
            $data['id'] = $today->format('ymd') . '' . sprintf("%'.04d", 1);
        }
        $data['no_lab'] = $data['id'];
        $data['nm_ruang'] = Ruang::find($data['id_ruang'])->nama;
        if (isset($data['id_kelas'])) {
            $data['nm_kelas'] = Kelas::find($data['id_kelas'])->nama;
        }
        $data['nm_status'] = Status::find($data['id_status'])->nama;
        $data['nm_dokter'] = Doctor::find($data['id_dokter'])->nama;

        $birthday = Carbon::parse($data['tgl_lahir']);

        $year = $birthday->diff($today)->format('%y');
        $month = $birthday->diff($today)->format('%m');
        $day = $birthday->diff($today)->format('%d');

        if ($year > 0) {
            $data['umur'] = $year;
            $data['umur_sat'] = 'Tahun';
        } else if ($month > 0) {
            $data['umur'] = $month;
            $data['umur_sat'] = 'Bulan';
        } else {
            $data['umur'] = $day;
            $data['umur_sat'] = 'Hari';
        }

        $data['usia'] = $birthday->diff($today)->format('%y Tahun %m Bulan %d Hari');
        $result = new Result($data);

        if ($result->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('result.summary.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($result->getErrors())->withInput();
    }

    public function destroy($id)
    {
        $result = Result::find($id);

        if (count($result->details())) {
            $result->details()->delete();
        }

        if ($result->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $result = Result::with(['details' => function($query)
        {
            $query->orderBy('kd_acc')
                ->orderBy('id_lab');
        }], 'histogram')->find($id);

        if ($result->histogram) {
            if (!$result->histogram->plt_value) {

                $img = $result->histogram->image;
                $decode = base64_decode($img);
                $ar = (array)json_decode($decode);
                $data['plt_value'] = json_encode($ar['PLT']->values->PLT);
                $data['rbc_value'] = json_encode($ar['RBC']->values->RBC);
                $data['wbc_value'] = json_encode($ar['WBC']->values->WBC);

                if ($result->histogram->update($data)) {
                    notify()->flash("Update Histogram Berhasil", 'success', ['title' => "Success"]);
                }
            }
        }

        return view('result.summary.show', compact('result'));
    }

    public static function getValidate($id)
    {
        $result = Result::find($id);
        $data_dokter = [
            'id_dokter_acc' => Auth::user()->id,
            'nm_dokter_acc' => Auth::user()->name,
        ];
        $data_acc = [
            'kd_acc' => '1',
            'dt_acc' => Carbon::now()
        ];

        $detail = ResultDetail::where('id_master', $id)->whereNull('dt_acc');

        $data = array_merge($data_dokter, $data_acc);

        if ($detail->count()) {
            $detail->update($data_acc);
        }

        if ($result->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->back();
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back();
    }

    public static function getUnvalidate($id)
    {
        $result = Result::find($id);

        $data = [
            'kd_acc' => '0',
            'dt_acc' => NULL
        ];

        if ($result->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->back();
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($result->getErrors())->withInput();
    }

    public function getPrint($id)
    {
    
    	exec('/usr/local/bin/wkhtmltoimage --width 1400 --crop-h 800 --quality 100 http://localhost/development_site/osh/custom-report-generator/?lid='.$id.' /Users/heberthendrikpelapelapon/Downloads/bbbb.png');
    	
    	exec('mv /Users/heberthendrikpelapelapon/Downloads/bbbb.png /Applications/MAMP/htdocs/development_site/osh/custom-report-generator/bbbb.png');
    	
		exec('open /Applications/MAMP/htdocs/development_site/osh/custom-report-generator/bbbb.png');
    
        $result = Result::with(['details' => function($query)
        {
            $query->orderBy('kd_acc')
                ->orderBy('id_lab');
        }], 'histogram')->find($id);
        $data = [
            'dt_print' => Carbon::now()
        ];

        if ($result->update($data)) {
//            return view('result.summary.print', compact('result'));

            $pdf = PDF::loadView('result.summary.print', compact('result'))
                ->setPaper('a4', 'landscape');
            return $pdf->stream($id);

//            return $pdf->download($id . '.pdf');
        } else {
            return redirect()->back();
        }
    }
}
