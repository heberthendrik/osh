<?php

namespace App\Http\Controllers\Result;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kdlab;
use App\Models\ResultDetail;
use App\Models\Notification;

use App\Http\Controllers\Api\NotificationController;

use Carbon\Carbon;

class ResultDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $data['id'] = $data['id_master'] . '-' . $data['id_lab'];
        $data['dt_periksa'] = Carbon::now();
        $data['n_rujukan'] = $request['rujukan_awal'] . ' - ' . $request['rujukan_akhir'];

        $nm_lab = Kdlab::find($data['id_lab']);

        $result = new ResultDetail($data);

        if ($result->save()) {
            $roles = 'doctor';
            $notification['text'] = 'Validasi '. $nm_lab->nama .' No. Lab '. $data['id_master'];

            NotificationController::postNotification($data['id_master'], $roles, $notification);

            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('result.summary.show', $data['id_master']);
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($result->getErrors())->withInput();
    }

    public function edit($id)
    {
        $resultdetail = ResultDetail::find($id);

        return view('result.detail.edit', compact('resultdetail'));
    }

    public function update($id, Request $request)
    {
        $data = $request->except(['_token']);
        $data['n_rujukan'] = $request['rujukan_awal'] . ' - ' . $request['rujukan_akhir'];

        $resultdetail = ResultDetail::find($id);

        if ($resultdetail->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('result.summary.show', $data['id_master']);
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($resultdetail->getErrors())->withInput();
    }

    public function destroy($id)
    {
        $resultdetail = ResultDetail::find($id);

        if ($resultdetail->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }

    public static function getValidateResult($id)
    {
        $resultdetail = ResultDetail::find($id);

        $data = [
            'kd_acc' => '1',
            'dt_acc' => Carbon::now()
        ];

        if ($resultdetail->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->back();
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($resultdetail->getErrors())->withInput();
    }

    public static function getUnvalidateResult($id)
    {
        $resultdetail = ResultDetail::find($id);

        $data = [
            'kd_acc' => '0',
            'dt_acc' => NULL
        ];

        if ($resultdetail->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->back();
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($resultdetail->getErrors())->withInput();
    }
}
