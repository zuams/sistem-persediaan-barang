<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $code = strtolower(str_replace(['-', ' '], ['_', '_'], $request->name));
        $categories = Categories::create([
            'name' => $request->name,
            'code' => $code
        ]);
        if ($categories) {
            return redirect('/category')->with(['success' => '<strong>'.$categories->name.' Ditambahkan']);
        }
    }

    public function create()
    {
        return view('categories.create');
    }

    public function update(Request $request, $id)
    {
        $code = strtolower(str_replace(['-', ' '], ['_', '_'], $request->name));
        $category = Categories::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'code' => $code
        ]);
        
        return redirect('/category')
            ->with(['success' => '<strong>'. $category->name.'</strong> Diupdet']);
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->back()->with(['success' => 'Category <strong>' . $category->name . '</strong> Telah Dihapus!']);
    }

    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        // dd($category->name);
        return view('categories.edit', compact('category'));
    }
}
