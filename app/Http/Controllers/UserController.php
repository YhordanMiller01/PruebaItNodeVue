<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;



class UserController extends Controller
{
    /**
     * index function
     *
     * @return void
     */
    public function index(){
        return User::with('climate')->paginate(10);
    }


    /**
     * store function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request){
        $user = new User;
        $user->name  = 'nuevoUsuario'.Str::random(3);
        $user->email = Str::random(4).'@.com';
        $user->city  = $request->city;
        $user->password = Str::random(8);
        $user->save();

        return response()->json($user);
    }
}
