<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contactos';

    protected $fillable = [
        'users_id',
        'contactos_id'
    ];

    /* usuario principal */
    public function user_contacto()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    /* usuario contacto */
    public function contacto_user()
    {
        return $this->belongsTo(User::class, 'contactos_id', 'id');
    }
}
