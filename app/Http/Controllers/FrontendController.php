<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Auth;

class FrontendController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->latest()->get();
        
        $stats = [
            'total_orders' => $orders->count(),
            'pending_orders' => $orders->where('status', 'pending')->count(),
            'total_spent' => $orders->where('status', '!=', 'cancelled')->sum('total'),
        ];

        return view('dashboard', compact('user', 'orders', 'stats'));
    }

    public function shop()
    {
        return view('shop');
    }

    public function contact()
    {
        return view('contact');
    }
}