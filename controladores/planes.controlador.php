<?php 
include_once '../modelos/planes.modelo.php';
header('Content-Type: text/html; charset=utf-8');

$action =  filter_input(INPUT_POST, 'ACTION', FILTER_DEFAULT);

    if(isset($action)){
        $data = isset($_POST["DATA"]) ? $_POST["DATA"]: null;
        $objectData = json_decode($data);
        $planes = new planes($objectData);
        
        switch($action){
            case "GET_DESTINATION":           $planes->getDestination(); break;
            case "INSERT":                    $planes->insertDestination(); break;
            case "GET_TABLE_PLANS":           $planes->getTablePlans(); break;
            case "GET_PLAN":                  $planes->getPlan(); break;
            case "EDIT":                      $planes->editDestination(); break;
            case "DELETE":                    $planes->deleteDestination(); break;
            case "ACTIVATE_PLANS":            $planes->activateDestination(); break;
            case "GET_DESTINO_SIM":           $planes->getDestinoSimSelect(); break;
            case "GET_DESTINO_PLAN":          $planes->getDestinoPlanSelect(); break;
            case "GET_DESCRIPTION_AND_PRICE": $planes->getDescriptionAndPrice(); break;
        default:
            break;
        }
    }

?>