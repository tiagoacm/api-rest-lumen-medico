<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model{

    protected $fillable = ['nome', 'crm', 'especialidades_id'];
    protected $hidden = ['created_at','updated_at'];
    protected $appends = ['links'];

    public function especialidade(){
        return $this->belongsTo(Especialidade::class, 'especialidades_id', 'id');
    }

    public function getLinksAttribute(): array {
        return [
            'self' => '/api/medico/' . $this->id,
        ];
    }

}