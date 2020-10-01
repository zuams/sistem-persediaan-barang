<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function shop()
    {
        $products = Product::all();
        return view('shop')->withTitle('E-COMMERCE STORE | SHOP')->with(['products' => $products]);
    }

    public function cart()  {
        $cartCollection = \Cart::getContent();
        $totalQuantity = \Cart::getTotalQuantity();
        return view('cart', compact(['cartCollection', 'totalQuantity']));
    }

    public function add(Request $request){
        $product = Product::findOrFail($request->id);
        $cart = \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => 0,
            'quantity' => $request->stock,
            'attributes' => array(
                'stock' => $product->stock,
                'image_url' => $product->image_url
            )
        ));

        return response()->json(["status" => "success"], 200);
    }

    public function renderCart() {
        return view('layouts.module.navbar')->render();
    }

    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function update(Request $request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Cart is Updated!');
    }

    public function clear(){
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');
    }
}