<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        $slider = Slider::get();
        return view('admin.slider.index', compact('slider'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token', 'slider', 'MAX_FILE_SIZE']);
        $file  = $request->file('slider');

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

        $data['image'] = $file->store('slider', 'public');

        $slider = new Slider($data);

        if ($slider->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.slider.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($slider->getErrors())->withInput();
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->except(['_token']);

        if ($slider->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.slider.index');
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($slider->getErrors())->withInput();
    }


    public function destroy(Slider $slider)
    {
        if ($slider->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
