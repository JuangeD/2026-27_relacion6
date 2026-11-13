<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=>"inicio",
        "ENLACE"=>"/index.php"
    ],
    [
        "TEXTO"=>"pruebas"
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("pruebas");
cabecera();
finCabecera();
inicioCuerpo("PRUEBAS", $barra);
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{
    ?>
    <!--Esto va en el head-->
    <?php
}

//vista
function cuerpo()
{
?>
    <br><br>
<?php

    $muebleReciclado = new MuebleReciclado("Silla Eco", "15/03/2021", "EcoMuebles", "ESPAÑA", 2021, "31/12/2035", 75.50, 60);
    $muebleTracicional = new MuebleTradicional("Mesa Roble", "10/06/2022", "MaderaFina", "ESPAÑA", 2022, "31/12/2038", 120.00, 45, "S03");

    

}

