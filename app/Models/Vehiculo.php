<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model {
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'combustible',
        'fecha_matriculacion',
        'modelo',
        'potencia_cv',
        'plazas',
        'puertas',
        'consumo_medio',
        'matricula',
        'id'
    ];
}
