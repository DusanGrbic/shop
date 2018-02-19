<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get_signup() {
        // Show signup form
        return view('user.signup');
    }
    
    public function post_signup(Request $request) {
        // Validate request
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|confirmed'
        ]);
        
        // Create new User
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        
        // Log In User
        auth()->login($user);
        
        // if user was forced to login, return him to the previous page
        if (session('old_url')) {
            $old_url = session('old_url');
            session()->forget('old_url');
            return redirect()->to($old_url);
        }
        
        return redirect()->route('product.index');
    }
    
    public function get_signin() {
        // Show signin form
        return view('user.signin');
    }
    
    public function post_signin(Request $request) {
        // Attempt login
        if (!auth()->attempt($request->only(['email', 'password']))) { // If fails redirect back with error
            session()->flash('email', $request->email);
            return back()->withErrors(['signin' => 'Check your input and try again']);
        }
        
        // if user was forced to login, return him to the previous page
        if (session('old_url')) {
            $old_url = session('old_url');
            session()->forget('old_url');
            return redirect()->to($old_url);
        }

        return redirect()->route('product.index');
    }
 
    public function get_profile() {
        // Get current user's orders
        $orders = auth()->user()->orders;
        
        // Unserialize cart field
        $orders->transform(function ($order){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        return view('user.profile')->with('orders', $orders);
    }
    
    public function get_logout() {
        // Logout user and redirect to home page
        auth()->logout();
        return redirect()->route('user.signin');
    }
    
}
