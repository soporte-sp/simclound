<?php

error_reporting(0);

if ($_SESSION["perfil"] == "Administrador") {

    $itemsuma = null;
    $valorsuma = null;
    $sumarVentas = ControladorVentas::ctrSumaTotalVentas($itemsuma, $valorsuma,$_SESSION["perfil"]);
    $item = null;
    $perfil = null;
    $item1 = null;
    $valor3 = null;
    $respuesta = ControladorVentas::ctrMostrarVentas($item, $perfil, $item1, $valor3,$_SESSION["perfil"]);
    $arrayFechas = array();
    $arrayVentas = array();
    $sumaPagosMes = array();
    foreach ($respuesta as $key => $value) {
        if ($value["fechaventa"]) {
            $fecha = substr($value["fechaventa"], 0, 7);
            array_push($arrayFechas, $fecha);
            if ($value["valor"])
                $arrayVentas = array($fecha => $value["valor"]);
            foreach ($arrayVentas as $key => $value) {
                $sumaPagosMes[$key] += $value;
            }
        }
    }
    $noRepetirFechas = array_unique($arrayFechas);
} else if ($_SESSION["perfil"] == "Agencias") {
    $itemsuma = "agregopadre";
    $valorsuma = $_SESSION["usuario"];
    $sumarVentas = ControladorVentas::ctrSumaTotalVentas($itemsuma, $valorsuma,$_SESSION["perfil"]);
    //var_dump($sumarVentas);

    $item = null;
    $perfil = null;
    $item1 = "agregopadre";
    $valor3 = $_SESSION["usuario"];
    $respuesta = ControladorVentas::ctrMostrarVentas($item, $perfil, $item1, $valor3,$_SESSION["perfil"]);
    $arrayFechas = array();
    $arrayVentas = array();
    $sumaPagosMes = array();
    foreach ($respuesta as $key => $value) {

        if ($value["fechaventa"]) {
            $fecha = substr($value["fechaventa"], 0, 7);
            array_push($arrayFechas, $fecha);
            if ($value["valor"])
                $arrayVentas = array($fecha => $value["valor"]);
            foreach ($arrayVentas as $key => $value) {
                $sumaPagosMes[$key] += $value;
            }
        }
    }
    $noRepetirFechas = array_unique($arrayFechas);
} else if ($_SESSION["perfil"] == "Comercial") {

    $itemsuma = "vendedor";
    $valorsuma = $_SESSION["id"];
    $sumarVentas = ControladorVentas::ctrSumaTotalVentas($itemsuma, $valorsuma,$_SESSION["perfil"]);

    $item = null;
    $perfil = null;
    $item1 = "vendedor";
    $valor3 = $_SESSION["id"];
    $respuesta = ControladorVentas::ctrMostrarVentas($item, $perfil, $item1, $valor3,$_SESSION["perfil"]);
    $arrayFechas = array();
    $arrayVentas = array();
    $sumaPagosMes = array();
    foreach ($respuesta as $key => $value) {

        if ($value["fechaventa"]) {
            $fecha = substr($value["fechaventa"], 0, 7);
            array_push($arrayFechas, $fecha);
            if ($value["valor"])
                $arrayVentas = array($fecha => $value["valor"]);
            foreach ($arrayVentas as $key => $value) {
                $sumaPagosMes[$key] += $value;
            }
        }
    }

    $noRepetirFechas = array_unique($arrayFechas);
} else if ($_SESSION["perfil"] == "Coordinador") {
    $itemsuma = "coordinador";
    $valorsuma = $_SESSION["id"];
    $sumarVentas = ControladorVentas::ctrSumaTotalVentas($itemsuma, $valorsuma,$_SESSION["perfil"]);

    $item = null;
    $perfil = null;
    $item1 = "coordinador";
    $valor3 = $_SESSION["id"];
    $respuesta = ControladorVentas::ctrMostrarVentas($item, $perfil, $item1, $valor3,$_SESSION["perfil"]);
    $arrayFechas = array();
    $arrayVentas = array();
    $sumaPagosMes = array();
    foreach ($respuesta as $key => $value) {
        if ($value["fechaventa"]) {
            $fecha = substr($value["fechaventa"], 0, 7);
            array_push($arrayFechas, $fecha);
            if ($value["valor"])
                $arrayVentas = array($fecha => $value["valor"]);
            foreach ($arrayVentas as $key => $value) {
                $sumaPagosMes[$key] += $value;
            }
        }
    }
    $noRepetirFechas = array_unique($arrayFechas);
}

