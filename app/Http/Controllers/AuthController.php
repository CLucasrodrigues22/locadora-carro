<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function login(Request $request) {
        $credenciais = $request->all(['email', 'password']);

        // autenticação (email e senha)
        $token = auth('api')->attempt($credenciais);

        if($token) {
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['erro' => 'Credenciais incorretas'], 403);
        }
    }

    public function register(Request $request) {
        // validando campos do formulário
        $request->validate($this->user->rules(), $this->user->feedback());
        // inserindo dados do usuário no banco
        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json($user, 201);
    }

    public function refresh() {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token], 200);
    }

    public function logout() {
        auth('api')->logout();
        return response()->json(['msg' => 'Sessão finalizada com sucesso'], 200);
        }

    public function me() {
        return response()->json(auth()->user());
    }
}
