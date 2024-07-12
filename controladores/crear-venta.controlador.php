<?php 
include_once '../modelos/crear-venta.modelo.php';
header('Content-Type: text/html; charset=utf-8');

$action =  filter_input(INPUT_POST, 'ACTION', FILTER_DEFAULT);
    if(isset($action)){
        $data = isset($_POST["DATA"]) ? $_POST["DATA"]: null;
        $objectData = json_decode($data);
        $ventas = new CrearVenta($objectData);
        $files = isset($_FILES) ? $_FILES: null;
        
        switch($action){
            case "CREATE_VENTA":      $ventas->insertarVenta($files); break;
            case "RANGO_FECHA_VENTA": $ventas->rangoFechasVentas(); break;
            case "ELIMINAR_VENTA":    $ventas->eliminarVenta(); break;
            case "ANULAR_VENTA":      $ventas->anularVenta(); break;
        }
    }