?>

<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Simcards para activar hoy</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">

                    <table class="table table-hover no-margins">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if ($_SESSION["perfil"] == "Administrador") {

                                $valor = null;
                                $item = null;
                                $item1 = null;
                                $valor1 = null;

                                $ventasTabla = ControladorVentas::ctrMostrarVentasHoy($item, $valor, $item1, $valor1,$_SESSION["perfil"]);
                            } else if ($_SESSION["perfil"] == "Agencias") {
                                $valor = $_SESSION["idcoordinadordeadmin"];
                                $item = null;
                                $item1 = "agregopadre";
                                $valor1 = $_SESSION["usuario"];

                                $ventasTabla = ControladorVentas::ctrMostrarVentasHoy($item, $valor, $item1, $valor1,$_SESSION["perfil"]);
                            } else if ($_SESSION["perfil"] == "Comercial") {

                                $valor = null;
                                $item = null;
                                $item1 = "vendedor";
                                $valor1 = $_SESSION["id"];
                                $ventasTabla = ControladorVentas::ctrMostrarVentasHoy($item, $valor, $item1, $valor1,$_SESSION["perfil"]);
                            } else if ($_SESSION["perfil"] == "Coordinador") {
                                $valor = null;
                                $item = null;
                                $item1 = "coordinador";
                                $valor1 = $_SESSION['id'];

                                $ventasTabla = ControladorVentas::ctrMostrarVentasHoy($item, $valor, $item1, $valor1,$_SESSION["perfil"]);
                                //var_dump($ventasTabla[0]['cliente']);
                               /*  $prueba = [];
                                $index =0;
                                foreach ($ventasTabla as $key => $value) {
                                    var_dump($value['coordinador']);
                                    var_dump($_SESSION['id']);
                                    if($value['coordinador'] == $_SESSION['id']){
                                        $prueba[$index] = $value;
                                        $index++;
                                    }
                                }
                                var_dump($prueba); */
                            }

                            $counter = 0;

                            foreach ($ventasTabla as $key => $value) {


                                if ($counter >= 5)
                                    break;

                                $counter++;
                                echo '<tr>';
                                echo '
                                 <td>' . $value["cliente"] . '</td> 
                                 <td>' . $value["fechallegada"] . '</td> 
                                 <td>' . $value["agrego"] . '</td>
                                 <td>';

                                if ($value["estado"] != "desactivado") {
                                    echo '<span class="label label-primary">Activado</span>';
                                } else {
                                    echo '<span class="label label-danger">Desactivado</span>';
                                }



                                echo '
                            </td>
                        </tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <?php

                if (!$ventasTabla) {
                    echo '<div class="alert alert-danger">
                                    No hay simcards para activar hoy
                            </div>';
                } else {
                    echo '<a href="cronograma"><button class="btn btn-primary btn-block m-t"> Ver todos</button></a>';
                }

                ?>
            </div>

        </div>
    </div>
</div>

<div class="row animated fadeInDown">
    <?php
    include "inicio/cajas.php";

    ?>
</div>

<div class="row animated fadeInDown">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div>
                    <h1 class="m-b-xs">$<?php echo number_format($sumarVentas["total"], 2); ?></h1>
                    <h3 class="font-bold no-margins">
                        Total de ventas hasta el momento
                    </h3>
                </div>
                <div>
                    <div id="morris-bar-chart-inicio"></div>
                </div>
                <div class="m-t-md">
                    <small class="pull-right">
                        <i class="fa fa-clock-o"> </i>
                        Fecha <?php echo date('d-M-Y'); ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    Morris.Bar({
        element: 'morris-bar-chart-inicio',
        data: [
            <?php
            foreach ($noRepetirFechas as $value) {
                echo "{y: '" . $value . "', a: '" . $sumaPagosMes[$value] . "'},";
            }
            ?>
        ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Ventas'],
        hideHover: 'auto',
        resize: true,
        preUnits: '$',
        barColors: ['#af174f'],
    });
</script>