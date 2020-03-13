<?php

namespace App\Http\Controllers;

use App\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicoController {

    public function read(Request $request){
    
        //- retorna todos os médicos sem descrição da especialidade
        //$recurso = Medico::all(); 
        //$recurso->load('especialidade');

        //retorna todos os médicos e descrição da especialidade
        $recurso = Medico::with('especialidade')->get();
        return response()->json($recurso); 
    }

    public function create(Request $request){
        return response()->json(Medico::create($request->all()), 201);
    }

    public function readId(int $id){
        $recurso = Medico::find($id);
        if(is_null($recurso)){
            return response()->json('', 204);
        }
        $recursos = $recurso->especialidade;
        return response()->json($recurso); 
    }

    public function update(int $id, Request $request){
        $recurso = Medico::find($id);

        if(is_null($recurso)){
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }
        $recurso->fill($request->all());
        $recurso->save();
        return response()->json($recurso); 
    }

    public function delete(int $id){
        $qtdRecursoRemovidos = Medico::destroy($id);
        if($qtdRecursoRemovidos === 0){
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }
        return response()->json('', '200'); 
    }
    
    public function buscaPorEspecialidade(int $especialidadeId){
        $Medicos = Medico::query()
            ->where('especialidades_id', $especialidadeId)
            ->orderBy('nome')
            ->paginate();           
        return $Medicos;
    }

}

?>