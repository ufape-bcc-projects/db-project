<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesquisadorGranja extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pesquisador',
        'id_granja',
    ];

    // Associacoes

    public function pesquisador(){
        return $this->belongsTo(Pesquisador::class);
    }

    public function granja(){
        return $this->belongsTo(Granja::class);
    }
}
