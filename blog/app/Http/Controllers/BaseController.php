<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{
    protected string $classe;

    public function index(Request $request)
    {
        $offset = ($request->page - 1) * $request->per_page;
        return $this->classe::paginate($request->per_page);
    }

    public function store(Request $request)
    {
        return response()
            ->json($this->classe::create($request->all()),
                201);
    }

    public function show(int $id)
    {
        $recurso = $this->classe::find($id);
        if(is_null($recurso)){
            return response()->json('',204);
        }
        return response()
        ->json($this->classe::find($id),201);
    }

    public function update(Request $request, int $id)
    {
        $recurso = $this->classe::find($id);
        if(is_null($recurso)){
            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }
        $recurso->fill($request->all());
        $recurso->save();
    }

    public function delete($id)
    {
        $qtdAlgo = $this->classe::destroy($id);
        if($qtdAlgo > 0){
            return response()->json('', 201);
        }
        elseif ($qtdAlgo === 0){
            return response()->json(['erro' => 'recurso não encontrado!'],404);
        }
        return response()->json(['erro' => 'algo deu errado']);
    }
}

