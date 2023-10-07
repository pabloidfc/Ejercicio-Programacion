<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function Create(Request $request) {
        $tarea = new Tarea;

        $validaciones = Validator::make($request->all(), [
            "titulo"    => "required",
            "contenido" => "required",
            "estado"    => "required",
            "autor"     => "required",
        ]);


        if($validaciones->fails()) {
            return response([$validaciones->errors()], 400);
        }

        $tarea -> titulo    = $request -> titulo;
        $tarea -> contenido = $request -> contenido;
        $tarea -> estado    = $request -> estado;
        $tarea -> autor     = $request -> autor;
        $tarea -> save();

        return $tarea;
    }

    public function Read($tareaID) {
        $tarea = Tarea::find($tareaID);
        
        if ($tarea) return $tarea;
        return response(['msg' => 'No existe'], 404);
    }
    
    public function Update(Request $request, $tareaID) {
        $tarea = Tarea::find($tareaID);
        if (!$tarea) return response(['msg' => 'No existe'], 404);
        
        if ($request -> input('titulo'))    $tarea -> titulo    = $request -> titulo;
        if ($request -> input('contenido')) $tarea -> contenido = $request -> contenido;
        if ($request -> input('estado'))    $tarea -> estado    = $request -> estado;
        if ($request -> input('autor'))     $tarea -> autor     = $request -> autor;
        $tarea -> save();
        
        return $tarea;
    }
    
    public function Delete($tareaID) {
        $tarea = Tarea::find($tareaID);
        if (!$tarea) return response(['msg' => 'No existe'], 404);
        $tarea->delete();
        return response(['msg' => 'Eliminada correctamente!!'], 200);
    }

    public function List() {
        $tareas = Tarea::all();
        return $tareas;
    }

    public function ListForTitle($tareaTitle) {
        $tarea = Tarea::where($tareaTitle);
        if ($tarea) return $tarea;
        return response(['msg' => 'No existe'], 404);
    }

    public function ListForAuthor($tareaAuthor) {
        $tarea = Tarea::where($tareaTitle);
        if ($tarea) return $tarea;
        return response(['msg' => 'No existe'], 404);
    }

    public function ListForStatus($tareaStatus) {
        $tarea = Tarea::where($tareaTitle);
        if ($tarea) return $tarea;
        return response(['msg' => 'No existe'], 404);
    }
}
