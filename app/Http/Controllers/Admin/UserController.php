<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('active', 1)->orderBy('created_at', 'desc')->get();
        return view('BE.Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('BE.Users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $userData=[
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "password" => $request->password,
        ];

        // Create a new user
        User::create($userData);

        return redirect()->route('user.index')->with('success', 'Người dùng được thêm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('BE.Users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        try{
        $user = User::find($request->id);

        // Update user information based on the request data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        // Check if a new password is provided and update it
        if ($request->has('password')) {
            $user->password = $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Người dùng được cập nhật thành công.');
        }catch(\Throwable $th){
            return redirect()->route('user.index')->with('success', 'Người dùng được cập nhật thất bại.');
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function softdel($id)
    {
        $user = User::find($id);
        $user->active = 0;
        $user->save();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
    public function trast(){
        $users = User::where('active', 0)->orderBy('created_at', 'desc')->get();
        return view('BE.Users.trast', compact('users'));
    }

    public function restore($id)
    {
        $user = User::find($id);
        $user->active = 1;
        $user->save();
        return redirect()->back()->with('success', 'khôi phục thành công');
    }
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
