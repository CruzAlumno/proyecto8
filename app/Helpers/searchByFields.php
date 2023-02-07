<?php
    // Metodo Helper Para Busqueda por Campo Centralizado:
    function searchByField($fields_array, $Modelo) {
        // Busqueda por Filtro 'q' (Fronentd)
        $busqueda = request()->input('filter');
        // Abre Consulta Vacia:
        $registros = $Modelo::query();
        if($busqueda && array_key_exists('q', $busqueda)) {
            foreach($fields_array as $value) {
                $registros = $registros->orwhere($value, 'like', '%' . $busqueda['q'] . '%');
            }
        }
        return $registros;
    }
