<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderDetails.productDetail'])
            ->select('orders.*', 'users.email as mainemail', 'totals.total')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin(
                DB::raw('(SELECT order_id, SUM(product_details.sale_price * order_details.quantity) as total
                        FROM order_details
                        INNER JOIN product_details ON order_details.product_detail_id = product_details.id
                        GROUP BY order_id) as totals'),
                'orders.id', '=', 'totals.order_id'
            )
            ->where('orders.status', '=', 'Chưa Xác Nhận') // Additional condition
            ->get();

        return view('BE.Oder.index', compact('orders'));
    }

    public function stt($id)
    {
        $order = Order::find($id);
        $order->status = 'Xác Nhận';
        $order->save();
        return redirect()->back()->with('success', 'Xác nhận thành công.');
    }
    public function fix($id)
    {
        dd('Xóa');
    }

    public function drop($id)
    {
        $order = Order::find($id);
        $orderdt = OrderDetail::where('order_id', $id)->get();
        foreach ($orderdt as $orderDetail) {
            $orderDetail->delete();
        }
        $order->delete();
        return redirect()->back()->with('success', 'Xóa thành công.');
    }

    public function ship()
    {
        $orders = Order::with(['user', 'orderDetails.productDetail'])
            ->select('orders.*', 'users.email as mainemail', 'totals.total')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin(
                DB::raw('(SELECT order_id, SUM(product_details.sale_price * order_details.quantity) as total
                        FROM order_details
                        INNER JOIN product_details ON order_details.product_detail_id = product_details.id
                        GROUP BY order_id) as totals'),
                'orders.id', '=', 'totals.order_id'
            )
            ->where('orders.status', '=', 'Xác Nhận') // Additional condition
            ->get();

        return view('BE.Oder.ship', compact('orders'));
    }

    public function shipOrder(Request $request, $orderId)
    {
        // Validate the request
        $request->validate([
            'order_code' => 'required', // Add any other validation rules as needed
        ], [
            'order_code.required' => 'Bạn cần nhập mã vận đơn.',
        ]);
        $order = Order::find($orderId);
        $order->order_code = $request->order_code;
        $order->status = 'Đang giao hàng';
        $order->save();
        return redirect()->back()->with('success', 'bắt đầu giao hàng thành công.');
    }
    public function done()
    {
        $orders = Order::with(['user', 'orderDetails.productDetail'])
        ->select('orders.*', 'users.email as mainemail', 'totals.total')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin(
            DB::raw('(SELECT order_id, SUM(product_details.sale_price * order_details.quantity) as total
                    FROM order_details
                    INNER JOIN product_details ON order_details.product_detail_id = product_details.id
                    GROUP BY order_id) as totals'),
            'orders.id', '=', 'totals.order_id'
        )
        ->where('orders.status', '=', 'Thành Công') // Additional condition
        ->get();
        return view('BE.Oder.done', compact('orders'));
    }

    public function unstt($id)
    {
        $order = Order::find($id);
        $order->status = 'Chưa xác nhận';
        $order->save();
        return redirect()->back()->with('success', 'Sửa thành công.');
    }

    public function err()
    {
        $orders = Order::with(['user', 'orderDetails.productDetail'])
        ->select('orders.*', 'users.email as mainemail', 'totals.total')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin(
            DB::raw('(SELECT order_id, SUM(product_details.sale_price * order_details.quantity) as total
                    FROM order_details
                    INNER JOIN product_details ON order_details.product_detail_id = product_details.id
                    GROUP BY order_id) as totals'),
            'orders.id', '=', 'totals.order_id'
        )
        ->where('orders.status', '=', 'Lỗi') // Additional condition
        ->get();

        return view('BE.Oder.err', compact('orders'));
    }

    public function shipping()
    {
        $orders = Order::with(['user', 'orderDetails.productDetail'])
        ->select('orders.*', 'users.email as mainemail', 'totals.total')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin(
            DB::raw('(SELECT order_id, SUM(product_details.sale_price * order_details.quantity) as total
                    FROM order_details
                    INNER JOIN product_details ON order_details.product_detail_id = product_details.id
                    GROUP BY order_id) as totals'),
            'orders.id', '=', 'totals.order_id'
        )
        ->where('orders.status', '=', 'Đang giao hàng') // Additional condition
        ->get();

        return view('BE.Oder.shipping', compact('orders'));
    }

    public function shipErr($id)
    {
        $order = Order::find($id);
        $order->status = 'Lỗi';
        $order->save();
        return redirect()->back()->with('success', 'Cập nhật lỗi thành công.');
    }
    public function dt($id)
    {
        $orderDetails = OrderDetail::with(['productDetail.product'])->where('order_id', $id)->get();
        return view('BE.Oder.dt', compact('orderDetails'));
    }

    public function ok(Request $request)
    {
        $id = $request->id;
        $order = Order::find($id);
        $order->status = 'Thành Công';
        $order->save();
        return redirect()->back();
    }
    public function shipErr2(Request $request)
    {
        $id = $request->id;
        $order = Order::find($id);
        $order->status = 'Lỗi';
        $order->save();
        return redirect()->back();
    }
}
