<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class EcomapResource extends JsonResource {
    const KEYS = array(
        'id' => 'id',
        'title' => 'title',
        'resultType' => 'resultType',
        'localityType' => 'localityType',
        'address' => 'address'

    );
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        //return parent::toArray($request);
        $attributes = parent::toArray($request);
        $id = $attributes['id'];
        // Acceder A Objeto +  FIX SEARCH (No Siempre se devuelve el mismo address)
        $attributesAddressObject = self::getAttributes($attributes);
        if(array_key_exists('postalCode', $attributesAddressObject['address'])) {
            $attributesAddressObject['postalCode'] = $attributesAddressObject['address']['postalCode'];
        }
        if(array_key_exists('stateCode', $attributesAddressObject['address'])) {
            $attributesAddressObject['stateCode'] = $attributesAddressObject['address']['stateCode'];
        }
        return [
            'id' => $id,
            'attributes' => $attributesAddressObject
        ];
    }
    public static function getAttributes($data) {
        $attributes = array();
        foreach(self::KEYS as $key => $field) {
            // ADAPTADO PARA ACCEDER A Propiedad Objeto   self::getFirstElementRecursive($data[$field]);
            if(array_key_exists($field, $data)) $attributes[$key] = $data[$field];
            else $attributes[$key] = 'Unknown';
        }
        return $attributes;
    }
    public static function getFirstElementRecursive($dataArray) {
        return is_array($dataArray) ? self::getFirstElementRecursive($dataArray[0]) : $dataArray;
    }
}
