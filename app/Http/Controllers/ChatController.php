<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function ver_mensaje(Request $request){

        try {

            $mensaje = Mensaje::whereHas('chats', function($query) use($request){
                $query->whereHas('users', function ($_query) use ($request){
                    $_query->whereIn('users_id', [$request['contactos_id'], auth()->user()->id]);
                });
            })
            ->whereIn('users_id', [auth()->user()->id, $request['contactos_id']])
            ->get();

            return $mensaje;
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage()
            ]);
        }

    }

    public function enviarMensaje(Request $request)
    {
        try {

            $chat = Chat::create([
                'estado' => true
            ]);

            /* sincronizando contactos */
            $chats = $chat->users()->attach([auth()->user()->id,$request['contactos_id']]);
            // return $chat;
            /* enviando mensaje */
            $mensaje = $chat->mensajes()->create([
                'mensaje' => $request['mensaje'],
                'users_id' => auth()->user()->id,
                'estado' => true
            ]);

            return $mensaje;

        } catch (QueryException $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage()
            ]);
        }
    }
}
