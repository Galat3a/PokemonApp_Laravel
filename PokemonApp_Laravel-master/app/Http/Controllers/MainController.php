<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    function login(Request $request) {
        $request->session()->flash('message', 'User logged in');//flash, guarda el mensaje, lo muestra una vez y lo borra.
        $request->session()->put('user', true);//lo guardo en la sesion para mas rato
        return back();//
    }

    function logout(Request $request) {
        $request->session()->flash('message', 'User logged out');
        $request->session()->forget('user');
        return back();
    }

    function main() {
        return view('main.main', ['lihome' => 'active']);
    }
}
