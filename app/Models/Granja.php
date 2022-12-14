<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Granja extends Model
{
    use HasFactory;

    protected $fillable = [

        'id_proprietario',
        'nome',
        'cnpj'
    ];

    // Associacoes


    public function proprietario(){
        return $this->belongsTo(Proprietario::class, 'id_proprietario');
    }

    public function funcionario(){
        return $this->hasMany(Funcionario::class, 'id_funcionario');
    }

    public function setor(){
        return $this->hasMany(Setor::class, 'id_setor');
    }

    public function pesquisadores(){
        return $this->belongsToMany(Pesquisador::class, 'pesquisador_granjas', 'id_granja', 'id_pesquisador');
    }

    public function localizacao(){
        return $this->hasMany(Localizacao::class, 'id_granja');
    }

    public function tipoCriacao(){
        return $this->hasMany(TipoDeCriacao::class, 'id_granja');
    }


}
