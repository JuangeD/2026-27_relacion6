<?php

/**
 * Clase abstracta MuebleBase que almacenará los datos
 * de un mueble base
 */
abstract class MuebleBase
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

    /* ====== CONSTRUCTOR ====== */
    /**
     * Constructor de la clase MuebleBase
     * 
     */
    public function __construct(string $nombre,  string $fechaIniVenta, string $fabricante="FaMu:", string $pais="ESPAÑA", int $anio=2020, string $fechaFinVenta="31/12/2040", float $precio=30)
    {
        if(MuebleBase::MAXIMO_CLASE>MuebleBase::$_mueblesCreados)
        {
            $validoNombre = $this->setNombre($nombre);
            if(!$validoNombre)
                throw new Exception("Nombre: 40 caracteres máximo y no debe estar vacío");

            $validoFechaIniVenta = $this->setFechaIniVenta($fechaIniVenta);
            if(!$validoFechaIniVenta)
                $this->_fechaIniVenta="01/01/".$this->getAnio();

            $this->setFabricante($fabricante);
            $this->setPais($pais);
            $this->setAnio($anio);
            $this->setFechaFinVenta($fechaFinVenta);
            $this->setPrecio($precio);
        }
        else
            throw new Exception("Error: límite de creación de muebles alcanzado");
        
    }


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

        if(validaCadena($var, 40, "defecto"))
        {
            $this->_nombre = $var;
            $res = true;
        }

        return $res;
    }

    public function setFabricante(string $var): bool
    {
        $res = false;

        if(validaCadena($var, 30, $var))
        {
            $this->_fabricante = "FaMu:". mb_substr($var,0, (30 - mb_strlen("FaMu:")));
            $res = true;
        }
            

        return $res;
    }

    public function setPais(string $var): bool
    {
        $res = false;

        if(validaCadena($var, 20, "ESPAÑA"))
        {
            $this->_pais = mb_strtoupper($var);
            $res = true;
        }

        return $res;
    }

    public function setAnio(int $var): bool
    {
        $res = false;

        if(validaEntero($var, 2020, intval(new DateTime()->format("Y")), 2020))
        {
            $this->_anio = $var;
            $res = true;
        }
            

        return $res;
    }

    public function setFechaIniVenta(string $var): bool
    {
        $res = false;

        if(validaFecha($var, DateTime::createFromFormat("d/m/Y", "01/01/$this->_anio")->format("d/m/Y")) 
            && (DateTime::createFromFormat("d/m/Y", $var)>DateTime::createFromFormat("d/m/Y", "01/01/$this->_anio")))
        {
            $this->_fechaIniVenta = $var;
            $res = true;
        }

        return $res;
    }

    public function setFechaFinVenta(string $var): bool
    {
        $res = false;

        if(validaFecha($var, DateTime::createFromFormat("d/m/Y", "31/12/2040")->format("d/m/Y")) 
            && (DateTime::createFromFormat("d/m/Y", $var)>DateTime::createFromFormat("d/m/Y", $this->getFechaIniVenta())))
        {
            $this->_fechaFinVenta = $var;
            $res = true;
        }

        return $res;
    }

    public function setPrecio(float $var): bool
    {
        $res = false;

        if($var>=30)
        {
            $this->_precio = $var;
            $res = true;
        }

        return $res;
    }

    /* ====== MÉTODOS MÁGICOS ====== */
    public function __set(string $name, mixed $value): void
    {
        throw new Exception("No se permite crear la propiedad dinámica $name con valor $value");
    }

    public function __get(string $name): void
    {
        throw new Exception("No se permite acceder a la propiedad dinámica $name");
    }

    /* ====== MÉTODOS ABSTRACTOS ====== */
    /**
     * Método abstracto redefinido en clases hijas que devuelve
     * un array con el nombre de las propiedades adicionales a la
     * clase base
     *
     * @return array devuelve un array de cadenas
     */
    abstract public function damePropiedadesAdicionales(): array;

    /* ====== MÉTODOS DE CLASE ====== */

    public static function puedeCrear(int &$restantes): bool
    {
        $restantes = MuebleBase::MAXIMO_CLASE - MuebleBase::$_mueblesCreados;
        $puedeCrear = true;

        if($restantes==0)
            $puedeCrear = false;

        return $puedeCrear;
    }

    public function __toString(): string
    {
        return "MUEBLE de clase ". get_class($this) ." con nombre ". $this->getNombre() .", fabricante ". $this->getFabricante() 
                .", fabricado en ". $this->getPais() ." a partir del año ". $this->getAnio() .", vendido desde ". $this->getFechaIniVenta() 
                ." hasta ". $this->getFechaFinVenta() .", precio ". $this->getPrecio() .".";
    }
}