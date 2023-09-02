<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),
        [
        'email' => 'required|string|email|max:255|exists:'.User::class,
        'password' => ['required', Rules\Password::defaults()],
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }
        else{
            if(Auth::attempt($request->only('email', 'password')))
            {
                $token = Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
                $token = auth()->user()->createToken('cle')->plainTextToken;
                return response()->json([
                    'token'=>$token ,
                    'status'=>200,
                    'user'=>auth()->user()],200);
            }else{
                return response()->json([
                    'statut'=>422,
                    'errors'=>'informstions non valides',
                ]);
            }
        }

        // $request->authenticate();

        // $request->session()->regenerate();

        return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
