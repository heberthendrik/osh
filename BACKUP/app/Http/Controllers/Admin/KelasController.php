<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Http\Controllers\ApiController;

class KelasController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $kelas = Kelas::distinct();

        ApiController::visibleData($kelas);

        $kelas = $kelas->orderBy('id')->get();

        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $filters = ApiController::getFilters();
        return view('admin.kelas.create', compact('filters'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $kelas = new Kelas($data);

        if ($kelas->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.kelas.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($kelas->getErrors())->withInput();
    }

    public function edit(Kelas $kelas)
    {
        $filters = ApiController::getFilters();
        return view('admin.kelas.edit', compact('filters', 'kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $data = $request->except(['_token']);

        if ($kelas->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.kelas.index');
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($kelas->getErrors())->withInput();
    }


    public function destroy(Kelas $kelas)
    {
        if ($kelas->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
