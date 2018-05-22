<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {}

    public function show($id)
    {
        $user = User::find($id);
        $notification = Notification::where('receiver', Auth::user()->id)->orderBy('created_at', 'desc');

        return view('profile.show', compact('user','notification'));
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $data = $request->except(['_token', 'file', 'MAX_FILE_SIZE']);
        $file = $request->file('file');

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

        $data['image'] = $file->store('pic', 'public');

        $data['password'] = bcrypt($data['password']);

        if ($user->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('profile.show', $id);
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back();
    }
}
