<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'chats';

    protected $fillable = [
        'estado',
    ];


    /* relacion de muchos a muchos con users */
    public function users(){
        return $this->belongsToMany(User::class, 'chat_user','chats_id','users_id');
    }
}
