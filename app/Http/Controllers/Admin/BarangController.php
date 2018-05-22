<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang;

use App\Http\Controllers\ApiController;

class BarangController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $barang = Barang::distinct();

        ApiController::visibleData($barang);

        $barang = $barang->get();
        return view('admin.barang.index', compact('barang'));
    }

    public function show($id)
    {
        $barang = Barang::find($id);
        return view('admin.barang.show', compact('barang'));
    }

    public function create()
    {
        $filters = ApiController::getFilters();
        return view('admin.barang.create', compact('filters'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $barang = new Barang($data);

        if ($barang->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.barang.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($barang->getErrors())->withInput();
    }

    public function edit(Barang $barang)
    {
        $filters = ApiController::getFilters();
        return view('admin.barang.edit', compact('filters','barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $data = $request->except(['_token']);

        if ($barang->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.barang.index');
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($barang->getErrors())->withInput();
    }


    public function destroy(Barang $barang)
    {
        if ($barang->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
