<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nome',
        'nome_meio',
        'sobrenome',
        'data_nascimento',
        'local_nascimento',
        'email',
        'contato',
        'imagem_perfil',
        'qualificacao'
    ];
}
