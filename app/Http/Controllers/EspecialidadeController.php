<?php

namespace App\Http\Controllers;

use App\Especialidade;
use Illuminate\Http\Request;

class EspecialidadeController {

    public function read(Request $request){
        return Especialidade::all();
    }

    public function create(Request $request){
        return response()->json(Especialidade::create($request->all()), 201);
    }

    public function readId(int $id){
        $espec = Especialidade::find($id);
        if(is_null($espec)){
            return response()->json('', 204);
        }     
        //busca todos os médicos da especialidade por ID
        $recurso = $espec->medico;
        return response()->json($recurso); 
    }

    public function update(int $id, Request $request){
        $espec = Especialidade::find($id);

        if(is_null($espec)){
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }
        $espec->fill($request->all());
        $espec->save();

        return response()->json($espec); 

    }

    public function delete(int $id){
        $qtdRecursoRemovidos = Especialidade::destroy($id);
        if($qtdRecursoRemovidos === 0){
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }
        return response()->json('', '200'); 
    }

}

?>