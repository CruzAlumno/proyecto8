<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blablacar extends Model {
    use HasFactory;
    /**
    * Devuelve el customer asociado a un order. (Relacion Inversa 1:N)
    */
    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
