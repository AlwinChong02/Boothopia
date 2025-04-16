<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected function validatorForUpdate(array $data, $userId)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $userId
            ],
            'password' => ['nullable', 'string', 'min:8'],
            'phone' => ['nullable', 'regex:/^\d+$/', 'min:10', 'max:15'],
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already taken.',
            'password.min' => 'Password must be at least 8 characters.',
            'phone.regex' => 'Phone number must contain digits only.',
            'phone.min' => 'Phone number must be at least 10 digits.',
            'phone.max' => 'Phone number cannot exceed 15 digits.',
        ]);
    }

    public function index()
    {
        $this->authorize('viewAny', User::class); 
        $data = User::paginate(15); //all users data
        return view('user.userList', ['users' => $data]);
    }

    public function show()
    {
        $user = auth()->user();
        $this->authorize('view', $user); 
        return view('user.viewProfile', ['user' => $user]);
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
            // Ensure the user is authorized to update
            $this->authorize('update', $data);

            // Call the validator function and run validation
            $this->validatorForUpdate($req->all(), $data->id)->validate();

             $data->name = $req->name;
             $data->email = $req->email;
             $data->phone = $req->phone;

            // Check if the password is provided in the request
            if (!empty($req->password)) {
                $data->password = Hash::make($req->password);
            }

            // Only allow role update if the current user is admin
            if (Gate::allows('isAdmin')) {
                $data->role = $req->role;
            }

            // Save the changes to the database
            $data->save();

            // Determine where to redirect based on the previous URL
            $redirectUrl = $req->input('redirect_to', route('userList'));

            // Redirect back to the appropriate page (either profile or user list)
            return redirect($redirectUrl)->with('success', 'User information successfully updated!');
        }
        return redirect()->route('userList')->with('error', 'Failed to update user information! Please try again or contact support.');
    }

    //Delete
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->authorize('delete', $user);

            $user->delete();
            return redirect()->route('userList')->with('success', 'User account successfully deleted !');
        }
        return redirect()->route('userList')->with('error', 'Failed to delete user account! Please try again or contact support.');
    }
}
