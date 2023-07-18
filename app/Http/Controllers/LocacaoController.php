<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocacaoRequest;
use App\Http\Requests\UpdateLocacaoRequest;
use App\Models\Locacao;
use App\Models\Carro;
use Illuminate\Http\Request;
use App\Repositories\LocacaoRepository;
use Ramsey\Uuid\Type\Integer;

class LocacaoController extends Controller
{

    protected $locacao;

    public function __construct(Locacao $locacao)
    {
        $this->locacao = $locacao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locacaoRepository = new LocacaoRepository($this->locacao);

        $locacaoRepository->selectAtributosRegistrosRelacionados('cliente', 'carro', 'status');

        if ($request->has('filtro')) {
            $locacaoRepository->filtro($request->filtro);
        }

        if ($request->has('atributos')) {
            $locacaoRepository->selectAtributos($request->atributos);
        }

        // condição caso exista o atributo 'atributos' na url
        if ($request->has('all')) {
            return response()->json($locacaoRepository->getResultado(), 200);
        } else {
            return response()->json($locacaoRepository->getResultadoPaginado(5), 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocacaoRequest $request)
    {
        $request->validate($this->locacao->rules());

        $locacao = $this->locacao->create([
            'cliente_id' => $request->cliente_id,
            'carro_id' => $request->carro_id,
            'status_id' => 1,
            'data_inicio_periodo' => $request->data_inicio_periodo,
            'data_final_previsto_periodo' => $request->data_final_previsto_periodo,
            'valor_diaria' => $request->valor_diaria,
            'km_inicial' => $request->km_inicial
        ]);

        // atualizando status de disponibilidade de carro
        $idCarro = $request->carro_id;
        $carro = Carro::find($idCarro);
        $carro->update(['disponivel' => 0]);

        return response()->json($locacao, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locacao = $this->locacao->find($id);
        if ($locacao === null) {
            return response()->json(['erro' => 'Locação pesquisada não existe'], 404);
        }

        return response()->json($locacao, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocacaoRequest  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocacaoRequest $request, $id)
    {
        try {
            $locacao = $this->locacao->find($id);

            if ($locacao === null) {
                return response()->json(['erro' => 'Impossível realizar a atualização. A locação solicitado não existe'], 404);
            }

            if ($request->method() === 'PATCH') {

                $regrasDinamicas = array();

                //percorrendo todas as regras definidas no Model
                foreach ($locacao->rules() as $input => $regra) {

                    //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                    if (array_key_exists($input, $request->all())) {
                        $regrasDinamicas[$input] = $regra;
                    }
                }

                $request->validate($regrasDinamicas);
            } else {
                $request->validate($locacao->rules());
            }

            $locacao->fill($request->all());
            $locacao->save();
            return response()->json($locacao, 200);
        } catch (\PDOException $e) {
            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locacao = $this->locacao->find($id);

        if ($locacao === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. A locação solicitado não existe'], 404);
        }

        $locacao->delete();
        return response()->json(['msg' => 'A locação foi removida com sucesso!'], 200);
    }
}
