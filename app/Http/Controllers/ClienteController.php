<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use GuzzleHttp\Client;

class ClienteController extends Controller
{

    protected $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = $this->cliente->get();

        return response()->json($cliente, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        $request->validate($this->cliente->rules(), $this->cliente->feedback());
        $cliente = Cliente::create([
            'nome' => $request->nome
        ]);

        return response()->json($request, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->cliente->find($id);
        if($cliente === null) {
            return response()->json(['erro' => 'Cliente pesquisado não existe'], 404);
        }

        return response()->json($cliente, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMarcaRequest  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, $id)
    {
        $cliente = $this->cliente->find($id);

        if($cliente === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O cliente solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {
            
            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($cliente->rules() as $input => $regra) {
                
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas, $cliente->feedback());
        } else {
            $request->validate($cliente->rules(), $cliente->feedback());
        }

        $cliente->fill($request->all());

        // salvando dados
        $cliente->save();

        return response()->json($cliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = $this->cliente->find($id);

        if($cliente === null) {
            return response()->json(['msg' => 'Erro ao deletar, cliente não existe em nosso banco'], 404);
        }

        $cliente->delete();
        return response()->json(['msg' => 'Cliente removido com sucesso'], 200);
    }
}
