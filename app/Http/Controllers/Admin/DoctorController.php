<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Http\Controllers\ApiController;

class DoctorController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $doctor = Doctor::distinct();

        ApiController::visibleData($doctor);

        $doctor = $doctor->get();

        return view('admin.doctor.index', compact('doctor'));
    }

    public function create()
    {
        $filters = ApiController::getFilters();
        return view('admin.doctor.create', compact('filters'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['nama','status','kode','id_rs']);
        $doctor = new Doctor($data);

        if ($doctor->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.doctor.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($doctor->getErrors())->withInput();
    }

    public function edit(Doctor $doctor)
    {
        $filters = ApiController::getFilters();
        return view('admin.doctor.edit', compact('filters', 'doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->only(['nama','status','kode','id_rs']);

        if ($doctor->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.doctor.index');
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($doctor->getErrors())->withInput();
    }


    public function destroy(Doctor $doctor)
    {
        if ($doctor->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
