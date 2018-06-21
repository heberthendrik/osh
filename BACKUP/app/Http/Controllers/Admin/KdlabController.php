<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kdlab;
use App\Models\Nrujukan;
use App\Http\Controllers\ApiController;

class KdlabController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $kdlab = Kdlab::distinct();

        $kdlab = $kdlab->orderBy('id')
            ->get();

        return view('admin.kdlab.index', compact('kdlab'));
    }

    public function show($id)
    {
        $result = Kdlab::with(['nrujukan' => function($query){
            $query->orderBy('umur_sat')
                ->orderBy('age_1')
                ->orderBy('age_2');
        }])->find($id);

        return view('admin.kdlab.show', compact('result'));
    }

    public function create()
    {
        $filters = ApiController::getFilters();
        return view('admin.kdlab.create', compact('filters'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $kdlab = new Kdlab($data);

        if ($kdlab->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.kdlab.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($kdlab->getErrors())->withInput();
    }

    public function edit(Kdlab $kdlab)
    {
        $filters = ApiController::getFilters();
        return view('admin.kdlab.edit', compact('filters', 'kdlab'));
    }

    public function update(Request $request, Kdlab $kdlab)
    {
        $data = $request->except(['_token']);

        if ($kdlab->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.kdlab.index');
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($kdlab->getErrors())->withInput();
    }


    public function destroy(Kdlab $kdlab)
    {
        if ($kdlab->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
