<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\LoginNeedsVerification;
use App\Models\User;

class LoginController extends Controller
{
    public function submit(Request $request) {

        $request->validate([
            'phone' => 'required|numeric|min:10'
        ]);

        $user = User::firstOrCreate([
            'phone' => $request->phone
        ]);

        if(!$user) {
            return response()->json(['Could not find an account with that phone number', 401]);
        }

        $user->notify(new LoginNeedsVerification());

        return response()->json(['Text message sent']);

    }


    public function verify(Request $request) {

        $request->validate([
            'phone' => 'required|numeric|min:10',
            'login_code' => 'required|numeric|between:111111,999999'
        ]);

        $user = User::where('phone', $request->phone)
            ->where('login_code', $request->login_code)
            ->first();

        if($user) {

            $user->update([
                'login_code' => null
            ]);
            return $user->createToken($request->login_code)->plainTextToken;
        }

        return response()->json(['Invalid verification code', 401]);
        
    }
}
