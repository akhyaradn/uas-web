<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.form');
    }

    public function createPost(Request $request)
    {
        $data = $request->all();

        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);
        $user->address = $data['address'];
        $user->phone_number = $data['phone_number'];
        $user->is_admin = $data['is_admin'] ? $data['is_admin'] : false;
        $user->save();

        return redirect(url()->previous())->with("success", "Berhasil menambah user");
    }

    public function updatePost(Request $request, $id)
    {
        if($id != $request->user()->uuid) {
            return redirect(route("dashboard"));
        }
        
        $data = $request->all();
        $user = User::find($id);
        $user->name = $data['name'];
        $user->username = $data['username'];
        if(array_key_exists('password', $data) && $data['password'] != "") {
            $user->password = Hash::make($data['password']);
        }        
        $user->address = $data['address'];
        $user->phone_number = $data['phone_number'];
        if(array_key_exists('is_admin', $data)) {
            $user->is_admin = $data['is_admin'];
        }        
        $user->save();

        return redirect(url()->previous())->with("success", "Berhasil mengubah user");;
    }

    public function users(Request $request) {        
        $data = User::get();
        return view('table.usertable', compact('data'));
    }

    public function update(Request $request, $id) {
        if($id != $request->user()->uuid) {
            return redirect(route("dashboard"));
        }        

        $data = User::find($id);

        return view('users.form', compact('data'));
    }

    public function login(Request $request) {
        $creds = [
            'username' => $request->get('username'),
            'password' => $request->get('password'),
        ];

        if(Auth::attempt($creds)) {
            $token = Auth::user()->createToken(User::AUTH_TOKEN);
            $tokenEncrypt = Crypt::encryptString($token->plainTextToken);
            session()->put('token', $tokenEncrypt);
            return redirect(route("dashboard"));
        }

        return redirect(route("login"));
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route("login"));
    }


    public function register() 
    {
        return view('users.register');
    }

    public function registerPost(Request $request)
    {
        $data = $request->all();

        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);
        $user->address = $data['address'];
        $user->phone_number = $data['phone_number'];
        $user->is_admin = false;
        $user->save();

        return redirect('login')->with("success", "Berhasil register");
    }

    public function deletePost($id)
    {
        User::find($id)->delete();

        return redirect(route('users.users'))->with("success", "Berhasil hapus user");
    }
}
