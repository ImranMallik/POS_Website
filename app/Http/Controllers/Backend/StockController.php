<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\StockDatatTableDataTable;
use App\Http\Controllers\Controller;
use App\Models\Orderdetails;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(StockDatatTableDataTable $dataTable)
    {
        return $dataTable->render('admin.stock.index');
    }

    // 
    public function updateOrderQuantity(Request $request)
    {
        $orderId = $request->input('order_id');

        // Fetch order details with products
        $orderDetails = Orderdetails::where('order_id', $orderId)->get();

        foreach ($orderDetails as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->product_store = max(0, $product->product_store - $item->quantity);
                $product->save();
            }
        }

        return response()->json(['success' => true]);
    }
}
