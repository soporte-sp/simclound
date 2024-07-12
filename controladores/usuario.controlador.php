<?php 
include_once '../modelos/usuario.modelo.php';
header('Content-Type: text/html; charset=utf-8');

$action =  filter_input(INPUT_POST, 'ACTION', FILTER_DEFAULT);

    if(isset($action)){
        $data = isset($_POST["DATA"]) ? $_POST["DATA"]: null;
        $objectData = json_decode($data);
        $usuario = new Usuario($objectData);
        
        switch($action){
            case "GET_TABLE_USERS":      $usuario->showTableUser(); break;
            case "SET_STATUS_CHANGE":    $usuario->setStatusChanges(); break;
            case "GET_PERFIL":           $usuario->getPerfil(); break;
            case "GET_ID_AGENCIA":       $usuario->getIdAgencia(); break;
            case "INSERT_USER":          $usuario->insertarUser(); break;
            case "SHOW_EDITAR_USER":     $usuario->showEditarUser(); break;
            case "EDITAR_USER":          $usuario->editarUser(); break;
            case "ELIMINAR_USER":        $usuario->eliminarUser(); break;
        default:
            break;
        }
    }

?>