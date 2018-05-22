<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Officer;
use App\Http\Controllers\ApiController;

class OfficerController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $officer = Officer::distinct();

        ApiController::visibleData($officer);

        $officer = $officer->get();

        return view('admin.officer.index', compact('officer'));
    }

    public function create()
    {
        $filters = ApiController::getFilters();
        return view('admin.officer.create', compact('filters'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['nama','status','kode','id_rs']);
        $officer = new Officer($data);

        if ($officer->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.officer.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($officer->getErrors())->withInput();
    }

    public function edit(Officer $officer)
    {
        $filters = ApiController::getFilters();
        return view('admin.officer.edit', compact('filters', 'officer'));
    }

    public function update(Request $request, Officer $officer)
    {
        $data = $request->only(['nama','status','kode','id_rs']);

        if ($officer->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.officer.index');
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($officer->getErrors())->withInput();
    }


    public function destroy(Officer $officer)
    {
        if ($officer->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
