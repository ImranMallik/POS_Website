<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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

    // handel Increment or Decrement
    // public function updateCart(Request $request)
    // {
    //     // dd($request->all());
    //     $rowId = $request->input('rowId');
    //     $qty = $request->input('qty');

    //     Cart::update($rowId, $qty);

    //     $cartItem = Cart::get($rowId);
    //     $subtotal = $cartItem->price * $cartItem->qty;

    //     return response()->json(['subtotal' => $subtotal]);
    // }
    public function updateCart(Request $request)
    {
        // dd($request->all());
        $rowId = $request->input('rowId');
        $qty = $request->input('qty');

        // Check if the rowId exists in the cart
        // if (!Cart::get($rowId)) {
        //     return response()->json(['error' => 'The cart does not contain rowId ' . $rowId], 404);
        // }

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
}
