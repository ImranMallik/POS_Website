<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PendingOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderdetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    public function orderPending(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending_order');
    }

    public function orderDetails($id)
    {
        $details = Order::with(['customerDetails'])
            ->findOrFail($id);

        $orderDetailsData = Orderdetails::where('order_id', $id)->get();

        return view('admin.order.oder_details', compact('details', 'orderDetailsData'));
    }

    public function changeStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status ? 'complete' : 'pending';

        $order->save();

        return response(['message' => 'Order Status has been updated!']);
    }
}
