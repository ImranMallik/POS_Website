<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Traits\ImageUploadTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ProductController extends Controller
{
    use ImageUploadTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
        // return view('admin.product.index')
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();

        return view('admin.product.create', compact('category', 'supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_name' => 'required|max:200',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            // 'product_code' => 'required|unique:products,product_code|max:100',
            'product_garage' => 'nullable|max:255',
            'product_store' => 'required|integer|min:1',
            'buying_date' => 'required|date|before_or_equal:today',
            'expire_date' => 'nullable|date|after:buying_date',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|gt:buying_price',
            'product_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Random Number generator
        $pcode = IdGenerator::generate(['table' => 'products', 'field' => 'product_code', 'length' => 5, 'prefix' => 'PC']);

        $product = new Product();
        $imagePath = $this->uploadImage($request, 'product_image', 'upload');
        $product->product_image = $imagePath;
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->product_code = $pcode;
        $product->product_garage = $request->product_garage;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->product_store = $request->product_store;
        $product->buying_date = $request->buying_date;
        $product->expire_date = $request->expire_date;
        $product->created_at = Carbon::now();
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product added successfully!');
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
        $productData = Product::findOrFail($id);
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        return view('admin.product.edit', compact('productData', 'category', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|max:200',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'product_garage' => 'nullable|max:255',
            'product_store' => 'required|integer|min:1',
            'buying_date' => 'required|date|before_or_equal:today',
            'expire_date' => 'nullable|date|after:buying_date',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|gt:buying_price',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $product = Product::findOrFail($id);
        $imagePath = $this->updateImage($request, 'product_image', 'upload', $product->product_image);
        $product->product_image = empty(!$imagePath) ? $imagePath : $product->product_image;
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->product_garage = $request->product_garage;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->product_store = $request->product_store;
        $product->buying_date = $request->buying_date;
        $product->expire_date = $request->expire_date;
        $product->created_at = Carbon::now();
        $product->save();
        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $this->deleteImage($product->product_image);
        $product->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function productBarCode($id)
    {
        $product = Product::find($id);
        return view('admin.product.barcode', compact('product'));
    }
    // Product Import ----------------------------------------------------------------
    public function productimported()
    {
        return view('admin.product.import');
    }
    // Product Export----------------------------------------------------------------

    public function productExport()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    // Import product Data ----------------------------------------------------------------
    public function productImportData(Request $request)
    {
        Excel::import(new ProductsImport, $request->file('import_file'));

        return redirect()->back()->with('success', 'Product Import Success');
    }
}
