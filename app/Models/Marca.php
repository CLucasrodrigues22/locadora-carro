<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'imagem'];

    public function rules()
    {
        return [
            'nome' => 'required|unique:marcas,nome,'.$this->id,
            'imagem' => 'required|file|mimes:png,jpg,jpeg'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'Essa marca já existe em nossa base de dados',
            'imagem.mimes' => 'Só é permitido imagens no formato PGN, JPG E JPEG.'
        ];
    }
}
