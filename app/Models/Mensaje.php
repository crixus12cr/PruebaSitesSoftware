<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensaje extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'mensajes';

    protected $fillable = [
        'mensaje',
        'estado',
        'chat_id',
        'users_id'
    ];

    public function chats(){
        return $this->belongsTo(Chat::class,'chat_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
