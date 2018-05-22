<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $hospital = Hospital::distinct();
        if(Auth::user()->id_rs)
        {
            $hospital = $hospital->where('id', Auth::user()->id_rs);
        }
        $hospital = $hospital->get();
        return view('admin.hospital.index', compact('hospital'));
    }

    public function create()
    {
        return view('admin.hospital.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['nama','link']);
        $file  = $request->file('image');

        if(!$file->isValid()) {
            notify()->flash("File anda tidak valid.", 'error', ['title' => "Error"]);
            return redirect()->back()->withInput();
        }
        $acceptedFiles = ['jpg', 'jpeg','png','bmp','gif'];

        if(! in_array($file->extension(), $acceptedFiles))
            return [
                'status' => false,
                'filename' => $file->getClientOriginalName
            ];

        $data['logo'] = $file->store('logo', 'public');

        $hospital = new Hospital($data);

        if ($hospital->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.hospital.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($hospital->getErrors())->withInput();
    }

    public function edit(Hospital $hospital)
    {
        return view('admin.hospital.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $data = $request->only(['nama','link']);

        $file  = $request->file('image');

        if(!$file->isValid()) {
            notify()->flash("File anda tidak valid.", 'error', ['title' => "Error"]);
            return redirect()->back()->withInput();
        }
        $acceptedFiles = ['jpg', 'jpeg','png','bmp','gif'];

        if(! in_array($file->extension(), $acceptedFiles))
            return [
                'status' => false,
                'filename' => $file->getClientOriginalName
            ];

        $data['logo'] = $file->store('logo', 'public');

        if ($hospital->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.hospital.index');
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($hospital->getErrors())->withInput();
    }


    public function destroy(Hospital $hospital)
    {
        if ($hospital->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
