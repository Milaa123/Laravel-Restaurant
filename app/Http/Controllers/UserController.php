<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // select * from users where role='user' order by name
        $users = User::orderby('name')->get();
        $data = [
            "title" => "Users",
            "users" => $users,
        ];

        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Add User",
        ];

        return view('user.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'username.required' => 'Tolong isi usernama dengan benar.',
            'username.unique' => 'Tolong isi username yang unik',
            'password.required' => 'Isi password dengan benar.',
            'password.min' => 'Password kurang panjang minimal 3.',
            'name.required' => 'Tolong isi nama dengan benar.',
            'role.required' => 'Isi role dengan benar.',
            // Define more custom messages here
        ];

        $data = $request->validate([
                'name' => 'required',
                'username' => 'required|alpha_num|unique:users',
                'password' => 'required|min:3',
                'role' => 'required',
            ], $messages);

        $data['password'] = Hash::make($data["password"]);
        User::create($data);
        Alert::success('Sukses', 'Add data success.');
        return redirect('user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // select * from users where id='$id'
        $user = User::find($id);
        $data = [
            "title" => "User Detail",
            "user" => $user,
        ];

        return view('user.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        // TODO : u can add some protection to disallow random id
        if(!$user) {
            return redirect('user')->with("errorMessage", "User Tidak DItemukan");
        }
        $data = [
            "title" => "Edit User",
            "user" => $user,
        ];

        return view('user.form', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $messages = [
            'username.required' => 'Tolong isi usernama dengan benar.',
            'username.unique' => 'Tolong isi username yang unik',
            'password.required' => 'Isi password dengan benar.',
            'password.min' => 'Password kurang panjang minimal 3.',
            'name.required' => 'Tolong isi nama dengan benar.',
            'role.required' => 'Isi role dengan benar.',
            // Define more custom messages here
        ];

        $data = $request->validate([
                'name' => 'required',
                'username' => 'required|alpha_num|unique:users,username,' . $id,
                'password' => 'nullable|min:3',
                'role' => 'required',
            ], $messages);
        try {

            $user = User::find($id);
            if($request->password) {
                $data['password'] = Hash::make($data["password"]);
            } else {
                $data['password'] = $user->password;
            }

            $user->update($data);
            Alert::success('Sukses', 'Edit data success.');
            return redirect('user');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('user');

        }

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            Alert::success('Sukses', 'Delete data success.');
            return redirect('user');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('user');

        }
    }
}