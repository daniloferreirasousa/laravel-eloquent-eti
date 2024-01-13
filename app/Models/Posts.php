<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Posts extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /*
    *  Tipos de manipulações que podem ser implementadas
    */
    // protected $table = 'postagens'; # Serve p/ especificar o nome da tabela
    // protected $primaryKey = 'id_postagem'; # Serve p/ especificar qual é a chave primária da tabela
    // protected $keytype = 'string'; # serve p/ especificar o tipo de dado tem a coluna de chave primária
    // protected $incrementing = false; # serve p/ definir que a chave primária não será auto-increment
    // protected $timestamps = false; # serve p/ definir que não serão criadas as colunas de create e update
    // const CREATED_AT = 'data_criacao'; # serve p/ renomear a coluna CREATED_AT
    // const UPDATED_AT = 'data_atualizacao'; # serve p/ renomear a coluna UPDATED_AT
    // protected $dateFormat = 'd/m/Y'; # serve p/ definir o formato que será salvo para as datas
    // protected $connection = 'pgsql'; # serve p/ definir qual conexão com DB que a tabela irá utilizar
    // protected $attributes = [ 'active' => true ]; # serve p/ definir valores padrão para colunas
}
