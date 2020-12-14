<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        $personas = People::get();
        return response()->json([
            'success' => true,
            'message' => 'todas las personas de la bd',
            'personas' => $personas
        ],200);
    }

    public function user_store(Request $request)
    {
        $data = $request->only('nombre', 'apellido', 'telefono', 'email', 'direccion');
        $validator = Validator::make($data,[
            'nombre' => 'required|min:5',
            'apellido' => 'required|min:5',
            'telefono' => 'required|min:5|max:15',
            'email' => 'required|email',
            'direccion' => 'required|min:5',
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'no se pudo guardar el usuarios, hubo un error de validaciones',
                'errors' => $validator->errors()
            ],422);
        }
        $persona = new People();
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->direccion = $request->direccion;
        $persona->save();
        $personas = People::get();
        return response()->json([
            'success' => true,
            'message' => 'se guardo correctamente la persona',
            'personas' => $personas
        ],200);
    }

    public function user_update(Request $request)
    {
        $persona = People::find($request->id);
       
        $data = $request->only('nombre', 'apellido', 'telefono', 'email', 'direccion');
        $validator = Validator::make($data,[
            'nombre' => 'required|min:5',
            'apellido' => 'required|min:5',
            'telefono' => 'required|min:5|max:15',
            'email' => 'required|email',
            'direccion' => 'required|min:5',
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'no se pudo actualizar el usuarios, hubo un error de validaciones',
                'errors' => $validator->errors()
            ],422);
        }
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->direccion = $request->direccion;
        $persona->save();
        $personas = People::get();
        return response()->json([
            'success' => true,
            'message' => 'se actualizó correctamente la persona',
            'personas' => $personas
        ],200);
    }

    public function user_delete(People $persona)
    {
        $persona->delete();
        $personas = People::get();
        return response()->json([
            'success' => true,
            'message' => 'se eliminó la persona con exito',
            'personas' => $personas
        ]);
    }
}
