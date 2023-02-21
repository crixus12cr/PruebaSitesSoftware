<?php

namespace App\Http\Controllers;

use App\Models\Chat;
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

    public function enviarMensaje(Request $request)
    {
        try {

            // return auth()->user();
            // $user = User::find(1);



            // $user->chats()->attach(1);

            // return $user;

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

            return 'bien';

        } catch (QueryException $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage()
            ]);
        }
    }
}
