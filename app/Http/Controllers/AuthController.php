<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function page(Request $request) {
        if($request->user()) {
            return redirect()->route('dashboard');
        }
        
        return view('pages.auth.index');
    }

    // auth user
    public function auth(Request $request) {
        // if user authenticated regenerate session
        if(Auth::attempt($request->all())) {
            $request->session()->regenerate();

            // redirect to authtenticated user initial view
            $data = [
                'message' => 'Successfully validated',
                'status' => 200
            ];
            
            return $data;
        }

        // error response 
        $data = [
            'message' => 'Unable to validate',
            'status' => 400
        ];

        return $data;
    }

    // logout user
    public function logout() {
        Auth::logout();

        $data = [
            'message' => 'Successfully loged out',
            'status' => 200
        ];

        return $data;
    }
}
