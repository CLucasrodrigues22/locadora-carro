<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreModeloRequest;
use App\Http\Requests\UpdateModeloRequest;
use App\Models\Modelo;
use Illuminate\Http\Request;
use App\Repositories\ModeloRepository;

class ModeloController extends Controller
{

    protected $modelo;

    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $modeloRepository = new ModeloRepository($this->modelo);

        // condição caso exista o atributo atributos_modelo na url
        if ($request->has('atributos_marca')) {
            $atributos_marca = 'marca:id,' . $request->atributos_marca;
            $modeloRepository->selectAtributosRegistrosRelacionados($atributos_marca);
        } else {
            $modeloRepository->selectAtributosRegistrosRelacionados('marca');
        }

        // filtro multiplo
        if ($request->has('filtro')) {
            $modeloRepository->filtro($request->filtro);
        }

        // condição caso exista o atributo atributos na url
        if ($request->has('atributos')) {
            $modeloRepository->selectAtributos($request->atributos);
        }

        return response()->json($modeloRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreModeloRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModeloRequest $request)
    {
        $request->validate($this->modelo->rules());
        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/modelos', 'public');
        $modelo = $this->modelo->create([
            'marca_id' => $request->marca_id,
            'nome' => $request->nome,
            'imagem' => $imagem_urn,
            'numero_portas' => $request->numero_portas,
            'lugares' => $request->lugares,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs
        ]);

        return response()->json($modelo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelo = $this->modelo->with('marca')->find($id);
        if ($modelo === null) {
            return response()->json(['erro' => 'Modelo pesquisado não existe'], 404);
        }

        return response()->json($modelo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateModeloRequest  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModeloRequest $request, $id)
    {
        $modelo = $this->modelo->find($id);

        if ($modelo === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($modelo->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas);
        } else {
            $request->validate($modelo->rules());
        }
        // remove o arquivo antigo caso um novo arquivo tenha sido enviado no request

        if ($request->file('imagem') != null) {
            // Deleta a imagem atual
            Storage::disk('public')->delete($modelo->imagem);
            // salvando caminho da nova imagem ao objeto $modelo
            $imagem = $request->file('imagem');
            $imagem_urn = $imagem->store('imagens/modelos', 'public');
            // atribuindo novo caminho da nova imagem ao objeto $modelo
            $modelo->imagem = $imagem_urn;
        } else {
            $imagem_urn = $modelo->imagem;
        }
        $modelo->fill($request->all());
        $modelo->imagem = $imagem_urn;

        // salvando dados
        $modelo->save();

        return response()->json($modelo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelo = $this->modelo->find($id);
        if ($modelo === null) {
            return response()->json(['msg' => 'Erro ao deletar, modelo não existe em nosso banco'], 404);
        }

        // remove imagem antiga caso ele exista
        Storage::disk('public')->delete($modelo->imagem);

        $modelo->delete();
        return response()->json(['msg' => 'Marca removida com sucesso'], 200);
    }
}
