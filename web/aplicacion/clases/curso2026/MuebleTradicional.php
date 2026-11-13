<?php

/**
 * Clase que hereda de MuebleBase y crea un mueble de tipo
 * reciclado. No se pueden crear subclases de esta.
 */
final class MuebleTradicional extends MuebleBase
{
    private float $_peso=15;
    private string $_serie="S01";

    /* ====== CONSTRUCTOR ====== */
    public function __construct(string $nombre, string $fechaIniVenta, string $fabricante = "FaMu:", string $pais = "ESPAÑA", int $anio = 2020, string $fechaFinVenta = "31/12/2040", float $precio = 30, float $peso=15, string $serie="S01")
    {
        parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);
        
        if(!$this->setPeso($peso))
            $this->_peso = 15;
        
        if(!$this->setSerie($serie))
            $this->_serie = "S01";
    }

    /* ====== GETTERS ====== */
    public function getPeso(): float 
    {
        return $this->_peso;    
    }

    public function getSerie(): string 
    {
        return $this->_serie;    
    }

    /* ====== SETTERS ====== */
    public function setPeso(float $var): bool 
    {
        $res = false;
        
        if(validaEntero($var, 15, 300, 15))
        {
            $this->_peso = $var;
            $res = true;
        }

        return $res;
    }

    public function setSerie(string $var): bool 
    {
        $res = false;
        
        if(validaExpresion($var, "/^S\d{2}$/i", "S01"))
        {
            $this->_serie = mb_strtoupper($var);
            $res = true;
        }

        return $res;
    }

    /* ====== IMPLEMENTACIÓN MÉTODOS ABSTRACTOS ====== */
    #[Override]
    public function damePropiedadesAdicionales(): array
    {
        return get_class_vars(get_class($this));
    }

    /* ====== TOSTRING ====== */
    #[Override]
    public function __toString(): string
    {
        return parent::__toString(). " Pertenece a la serie ". $this->getSerie() ." y pesa ". $this->getPeso() ."kg";
    }

}