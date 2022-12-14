<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proprietario extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_comercial',
        'codigo_licenca',
        'id_usuario',
    ];

    // Associacoes

    public function user(){
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function granja(){
        return $this->hasMany(Granja::class, 'id_granja');
    }
}
