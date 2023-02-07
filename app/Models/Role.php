<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    use HasFactory;
    // Para poder hacer en el DB Seeder Role Create:
    protected $fillable = [
        'name',
    ];
    /**
    * Los usuarios que tienen asignados un Determinado Rol.
    */
    public function users() {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
