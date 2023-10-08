<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function create(Request $req) {
        $task = new Tarea;

        $validaciones = Validator::make($req->all(), [
            'titulo'    => 'required|min:3',
            'contenido' => 'required|min:10',
            'estado'    => 'nullable',
            'autor'     => 'required|min:3',
        ]);


        if($validaciones->fails()) {
            return response([$validaciones->errors()], 400);
        }

        $task -> titulo    = $req -> input('titulo');
        $task -> contenido = $req -> input('contenido');
        $task -> estado    = $req -> input('estado');
        $task -> autor     = $req -> input('autor');
        $task -> save();

        return $task;
    }

    public function read($taskID) {
        $task = Tarea::find($taskID);
        if (!$task) response(['msg' => 'No se han encontrado tareas!'], 404);
        return $task;
    }
    
    public function update(Request $req, $taskID) {
        $task = Tarea::find($taskID);
        if (!$task) return response(['msg' => 'No se han encontrado tareas!'], 404);

        $validaciones = Validator::make($req->all(), [
            'titulo'    => 'nullable|min:3',
            'contenido' => 'nullable|min:10',
            'estado'    => 'nullable',
            'autor'     => 'nullable|min:3',
        ]);

        if($validaciones->fails()) {
            return response([$validaciones->errors()], 400);
        }

        if ($req -> input('titulo'))    $task -> titulo    = $req -> input('titulo');
        if ($req -> input('contenido')) $task -> contenido = $req -> input('contenido');
        if ($req -> input('estado'))    $task -> estado    = $req -> input('estado');
        if ($req -> input('autor'))     $task -> autor     = $req -> input('autor');
        $task -> save();
        
        return $task;
    }
    
    public function delete($taskID) {
        $task = Tarea::find($taskID);
        if (!$task) return response(['msg' => 'No se han encontrado tareas!'], 404);
        $task->delete();
        return response(['msg' => 'Eliminada correctamente!!'], 200);
    }

    public function list() {
        return Tarea::all();
    }

    public function listForTitle(Request $req) {
        if ($req->input('titulo')) {
            $task = Tarea::where('titulo', $req->input('titulo'))->get();
        } else {
            return response(['msg' => 'Debes enviar un titulo'], 400);
        }
        return $task;
    }

    public function listForAuthor(Request $req) {
        if ($req->input('autor')) {
            $task = Tarea::where('autor', $req->input('autor'))->get();
        } else {
            return response(['msg' => 'Debes enviar un autor'], 400);
        }
        return $task;
    }

    public function listForStatus(Request $req) {
        if ($req->input('estado')) {
            $task = Tarea::where('estado', $req->input('estado'))->get();
        } else {
            return response(['msg' => 'Debes enviar un estado'], 400);
        }
        return $task;
    }
}
