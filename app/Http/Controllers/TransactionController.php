<?php

namespace App\Http\Controllers;

use Validator;
use App\Product;
use App\Categories;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(12);
        $categories = Categories::get();
        return view('transactions.index', compact(['products', 'categories']));
    }
    
    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'total' => $request->total,
            'status' => 'Processing'
        ]);

        if (!$transaction) {
            return response()->json(['status' => 0]);
        }

        for ($i=0; $i < count($request->ids); $i++) { 
            $product = Product::findOrFail($request->ids[$i]);

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $request->ids[$i],
                'stock' => $request->stocks[$i]
            ]);
        }

        \Cart::clear();
        session()->flash('success', 'Data barang berhasil di ambil');
        return response()->json(['status' => 1]);
    }

    public function history()
    {
        $transactions = Transaction::with('user')->get();
        return view('transactions.history', compact('transactions'));
    }

    public function submission()
    {
        $transactions = Transaction::get();
        return view('approval.index', compact('transactions'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::with('transactionDetails')->findOrFail($id);

        $transaction->update([
            'status' => $request->status
        ]);

        if ($transaction->status == "Completed") {
            foreach ($transaction->transactionDetails as $transactionDetail) {
                $product = Product::findOrFail($transactionDetail->product_id);
                $product->update([
                    'stock' => $product->stock - $transactionDetail->stock
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    }
}