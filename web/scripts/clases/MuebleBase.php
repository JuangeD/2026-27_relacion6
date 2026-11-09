<?php

/**
 * Clase abstracta MuebleBase que almacenará los datos
 * de un mueble
 */
class MuebleBase
{
    // Número máximo de Clase
    const int MAXIMO_CLASE = 10;

    // Propiedades
    private static int $_mueblesCreados;
    private string $_nombre;
    private string $_fabricante="FaMu:";
    private string $_pais="ESPAÑA";
    private int $_anio=2020;
    private string $_fechaIniVenta;
    private string $_fechaFinVenta="31/12/2040";
    private float $_precio=30;

    /* ====== GETTERS ====== */
    public function getNombre(): string
    {
        return $this->_nombre;
    }

    public function getFabricante(): string
    {
        return $this->_fabricante;
    }

    public function getPais(): string
    {
        return $this->_pais;
    }

    public function getAnio(): int
    {
        return $this->_anio;
    }

    public function getFechaIniVenta(): string
    {
        return $this->_fechaIniVenta;
    }

    public function getFechaFinVenta(): string
    {
        return $this->_fechaFinVenta;
    }

    public function getPrecio(): float
    {
        return $this->_precio;
    }

    /* ====== SETTERS ====== */
    public function setNombre(string $var): bool
    {
        $res = false;

        if(($res = validaCadena($var, 40, "defecto")))
            $this->_nombre = $var;

        return $res;
    }

    public function setFabricante(string $var): bool
    {
        $res = false;

        if(($res = validaCadena($var, 30, $var)))
        {
            $this->_fabricante = "FaMu:". mb_strcut($var,0, (mb_strlen($var)-mb_strlen("FaMu:")));
        }

        return $res;
    }

    /**
     * Constructor de la clase MuebleBase
     * 
     */
    public function __construct()
    {
        
    }


}