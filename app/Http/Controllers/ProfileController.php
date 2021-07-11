<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Users;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $title = 'Profil';
        return view('profile.show', compact('title'))->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $title = 'Edit Profil';
        return view('profile.edit', compact('title', 'user'));
    }

    public function update(Request $request, $user)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:255',
            'nrp' => 'required|size:9|unique:users,nrp,' . $user,
            'angkatan' => 'required|size:4',
            'email' => 'required|min:5|unique:users,email,' . $user,
        ]);

        User::whereId($user)->update([
            'name' => $request->name,
            'nrp' => $request->nrp,
            'angkatan' => $request->angkatan,
            'email' => $request->email,
        ]);

        return redirect()->route('profile.show', $user)->with('success', 'Profil berhasil diubah!');
    }

    public function updatePassword(Request $request, $user)
    {
        $this->validate($request, [
            'password_current' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $current_user = User::find($user);
        if ($current_user->password === $request->password_current) {
            User::whereId($user)->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('success', 'Password berhasil diubah!');
        } else {
            return redirect()->back()->with('danger', 'Password sekarang Anda salah!');
        }
    }
}
