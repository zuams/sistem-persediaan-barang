<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function index()
	{
		$users = User::get();
		return view('users.index', compact('users'));
	}

	public function create()
	{
		return view('users.create');
	}

	public function destroy($id)
	{
		$user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with(['success' => '<strong>' . $user->name . '</strong> Telah Dihapus!']);
	}

	public function edit($id)
	{
		$user = User::findOrFail($id);
		return view('users.edit', compact('user'));
	}

	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);

		$password = Hash::make($request->password);
		if (!isset($request->password)) {
			$password = $user->password;
		}
// dd($password);
		$update = $user->update([
			'name' => $request->name,
			'email' => $request->email,
			'password' => $password,
		]);			

		return redirect('/users')
            ->with(['success' => 'User updated!']);
	}
}