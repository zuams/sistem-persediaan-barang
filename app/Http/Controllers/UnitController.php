<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::get();
        return view('units.index', compact('units'));
    }

    public function store(Request $request)
    {
        $code = strtolower(str_replace(['-', ' '], ['_', '_'], $request->name));
        $unit = Unit::create([
            'name' => $request->name,
            'code' => $code
        ]);
        if ($unit) {
            return redirect('/unit')->with(['success' => 'Unit <strong>'.$unit->name.' berhasil ditambahkan']);
        }
    }

    public function create()
    {
        return view('units.create');
    }

    public function update(Request $request, $id)
    {
        $code = strtolower(str_replace(['-', ' '], ['_', '_'], $request->name));
        $unit = Unit::findOrFail($id);

        $unit->update([
            'name' => $request->name,
            'code' => $code
        ]);
        
        return redirect('/unit')
            ->with(['success' => 'Unit <strong>'. $unit->name.'</strong> berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->back()->with(['success' => 'Unit <strong>' . $unit->name . '</strong> Telah Dihapus!']);
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('units.edit', compact('unit'));
    }
}
