<?php

/**
 * Clase que hereda de MuebleBase y crea un mueble de tipo
 * reciclado. No se pueden crear subclases de esta.
 */
final class MuebleReciclado extends MuebleBase
{
    private int $_porcentajeReciclado=10;

    /* ====== CONSTRUCTOR ====== */
    public function __construct(string $nombre, string $fechaIniVenta, string $fabricante = "FaMu:", string $pais = "ESPAÑA", int $anio = 2020, string $fechaFinVenta = "31/12/2040", float $precio = 30, int $porcentajeReciclado=10)
    {
        parent::__construct($nombre, $fechaIniVenta, $fabricante, $pais, $anio, $fechaFinVenta, $precio);
    
        if(!$this->setPorcentajeReciclado($porcentajeReciclado))
            $this->_porcentajeReciclado = 10;
    }

    /* ====== GETTERS ====== */
    public function getPorcentajeReciclado(): int 
    {
        return $this->_porcentajeReciclado;    
    }

    /* ====== SETTERS ====== */
    public function setPorcentajeReciclado(int $var): bool 
    {
        $res = false;
        
        if(validaEntero($var, 0, 100, 10))
        {
            $this->_porcentajeReciclado = $var;
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
        return parent::__toString(). " Tiene un porcentaje de reciclado de ". $this->getPorcentajeReciclado() ."%.";
    }

}