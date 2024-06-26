<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * ユーザーの一覧を表示する。
     * Display a listing of the users.
     * 
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }

        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * 指定されたユーザーの編集フォームを表示する。
     * Show the form for editing the specified user.
     * 
     * @param \App\Models\User $user
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    public function edit(User $user)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * 指定されたユーザーを更新する。
     * Update the specified user in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'warwick_id' => 'nullable|digits:7|unique:users,warwick_id,' . $user->id,
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * 指定されたユーザーを削除する。
     * Delete the specified user in storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
