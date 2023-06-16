<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    use HasFactory;
    protected $table = 'statusLocacao';
    protected $fillable = [
        'status'
    ];

    public function locacao()
    {
        //UM status POSSUI MUITAS locacões
        return $this->hasMany('App\Models\Locacao');
    }
}
