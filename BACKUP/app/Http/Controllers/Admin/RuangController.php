<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ruang;
use App\Http\Controllers\ApiController;

class RuangController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $ruang = Ruang::distinct();

        ApiController::visibleData($ruang);

        $ruang = $ruang->orderBy('id')
            ->get();

        return view('admin.ruang.index', compact('ruang'));
    }

    public function create()
    {
        $filters = ApiController::getFilters();
        return view('admin.ruang.create', compact('filters'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $ruang = new Ruang($data);

        if ($ruang->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.ruang.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($ruang->getErrors())->withInput();
    }

    public function edit(Ruang $ruang)
    {
        $filters = ApiController::getFilters();
        return view('admin.ruang.edit', compact('filters', 'ruang'));
    }

    public function update(Request $request, Ruang $ruang)
    {
        $data = $request->except(['_token']);

        if ($ruang->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.ruang.index');
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($ruang->getErrors())->withInput();
    }


    public function destroy(Ruang $ruang)
    {
        if ($ruang->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
