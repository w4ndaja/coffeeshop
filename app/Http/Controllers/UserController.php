<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if (!in_array($request->role, ['Admin', 'Kasir', 'User'])) {
      return abort(404);
    }
    $users = User::search($request->search, 'email', 'name', 'phone')
      ->whereRole($request->role)
      ->paginate($request->perpage ?? 10);

    return view('admin.pages.user.index', [
      'title' => $request->role,
      'users' => $users,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $user = new User;
    $user->role = request('role');
    if (!in_array($user->role, ['Admin', 'Kasir', 'User'])) {
      return abort(404);
    }
    return view('admin.pages.user.form', [
      'title' => 'New User',
      'data' => $user,
      'action' => route('admin.users.store'),
      'submit' => 'Save',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if (!in_array($request->role, ['Admin', 'Kasir', 'User'])) {
      return abort(404);
    }
    $form = $request->validate([
      'name' => 'required|string',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6|string|confirmed',
      'role' => 'required|string',
    ]);
    $form['password'] = bcrypt($request->password);

    User::create($form);

    return redirect()->route('admin.users.index', ['role' => $request->role])->with('success', [
      'title' => 'User',
      'message' => 'User successfully created!'
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    return view('admin.pages.user.form', [
      'title' => "Edit {$user->name} User",
      'data' => $user,
      'action' => route('admin.users.update', $user),
      'method' => 'PUT',
      'submit' => 'Update',
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    if (!in_array($request->role, ['Admin', 'Kasir', 'User'])) {
      return abort(404);
    }
    $form = $request->validate([
      'name' => 'required|string',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'password' => 'required|min:6|string|confirmed',
      'role' => 'required|string',
    ]);
    $form['password'] = bcrypt($request->password);

    $user->update($form);

    return redirect()->route('admin.users.index', ['role' => $request->role])->with('success', [
      'title' => 'User',
      'message' => 'User successfully updated!'
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    $user->delete();

    return redirect()->route('admin.users.index', ['role' => 'Admin'])->with('success', [
      'title' => 'User',
      'message' => 'User successfully deleted!'
    ]);
  }
}
