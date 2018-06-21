<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Controllers\ApiController;

class UserController extends Controller
{
    public function __construct()
    {}

    public function index()
    {
        $user = User::get();
        return view('admin.user.index', compact('user'));
    }

    public function create()
    {
        $filters = ApiController::getFilters();
        return view('admin.user.create', compact('filters'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $data['password'] = bcrypt($data['password']);

        $user = new User($data);

        if ($user->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.user.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($user->getErrors())->withInput();
    }

    public function edit(User $user)
    {
        $filters = ApiController::getFilters();
        return view('admin.user.edit', compact('filters', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->except(['_token']);

        $data['password'] = bcrypt($data['password']);

        if ($user->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.user.index');
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($user->getErrors())->withInput();
    }


    public function destroy(User $user)
    {
        if ($user->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
