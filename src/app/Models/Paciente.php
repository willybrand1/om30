<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Endereco;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'paciente';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'foto',
        'nome',
        'mae',
        'nascimento',
        'cpf',
        'cns'
    ];

    public function endereco(){
        return $this->hasOne(Endereco::class);
    }
}

