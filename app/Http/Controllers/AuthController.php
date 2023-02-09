<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    public function register(Request $request)
    {
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

    /**
     * Login do usuário
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // validando se os campos de email e senha estão preenchidos
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        // checkar o e-mail do usuario
        $user = $this->user->where('email', $request->email)->first();

        // validar email e senha para criar a sessão
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'msg' => 'Credenciais inválidas'
            ], 401);
        }

        // gerando token do usuário
        $token = $user->createToken('primeirotoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    /**
     * logout do usuário
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        
        if(auth()->user()->tokens()->delete()) {
            $response = [
                'msg' => 'Sessão finalizada com sucesso'
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'msg' => 'Erro ao finalizar a sessão'
            ];

            return response()->json($response, 200);
        }
    }
}
