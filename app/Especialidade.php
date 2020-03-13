<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model{

    protected $fillable = ['descricao'];
    protected $hidden = ['created_at','updated_at'];
    protected $appends = ['links'];

    public function medico(){
        return $this->hasMany(Medico::class, 'especialidades_id');
    }

    public function getLinksAttribute(): array {
        return [
            'medicos' => '/api/especialidade/' . $this->id,
        ];
    }

}