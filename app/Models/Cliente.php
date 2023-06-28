<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function rules()
    {
        return [
            'nome' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório'
        ];
    }

    public function locacoes()
    {
        //UM cliente POSSUI MUITAS locações
        return $this->hasMany('App\Models\Locacao');
    }
}
