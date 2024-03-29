<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\PasswordForUser;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('resources.users.index', [
            'users' => User::query()->orderBy('username')->paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'patronym' => ['max:255'],
            'username' => ['required', 'max:255', 'unique:users,username'],
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'max:255', 'confirmed'],
        ]);

        User::create([
            'first_name' => $validated_data['first_name'],
            'last_name' => $validated_data['last_name'],
            'patronym' => $validated_data['patronym'],
            'username' => $validated_data['username'],
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password']),
        ]);

        return redirect('/admin/resources/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('resources.users.show', [
            'user' => User::query()->findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('resources.users.edit', [
            'user' => User::query()->findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        $rules = [
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'user_password' => [new PasswordForUser($user)],
            'patronym' => ['max:255'],
        ];

        if ($request->input('password') != '') $rules += ['password' => ['required', 'max:255', 'confirmed']];
        if ($request->input('username') != $user->username) $rules += ['username' => ['required', 'max:255', 'unique:users,username']];
        if ($request->input('email') != $user->email) $rules += ['email' => ['required', 'max:255', 'email', 'unique:users,email']];

        $validated_data = $request->validate($rules);
        
        $user->first_name = $validated_data['first_name']; 
        $user->last_name = $validated_data['last_name']; 
        $user->patronym = $validated_data['patronym']; 

        if (key_exists('password', $validated_data)) $user->password = Hash::make($validated_data['password']);
        if (key_exists('username', $validated_data)) $user->username = $validated_data['username'];
        if (key_exists('email', $validated_data)) $user->email = $validated_data['email'];

        $user->save();

        return redirect('/admin/resources/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::query()->findOrFail($id)->delete();

        return redirect('/admin/resources/users');
    }
}
