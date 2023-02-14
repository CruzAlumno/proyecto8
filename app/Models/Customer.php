<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    use HasFactory;
    // Para Utilizar Posteriormente el metodo create():
    protected $fillable = [
        'id',
        'user_id',
        'first_name',
        'last_name',
        'city',
        'country',
        'telefono',
        'fecha_nacimiento',
        'dni'
    ];
    /**
    * Devuelve el usuario asociado a un customer.
    */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
    * Devuelve los order de un customer determinado.
    */
    public function blablacars() {
        return $this->hasMany(Blablacar::class, 'customer_id');
    }
    // Relacion con Vehiculos 1:N
    public function vehiculos() {
        return $this->hasMany(Vehiculo::class, 'customer_id');
    }
}
