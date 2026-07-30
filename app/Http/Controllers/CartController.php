<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('frontend.cart', compact('cartItems'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart');
    }

    public function sync(Request $request)
    {
        $items = $request->input('cart', []);
        
        // Format for session: [id => ['price' => X, 'quantity' => Y, 'name' => Z]]
        $cart = [];
        foreach ($items as $item) {
            $cart[$item['id']] = [
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['qty']
            ];
        }
        
        session()->put('cart', $cart);
        
        return response()->json(['success' => true]);
    }

    public function remove($id)
    {
        Cart::where('id', $id)->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed');
    }
}