<?php

/**
 * Clase en la que se indicarán características adicionales
 */
class Caracteristicas implements Iterator
{
    private array $_propiedades = array();
    private int $_posicion = 0;

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
        if(isset($this->_propiedades["ULTIMA"]) && !isset($this->_propiedades[$nombre]))
          throw new Exception("No se pueden añadir más propiedades después de ULTIMA");

        $this->_propiedades[$nombre] = $valor;
    }

    public function __isset(string $nombre): bool
    {
        return isset($this->_propiedades[$nombre]);
    }

    public function __unset(string $nombre): void
    {
        unset($this->_propiedades[$nombre]);
    }

    /* ====== MÉTODOS ITERATOR ====== */
    #[Override]
    public function rewind(): void
    {
        $this->_posicion=array_key_last($this->_propiedades);
    }

    #[Override]
    public function current(): mixed
    {
        return $this->_propiedades[$this->_posicion];
    }

    #[Override]
    public function next(): void
    {
        prev($this->_propiedades);
        $this->_posicion--;
    }

    #[Override]
    public function key(): mixed
    {
        return key($this->_propiedades);
    }

    #[Override]
    public function valid(): bool
    {
        return $this->_posicion >= 0;
    }

    /* ====== TOSTRING ====== */
    public function __toString(): string
    {
        $cadena = "";

        foreach ($this->_propiedades as $clave => $valor) { 
            $cadena += "$clave:$valor;";
        }

        return $cadena;
    }

}