<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coustomer;
use App\Models\Order;
use App\Models\Orderdetails;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    public function addToCart(Request $request)
    {
        Cart::add([
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'qty' => $request->input('qty'),
            'weight' => 20,
            'options' => ['size' => 'large']
        ]);
        // return response()->json(['success' => 'Product added to cart!']);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function showCart()
    {
        $product_item = Cart::content();

        return view('admin.pos.show', compact('product_item'));
    }

    public function updateCart(Request $request)
    {
        // dd($request->all());
        $rowId = $request->input('rowId');
        $qty = $request->input('qty');



        // Update the quantity of the cart item
        Cart::update($rowId, $qty);

        // Fetch the updated cart item
        $cartItem = Cart::get($rowId);
        $subtotal = $cartItem->price * $cartItem->qty;

        // Return the updated subtotal as JSON
        return response()->json(['subtotal' => $subtotal]);
    }
    // Delete 
    // In your controller
    public function deleteCart(Request $request)
    {
        $rowId = $request->input('rowId');

        // Check if the cart contains the item
        if (Cart::search(fn($cartItem) => $cartItem->rowId === $rowId)->count() > 0) {
            // Remove item from cart
            Cart::remove($rowId);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'The cart does not contain rowId ' . $rowId], 404);
        }
    }


    public function invoice(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'Coustomer_name' => 'required|integer',
        ]);

        $contents = Cart::content();
        $cast_id = $request->Coustomer_name;
        $customer = Coustomer::where('id', $cast_id)->first();
        return view('admin.invoice.index', compact('customer', 'contents'))->with('success', 'Invoice Created Successfully');
    }

    public function finalInvoice(Request $request)
    {
        // dd($request->all());
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['total'] = $request->total;
        $data['invoice_no'] = 'EPSO' . mt_rand(10000000, 99999999);
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['created_at'] = Carbon::now();
        $order_id = Order::insertGetId($data);
        $contains = Cart::content();
        $pdata = array();

        foreach ($contains as $item) {
            $pdata['order_id'] = $order_id;
            $pdata['product_id'] = $item->id;
            $pdata['quantity'] = $item->qty;
            $pdata['unitcost'] = $item->price;
            $pdata['total'] = $item->total;

            $insertData = Orderdetails::insert($pdata);
        }

        Cart::destroy();
        return redirect()->route('dashboard')->with('success', 'Invoice Created Successfully');
    }
}
