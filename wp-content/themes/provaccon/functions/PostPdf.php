<?php

/**
 * Created by PhpStorm.
 * User: juan2ramos
 * Date: 13/04/17
 * Time: 11:59 PM
 */
class FilterArray
{

    Static function filtrar_array(&$array, $clave_orden)
    {
        $array_filtrado = array(); // inicializamos un nuevo array
        // creamos un bucle foreach para recorrer el array original y “acomodar” los datos
        foreach ($array as $index => $array_value) {
            // guardamos temporalmente el nombre de la categoría
            $value = $array_value->$clave_orden;
            // eliminamos la categoria del registro, ya no la necesitaremos
            unset($array_value->$clave_orden);
            // creamos una clave en nuestro nuevo array, con el nombre de la categoria
            // y como valor le sumamos el array conteniendo producto y precio
            $array_filtrado[$value][] = $array_value;
            /* en cada iteración, si el nombre de la categoría ya figura como clave, será
               sobreescrito y se le agregará como nuevo valor, solo los datos de producto
               y precio. Si la categoria no existe, ahí sí, creará la nueva clave */
        }
        $array = $array_filtrado; // modificamos automáticamente nuestro array global $row
    }
}