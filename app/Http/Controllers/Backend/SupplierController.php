<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SupplierDataTable;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use ImageUploadTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('admin.supplier.index');
        // return view('admin.supplier.index')
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:coustomers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required',
            'type' => 'required',
            'image' => 'required',
        ]);
        $supplierData = new Supplier();
        $supplierData->name = $request->name;
        $supplierData->email = $request->email;
        $supplierData->phone = $request->phone;
        $supplierData->address = $request->address;
        $supplierData->shopname = $request->shopname;
        $supplierData->account_holder = $request->account_holder;
        $supplierData->account_number = $request->account_number;
        $supplierData->type = $request->type;
        $imagePath = $this->uploadImage($request, 'image', 'upload');
        $supplierData->image = $imagePath;
        $supplierData->bank_name = $request->bank_name;
        $supplierData->bank_branch = $request->bank_branch;
        $supplierData->city = $request->city;
        $supplierData->save();
        // toastr('Supplier Created Successfully!', 'success');
        return redirect()->route('admin.supplier.index')->with('success', 'Supplier Created Successfully!');
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
        $supplierData = Supplier::findOrFail($id);
        return view('admin.supplier.edit', compact('supplierData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:coustomers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required',
            'type' => 'required',
            'image' => 'nullable|image',
        ]);
        $supplierUpdate = Supplier::findOrFail($id);
        $imagePath = $this->updateImage($request, 'image', 'upload', $supplierUpdate->image);
        $supplierUpdate->image = (!empty($imagePath)) ? $imagePath : $supplierUpdate->image;
        $supplierUpdate->name = $request->name;
        $supplierUpdate->email = $request->email;
        $supplierUpdate->phone = $request->phone;
        $supplierUpdate->address = $request->address;
        $supplierUpdate->shopname = $request->shopname;
        $supplierUpdate->account_holder = $request->account_holder;
        $supplierUpdate->account_number = $request->account_number;
        $supplierUpdate->type = $request->type;
        $supplierUpdate->bank_name = $request->bank_name;
        $supplierUpdate->bank_branch = $request->bank_branch;
        $supplierUpdate->city = $request->city;
        $supplierUpdate->save();
        // toastr('Supplier Updated Successfully!', 'success');
        return redirect()->route('admin.supplier.index')->with('success', 'Supplier Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        $this->deleteImage($supplier->image);
        $supplier->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    // Get Details
    public function get_supplier_details(string $id)
    {
        $detailsData = Supplier::findOrFail($id);
        return view('admin.supplier.details', compact('detailsData'));
    }
}
