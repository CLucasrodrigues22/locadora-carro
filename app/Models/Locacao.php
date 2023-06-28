<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    use HasFactory;
    protected $table = 'locacoes';
    protected $fillable = [
        'cliente_id',
        'carro_id',
        'status_id',
        'data_inicio_periodo',
        'data_final_previsto_periodo',
        'data_final_realizado_periodo',
        'total_dias_locacao',
        'valor_diaria',
        'km_inicial',
        'km_final',
        'km_percorrido'
    ];

    public function rules()
    {
        return [
            'cliente_id' => 'required',
            'carro_id' => 'required',
            'data_inicio_periodo' => 'required',
            'data_final_previsto_periodo' => 'required',
            'valor_diaria' => 'required',
            'km_inicial' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório'
        ];
    }

    public function cliente()
    {
        //UM cliente PERTENCE a UMA locacao
        return $this->belongsTo('App\Models\Cliente');
    }

    public function carro()
    {
        //UM carro PERTENCE a UMA locacao
        return $this->belongsTo('App\Models\Carro');
    }

    public function status()
    {
        //UM status PERTENCE a UMA locacao
        return $this->belongsTo('App\Models\Status');
    }
}
