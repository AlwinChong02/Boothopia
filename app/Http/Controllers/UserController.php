<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $data = User::paginate(15); //all users data
        return view('user.userList', ['users' => $data]);
    }

    public function show()
    {
        $data = User::all(); //all users data
        return view('user.userList', ['users' => $data]);
    }


    public function showUpdateUserForm($id)
    {
        $data = User::find($id);
        if ($data) {
            return view('user.updateForm', ['users' => $data]);
        }
        return redirect()->route('userList')->with('error', 'User not found !');
    }

    public function update(Request $req)
    {
        $data = User::find($req->id);

        if ($data) {
            $data->update($req->all());
            return redirect()->route('userList')->with('success', 'User information successfully updated !');
        }
        return redirect()->route('userList')->with('error', 'User not found !');
    }

    //Delete
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('userList')->with('success', 'User successfully deleted !');
        }
        return redirect()->route('userList')->with('error', 'User not found !');
    }
}
