<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get_index() {
        // Get all products and show them on home page
        $products = Product::all();
        return view('index')->with('products', $products);
    }
    
    public function get_add_to_cart($id, $row_id) {
        // Find product or show error page
        $product = Product::findOrFail($id);
        
        // If session holds cart, get it; otherwise create new Cart object
        $cart = session('cart') ? : new Cart;
        
        // Add product to the Cart
        $cart->add($product);
        
        // Put new Cart object in session
        session()->put('cart', $cart);
        
        return redirect()->to("/#$row_id");
    }
    
    public function get_shopping_cart() {
        if (!session('cart')) {
            return view('shop.shopping_cart');
        }
        
        $cart = session('cart');
        return view('shop.shopping_cart')->with('cart', $cart);
    }
    
    public function get_checkout() {
        if (!session('cart')) {
            return view('shop.shopping_cart');
        }
        
        $cart = session('cart');
        return view('shop.checkout')->with('total', $cart->total_price);
    }
    
    public function post_checkout(Request $request) {
        if (!session('cart')) {
            return redirect()->route('product.shopping_cart');
        }
        
        $cart = session('cart');
        
        // Set API secret key
        Stripe::setApiKey("sk_test_soL57Je7OU2BKGMTczw8Ofbq");

        try{ // Try charging
            $charge = Charge::create(array(
                "amount" => $cart->total_price * 100,
                "currency" => "usd",
                "source" => $request->stripe_token, // obtained with Stripe.js
                "description" => "Charge for $request->name"
            ));
            
            // Save order in database
            $order = new Order([
                'cart' => serialize($cart),
                'address' => $request->address,
                'name' => $request->name,
                'payment_id' => $charge->id
            ]);
            
            auth()->user()->orders()->save($order);
            
        } catch (\Exception $ex) {
            return redirect()->route('product.checkout')->with('error', $ex->getMessage());
        }
        
        // Remove Cart object from session
        session()->forget('cart');
        
        // Redirect home with success message
        return redirect()->route('product.index')->with('success', 'Successfully purchased products!');
    }
    
    public function get_reduce_by_one($id) {
        if (!session('cart')) {
            return redirect()->route('product.shopping_cart');
        }
        
        // Get product
        $product = Product::findOrFail($id);
        
        // Get Cart
        $cart = session('cart');
        
        // Reduce product quantity by one
        $cart->reduce_by_one($product);
        
        // If Cart still has items after reduction, store it in the session
        if (count($cart->items) > 0) {
            session()->put('cart', $cart);
            
        }else{ // Otherwise remove Cart from the session
            session()->forget('cart');
        }
        
        return redirect()->route('product.shopping_cart');
    }
    
    public function get_remove_item($id) {
        if (!session('cart')) {
            return redirect()->route('product.shopping_cart');
        }
        
         // Get product
        $product = Product::findOrFail($id);
        
        // Get Cart
        $cart = session('cart');
        
        // Remove item from the Cart
        $cart->remove_item($product);
        
        // If Cart still has items after reduction, store it in the session
        if (count($cart->items) > 0) {
            session()->put('cart', $cart);
        } else { // Otherwise remove Cart from the session
            session()->forget('cart');
        }

        return redirect()->route('product.shopping_cart');
    }
}
