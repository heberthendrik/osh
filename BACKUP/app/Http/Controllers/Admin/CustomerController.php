<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Controllers\ApiController;

class CustomerController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $customer = Customer::distinct();

        ApiController::visibleData($customer);

        $customer = $customer->get();
        return view('admin.customer.index', compact('customer'));
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return view('admin.customer.show', compact('customer'));
    }

    public function create()
    {
        $filters = ApiController::getFilters();
        return view('admin.customer.create', compact('filters'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $customer = new Customer($data);

        if ($customer->save()) {
            notify()->flash("Input Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.customer.index');
        }

        notify()->flash("Input Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($customer->getErrors())->withInput();
    }

    public function edit(Customer $customer)
    {
        $filters = ApiController::getFilters();
        return view('admin.customer.edit', compact('filters','customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->except(['_token']);

        if ($customer->update($data)) {
            notify()->flash("Update Data Berhasil", 'success', ['title' => "Success"]);
            return redirect()->route('settings.customer.index');
        }

        notify()->flash("Update Data Gagal", 'error', ['title' => "Error"]);
        return redirect()->back()->withErrors($customer->getErrors())->withInput();
    }


    public function destroy(Customer $customer)
    {
        if ($customer->delete()) {
            notify()->flash("Hapus Data Berhasil", 'success', ['title' => "Success"]);
        } else {
            notify()->flash("Hapus Data Gagal", 'error', ['title' => "Error"]);
        }

        return redirect()->back();
    }
}
