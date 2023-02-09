<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Registrar um novo usuário
     * 
     * @return \Illuminate\Http\Response
     */
    public function showUsers() {
        return $this->user->all();
    }

    /**
     * Registrar um novo usuário
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        // validando campos do formulário
        $request->validate($this->user->rules(), $this->user->feedback());
        // inserindo dados do usuário no banco
        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        // gerando token do usuário
        $token = $user->createToken('primeirotoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }
}
