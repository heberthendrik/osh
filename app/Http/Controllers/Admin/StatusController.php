<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Http\Controllers\ApiController;

class StatusController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $status = Status::distinct();

        ApiController::visibleData($status);

        $status = $status->orderBy('id')
            ->get();

        return view('admin.status.index', compact('status'));
    }

    public function create()
    {
        $filters = ApiController::getFilters();
        return view('admin.status.create', compact('filters'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $status = new Status($data);

        if ($status->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.status.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($status->getErrors())->withInput();
    }

    public function edit(Status $status)
    {
        $filters = ApiController::getFilters();
        return view('admin.status.edit', compact('filters', 'status'));
    }

    public function update(Request $request, Status $status)
    {
        $data = $request->except(['_token']);

        if ($status->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.status.index');
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($status->getErrors())->withInput();
    }


    public function destroy(Status $status)
    {
        if ($status->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
