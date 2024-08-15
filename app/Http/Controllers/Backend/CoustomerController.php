<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CoustomerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Coustomer;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;

class CoustomerController extends Controller
{
    use ImageUploadTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(CoustomerDataTable $dataTable)
    {
        return $dataTable->render('admin.coustomer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coustomer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:coustomers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required',
            'image' => 'required',
        ]);

        $coustomerData = new Coustomer();
        $imagePath = $this->uploadImage($request, 'image', 'upload');
        $coustomerData->image = $imagePath;
        $coustomerData->name = $request->name;
        $coustomerData->email = $request->email;
        $coustomerData->phone = $request->phone;
        $coustomerData->address = $request->address;
        $coustomerData->shopname = $request->shopname;
        $coustomerData->account_holder = $request->account_holder;
        $coustomerData->account_number = $request->account_number;
        $coustomerData->bank_name = $request->bank_name;
        $coustomerData->bank_branch = $request->bank_branch;
        $coustomerData->city = $request->city;
        $coustomerData->save();
        // toastr('Customer Created Successfully!', 'success');
        return redirect()->route('admin.coustomer.index')->with('success', 'Customer Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
