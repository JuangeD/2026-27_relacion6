<?php

/**
 * Clase en la que se indicarán características adicionales
 */
class Caracteristicas
{
    private array $_propiedades = array();

    /* ====== MÉTODOS MÁGICOS ====== */
    public function __get(string $nombre)
    {
        if(isset($this->_propiedades[$nombre]))
            return $this->_propiedades[$nombre];
        else
            throw new Exception("No existe la propiedad $nombre");
    }

    public function __set(string $nombre, mixed $valor)
    {
        if(isset($this->_propiedades["ULTIMA"]))
          throw new Exception("No se pueden añadir más propiedades");

        $this->_propiedades[$nombre] = $valor;
    }
}