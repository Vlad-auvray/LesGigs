<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    // Afficher la page enregistrement/création user
    public function create() {
        return view('users.register');
    }

    // Créer nouveau user
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email'=> ['required', 'email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Creation User
        $user = User::create($formFields);

        //login
        auth()->login($user);
        return redirect('/')->with('message', 'Bienvenu.e dans la commu !');
    }

    // Déco
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'À bientôt !');
        }

      //Afficher la page de connexion
        public function login() {
            return view('users.login');
        }


      //Connexion
    public function authenticate(Request $request) {
        
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Vous êtes connecté !');
        }
            return back()->withError(['email'=> 'Invalid Credentials'])->onlyInput('email');

    }  
}
