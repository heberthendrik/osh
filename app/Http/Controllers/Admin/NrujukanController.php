<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kdlab;
use App\Models\Nrujukan;
use Carbon\Carbon;

class NrujukanController extends Controller
{
    public function __construct()
    {}

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $nrujukan = new Nrujukan($data);

        if ($nrujukan->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.kdlab.show', $request['id_kdlab']);
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($nrujukan->getErrors())->withInput();
    }

    public function edit(Nrujukan $nrujukan)
    {
        return view('admin.nrujukan.edit', compact('nrujukan'));
    }

    public function update(Request $request, Nrujukan $nrujukan)
    {
        $data = $request->except(['_token']);

        if ($nrujukan->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.kdlab.show', $request['id_kdlab']);
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($nrujukan->getErrors())->withInput();
    }

    public function destroy(Nrujukan $nrujukan)
    {
        if ($nrujukan->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
