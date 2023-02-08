<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blablacar extends Model {
    use HasFactory;
    protected $fillable = [
        'id',
        'customer_id',
        'vehiculo_id',
        'titulo',
        'descripcion',
        'fecha_inicio_viaje',
        'hora_inicio_viaje',
        'inicio_ruta',
        'destino_ruta',
        'distancia',
        'precio',
        'precio_combustible',
        'plazas_disponibles',
        'estimacion_duracion',
        'status_active'
    ];
    /**
    * Devuelve el customer asociado a un order. (Relacion Inversa 1:N)
    */
    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
