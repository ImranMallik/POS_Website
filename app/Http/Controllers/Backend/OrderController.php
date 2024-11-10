<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CompletOrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderdetails;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    //

    public function orderPending(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending_order');
    }

    // Complete Order

    public function orderComplete(CompletOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.complete_order');
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

    public function downloadInvoice($id)
    {
        $orderId = Order::with('customerDetails')->findOrFail($id);

        $orderDetailsData = Orderdetails::where('order_id', $id)->orderBy('id', 'DESC')->get();

        foreach ($orderDetailsData as $item) {
            $item->product_image_base64 = $this->convertImageToBase64(public_path($item->product->product_image));
        }

        $pdf = Pdf::loadView('admin.order.order_invoice', compact('orderId', 'orderDetailsData'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
            'font' => 'DejaVu Sans'
        ]);
        return $pdf->download('invoice.pdf');
    }


    private function convertImageToBase64($path)
    {
        if (file_exists($path)) {
            $imageData = file_get_contents($path);
            $base64 = 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageData);
            return $base64;
        }
        return null;
    }
}
