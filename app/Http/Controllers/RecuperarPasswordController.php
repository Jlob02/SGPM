<?php

namespace App\Http\Controllers;

use App\Mail\RecuperarPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class RecuperarPasswordController extends Controller
{
    //
    public function recuperar_password(Request $request)
    {
        $data = $request->validate([
            'email' => ['required',],
        ], [
            'email.required' => 'Deve introduzir um email',
        ]);

        $email = $data['email'];

        $user = User::where('email', '=', $email)->first();

        if ($user == null) {
            return redirect()->back()->with('erro', 'Email invalido');
        } else {
            $time = Carbon::now();
            $string = $user->email . $time->toDateTimeString();

            $token = hash('sha256', $string);

            $user->token = $token;
            $user->save();

            Mail::to($email)->send(new RecuperarPasswordMail($token));
            return view('confirme-email');
        }
    }


    public function recuperar_password_token(Request $request)
    {
        $user = User::where('token', '=', $request->token)->first();

        if ($user == null) {
            return abort(400);;
        } else {
            return view('redefinir-password')->with('token', $request->token);;
        }
    }


    public function redefinir_password(Request $request)
    {
        $data = $request->validate([
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ], [
            'password.required' => 'Deve introduzir uma palavra-passe',
            'password.min:8' => 'A password deve ter mais de 8 caracteres',
        ]);

        $user = User::where('token', '=', $request->token)->first();

        if ($user == null) {
            return abort(400);;
        } else {
            $user->token = null;
            $user->password = Hash::make($data['password']);

            $user->save();

            return redirect('/');
        }
    }
}
