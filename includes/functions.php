<?php

date_default_timezone_set('America/Lima');
function fechaC(){

    $mes = array("", "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Setiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre");
    return date('d')." de ". $mes[date('n')]. " de " .date('Y');
}


?>