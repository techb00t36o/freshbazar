<?php


namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
public function checkout()
{
$cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
return view('frontend.checkout', compact('cartItems'));
}


public function placeOrder()
{
$cartItems = Cart::where('user_id', Auth::id())->with('product')->get();


$total = 0;
foreach ($cartItems as $item) {
$total += $item->product->price * $item->quantity;
}


$order = Order::create([
'user_id' => Auth::id(),
'total_price' => $total,
'status' => 'pending',
]);


foreach ($cartItems as $item) {
OrderItem::create([
'order_id' => $order->id,
'product_id' => $item->product_id,
'quantity' => $item->quantity,
'price' => $item->product->price,
]);
}


Cart::where('user_id', Auth::id())->delete();


return redirect()->route('home')->with('success', 'Order placed successfully!');
}
}