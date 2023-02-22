<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        return response()->json(Contacto::with('contacto_user')
        ->where('users_id', auth()->user()->id)
        ->get());
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user()->id;

            $contacto = Contacto::create([
                'users_id' => $user,
                'contactos_id' => $request['contactos_id']
            ]);

            if (!$contacto){
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'No fue creado'
                ]);
            }

            return response()->json([
                'status' => 'OK',
                'message' => 'contacto agregado correctamente'
            ]);

        } catch (QueryException $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
