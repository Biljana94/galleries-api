<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request) {
        $credentials = $request->only(['email', 'password']); //u $credentials smo stavili email i password koji user salje pri logovanju
        $token = auth()->attempt($credentials); //generisemo token za email i password koji smo dobili pri logovanju

        //ako nema tokena
        if(!$token) {
            return response()->json([
                'message' => 'You are not authorized!' //vrati poruku da korisnik nije autorizovan
            ], 401); //401 je greska kao drugi parametar(not authorized)
        }

        return response()->json([
            'token' => $token,
            'type' => 'bearer', //tip tokena
            'expires_in' => auth()->factory()->getTTL() * 60, //kad token istice
            'user' => auth()->user(), //vracamo autentifikovanog usera
        ]);
    }
}
