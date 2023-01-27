<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = ['marca_id', 'nome', 'imagem', 'nomero_porta', 'lugares', 'air_bag', 'abs'];

    public function rules()
    {
        return [
            'marca_id' => 'exists:marcas,id',
            'nome' => 'required|unique:modelos,nome,'.$this->id,
            'imagem' => 'required|file|mimes:png,jpg,jpeg',
            'numero_portas' => 'required|integer',
            'lugares' => 'required|integer',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean' // True, False, 1, 0, '1', '0'
        ];
    }
}
