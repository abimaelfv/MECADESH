<?php
// retorna URL del proyecto
function base_url(){
    return BASE_URL;
}

function Assets(){
    return BASE_URL."/Assets";
}

// muestra informacion formateada
function dep($data){
    $format = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}

// Limpiar una cadena

// Formato para valores monetarios
function formatMoney($cantidad){
    $cantidad = number_format($cantidad,2,SPD,SMP);
    return $cantidad;
}

//
function getModal(string $nameModal, $data){
    $view_modal = "Views/Template/Modals/{$nameModal}.php";
    require_once $view_modal;
}

?>