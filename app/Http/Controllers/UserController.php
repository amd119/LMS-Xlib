<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserStoreRequest;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Administrator');
    }

    public function index(User $user)
    {
        $data = $user->all();
        return view('user.home', compact('data'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'NamaLengkap' => 'required',
            'Alamat' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'NamaLengkap' => $request->NamaLengkap,
            'Alamat' => $request->Alamat,
            'password' => Hash::make($request->password),
            'Role' => 2,
        ]);

        event(new Registered($user));

        return redirect()->route('user.home')->with('success', 'Selamat, Data Petugas Berhasil di Tambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {

        // Update the user data
        $user->update($request->validated());

        // Redirect or return a response
        return redirect()->route('user.home')->with('success', 'User data updated successfully.');
    }

    public function delete($id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            
            session()->flash('success', 'User berhasil dihapus.');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus user: ' . $e->getMessage());
            return response()->json(['success' => false], 500);
        }
    }
}
