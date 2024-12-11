<?php

namespace App\Http\Controllers;

use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(4);

        return view('admin/users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/add-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $userValidation = validator(
            $request->all(),
            [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'role' => 'required',
            ]
        );

        $users = User::create([
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        $toEmail = $request->email;
        $msg = "Hello, You are employee of our team";
        $subject = "Welcome to our Website";

        Mail::to($toEmail)->send(new UserMail($msg, $subject));

        if ($users) {
            return redirect()->route('users.index')->with('status', 'Successfully Registerd New User');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $user = User::find($id);

        // return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        // return $user;
        return view('admin/update-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userValidation = validator($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $user = User::find($id);

        $user->update([
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'role' => $request->role
        ]);

        if ($user) {
            return redirect()->route('users.index')->with('status', 'Successfully Updated User');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('users.index')->with('status', 'Successfully Deleted User');
    }
}
