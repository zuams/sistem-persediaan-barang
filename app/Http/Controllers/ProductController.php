<?php

namespace App\Http\Controllers;

use Validator;
use App\Unit;
use App\Categories;
use App\Product;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'unit')->get()->sortByDesc('id');
        return view('products.index', compact('products'));
    }

    public function get()
    {
        return Product::get();
    }

    public function getById($id)
    {
        $product = Product::findOrFail($id);
        return $product;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'stock' => 'required|integer',
            'description' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->back()->withErrors($messages)->withInput($request->all()); 
        }

        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $this->saveFile($request->name, $request->file('photo'));
        }

        $product = Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'description' => $request->description,
            'category_id' => $request->category,
            'unit_id' => $request->unit,
            'image_url' => $photo
        ]);

        return redirect('/product')
            ->with(['success' => 'product <strong>' . $product->name . '</strong> berhasil ditambahkan']);
    }

    public function destroy($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();
        return redirect()->back()->with(['success' => 'Product <strong>' . $products->name . '</strong> Telah Dihapus!']);
    }

    public function create()
    {
        $categories = Categories::get();
        $units = Unit::get();
        return view('products.create', compact(['categories', 'units']));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Categories::get();
        $units = Unit::get();
        return view('products.edit', compact(['product', 'categories', 'units']));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $this->saveFile($request->name, $request->file('photo'));
            $product->update([
                'image_url' => $photo
            ]);
        }

        $product->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'description' => $request->description,
            'category_id' => $request->category,
            'unit_id' => $request->unit
        ]);

        return redirect('/product')
            ->with(['success' => '<strong>'. $product->name.'</strong> Diupdet']);
    }

    private function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/product');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }
}