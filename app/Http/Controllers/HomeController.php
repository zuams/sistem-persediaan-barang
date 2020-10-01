<?php

namespace App\Http\Controllers;

use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_products = Product::get()->count();
        $total_transaction_out = Transaction::sum('total');
        $total_users = User::get()->count();
        $total_stocks = Product::sum('stock');
        return view('dashboard.index', compact(['total_products', 'total_transaction_out', 'total_users', 'total_stocks']));
    }
}
