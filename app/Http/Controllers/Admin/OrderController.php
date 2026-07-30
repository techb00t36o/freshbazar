<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated successfully!');
    }

    public function invoice($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('admin.orders.invoice', compact('order'));
    }

    public function exportCSV()
    {
        $orders = Order::with('user')->latest()->get();
        $filename = "orders_export_" . date('Y-m-d') . ".csv";
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        fputcsv($handle, ['Order ID', 'Customer Name', 'Email', 'Total Amount', 'Status', 'Date']);

        foreach ($orders as $order) {
            fputcsv($handle, [
                $order->id,
                $order->user->name ?? 'Guest User',
                $order->user->email ?? 'N/A',
                $order->total,
                $order->status,
                $order->created_at->format('Y-m-d H:i:s')
            ]);
        }

        fclose($handle);
        exit;
    }

    public function report()
    {
        $total_orders = Order::count();
        $total_revenue = Order::where('status', '!=', 'cancelled')->sum('total');
        $status_summary = Order::select('status', \DB::raw('count(*) as count'))
                                ->groupBy('status')
                                ->get();
        
        $recent_orders = Order::with('user')->latest()->limit(20)->get();

        return view('admin.orders.report', compact('total_orders', 'total_revenue', 'status_summary', 'recent_orders'));
    }
}
