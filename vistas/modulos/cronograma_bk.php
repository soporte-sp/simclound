<div class="row">

    <div class="col-lg-12 animated fadeInRight">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Filtro de fecha de llegada</h5>
                <div class="ibox-tools">
                    <?php

                    if ($_SESSION["perfil"] == "Administrador") {
                    ?>
                        <button class="btn btn-success btn-xs pull-right traerFecha" estadoDesactivado="desactivado" value="<?php echo date('Y-m-d'); ?>">Desactivar Simcards</button>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <div class="ibox-content">
                <button id="reportrangeLLegada" type="button" style="background: #fff; cursor: pointer; padding: 6px 10px; border: 2px solid #ccc; width:25%;border-radius: 5px;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </button>
                <a href="cronograma"><button type="button" class="btn btn-warning cancelarFechaCronograma"><i class="fa fa-window-close"></i>&nbsp;Cancelar Fechas</button></a>


            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12 animated fadeInRight">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Cronograma de activación</h5>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered table-striped dt-responsive tablaCronograma">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Código</th>
                            <th>Pasajero</th>
                            <?php 
                            if ($_SESSION["perfil"] == "Administrador") {
                                echo '<th>Cliente</th>';
                            }
                            ?>
                            <th>Destino</th>
                            <th>Tipo de plan</th>
                            <th>Linea del exterior</th>
                            <th>Fecha de llegada</th>
                            <th>Fecha de regreso</th>
                            <th>Agregado Por</th>
                            <!-- <th># de SimCard</th> -->
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php


                        if ($_SESSION["perfil"] == "Administrador") {


                            if (isset($_GET["fechaInicial"])) {

                                $fechaInicial = $_GET["fechaInicial"];
                                $fechaFinal = $_GET["fechaFinal"];
                                $valor = null;
                                $perfil = null;
                                $valor1 = null;
                                $perfil1 = null;
                            } else {

                                $fechaInicial = null;
                                $fechaFinal = null;
                                $valor = null;
                                $perfil = null;
                                $valor1 = null;
                                $perfil1 = null;
                            }

                            $ventas = ControladorVentas::ctrRangoFechasVentasCronograma($fechaInicial, $fechaFinal, $valor, $perfil, $valor1, $perfil1);
                        } else if ($_SESSION["perfil"] == "Comercial") {
                            if (isset($_GET["fechaInicial"])) {

                                $fechaInicial = $_GET["fechaInicial"];
                                $fechaFinal = $_GET["fechaFinal"];
                                $valor = $_SESSION["id"];
                                $perfil = "vendedor";
                                $valor1 = null;
                                $perfil1 = null;
                            } else {

                                $fechaInicial = null;
                                $fechaFinal = null;
                                $valor = $_SESSION["id"];
                                $perfil = "vendedor";
                                $valor1 = null;
                                $perfil1 = null;
                            }

                            $ventas = ControladorVentas::ctrRangoFechasVentasCronograma($fechaInicial, $fechaFinal, $valor, $perfil, $valor1, $perfil1);
                        } else if ($_SESSION["perfil"] == "Agencias") {
                            if (isset($_GET["fechaInicial"])) {

                                $fechaInicial = $_GET["fechaInicial"];
                                $fechaFinal = $_GET["fechaFinal"];
                                $valor = null;
                                $perfil = null;
                                $valor1 = $_SESSION["usuario"];
                                $perfil1 = "agregopadre";
                            } else {
                                $fechaInicial = null;
                                $fechaFinal = null;
                                $valor = null;
                                $perfil = null;
                                $valor1 = $_SESSION["usuario"];
                                $perfil1 = "agregopadre";
                            }

                            $ventas = ControladorVentas::ctrRangoFechasVentasCronograma($fechaInicial, $fechaFinal, $valor, $perfil, $valor1, $perfil1);
                        } else if ($_SESSION["perfil"] == "Coordinador") {
                            if (isset($_GET["fechaInicial"])) {

                                $fechaInicial = $_GET["fechaInicial"];
                                $fechaFinal = $_GET["fechaFinal"];
                                $valor = null;
                                $perfil = null;
                                $valor1 = $_SESSION["id"];
                                $perfil1 = "coordinador";
                            } else {

                                $fechaInicial = null;
                                $fechaFinal = null;
                                $valor = null;
                                $perfil = null;
                                $valor1 = $_SESSION["id"];
                                $perfil1 = "coordinador";
                            }

                            $ventas = ControladorVentas::ctrRangoFechasVentasCronograma($fechaInicial, $fechaFinal, $valor, $perfil, $valor1, $perfil1);
                        }
                        
                        foreach ($ventas as $key => $value) {
                            echo '<tr>';
                            echo '
                            <td>' . ($key + 1) . '</td>
                            <td>' . $value["codigo"]. '</td>
                            <td>' . $value["cliente"] . '</td>';
                            if($_SESSION["perfil"] == "Administrador"){
                                echo '<td>' . $value["agregopadre"] . '</td>';
                            }
                            echo '<td>' . $value["nombre_destino"] . '</td>
                            <td>' . $value["tipoplan"] . '</td>';
                            
                            if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Coordinador") {

                                if ($value["lineaexterior"] != "") {
                                    echo ' <td style="text-align: center;"><button disabled style="color:black" class="btn btn-default btn-xs btnAgregarLinea" idSimcard2="' . $value["id"] . '" data-toggle="modal" data-target="#CrearLinea" >' . $value["lineaexterior"] . '</button></td>';
                                } else {
                                    echo '<td style="text-align: center;">';
                                    if($value["imagelinea"] == ""){
                                        echo '<button class="btn btn-info btn-xs btnAgregarLinea" data-toggle="modal" data-target="#CrearLinea" idSimcard2="' . $value["id"] . '" >Agregar Numero</button>';
                                    }else{
                                        echo '<button class="btn btn-info btn-xs verImg" data-toggle="modal" imgSrc='.$value["imagelinea"].' data-target="#verImg">Ver Linea</button>';
                                    }
                                    echo'</td>';
                                }
                            } else {
                                if ($value["lineaexterior"] != "") {
                                    echo ' <td style="text-align: center;"><button disabled class="btn btn-default btn-xs">' . $value["lineaexterior"] . '</button></td>';
                                } else {
                                    echo '<td style="text-align: center;">';
                                    if($value["imagelinea"] == ""){
                                        echo'<button disabled class="btn btn-info btn-xs">Agregar Numero</button>';
                                    }else{
                                        echo'<button class="btn btn-info btn-xs verImg" data-toggle="modal" imgSrc='.$value["imagelinea"].' data-target="#verImg">Ver Linea</button>';
                                    }
                                    echo'</td>';
                                }
                            }

                            /* echo '<td style="text-align: center;" >';
                            if($value["simcard"]){
                                //echo '<img src=' . $value["simcard"] . ' alt="simcard" style="width: 10rem;">';
                                echo '<button class="btn btn-info btn-xs verImg" data-toggle="modal" imgSrc='.$value["simcard"].' data-target="#verImg">Ver Simcard</button>';
                            }else{
                                echo 'Sin Simcard';
                            }
                            echo '</td>' */;

                            echo '
                            <td>' . $value["fechallegada"] . '</td>
                            <td>' . $value["fecharegreso"] . '</td>
                            <td>' . $value["agrego"] . '</td>
                            <td>';
                            if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Coordinador") {
                                if ($value["estado"] == "activado") {
                                    echo '<button class="btn btn-success btn-xs btnActivarSimcard" estadoSimcard="desactivado" idSimcard="' . $value["id"] . '"  >Activado</button>';
                                }else if($value["estado"] == "desactivado") {
                                    echo '<button id="btnActivarSimcard" class="btn btn-warning btn-xs btnActivarSimcard" estadoSimcard="activado" idSimcard="' . $value["id"] . '" cliente="' . $value["cliente"] . '" imglinea="'.$value["imagelinea"].'"  linea="' . $value["lineaexterior"] . '" destino="' . $value["nombre_destino"] . '" fechallegada="' . $value["fechallegada"] . '" valor="' . $value["valor"] . '" correo="' . $value["email"] . '">Desactivado</button>';
                                    /* ?>
                                    <img id="loadingSimcard" width="30" src="./vistas/img/pagina/loading.gif" alt="loading" />
                                    <?php */
                                }else {
                                    echo '<button class="btn btn-danger btn-xs" disabled>Anulada</button>';
                                }
                            } else {
                                if ($value["estado"] == "activado") {
                                    echo '<button class="btn btn-success btn-xs btnActivarSimcard" estadoSimcard="desactivado" disabled idSimcard="' . $value["id"] . '" >Activado</button>';
                                } else if($value["estado"] == "desactivado") {
                                    echo '<button class="btn btn-danger btn-xs btnActivarSimcard" disabled estadoSimcard="activado" idSimcard="' . $value["id"] . '" >Desactivado</button>';
                                }else{
                                    echo '<button class="btn btn-danger btn-xs" disabled>Anulada</button>';
                                }
                            }


                            echo '
                            </td>
                        </tr>';
                        }

                        ?>
                    </tbody>

                </table>

            </div>
        </div>

    </div>
</div>


<div class="modal inmodal" id="CrearLinea" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <h4 class="modal-title">línea en el exterior</h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post" class="form-horizontal" id="form-valid">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Agregar la línea</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Línea..." name="nuevoLinea" id="nuevoLinea" class="form-control">
                        </div>
                    </div>
                      
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Agregar Imagen</label>
                        <div class="col-sm-6">
                            <input 
                                type="file" 
                                name="nuevaImg" 
                                id="nuevaImg" 
                                class="form-control" 
                                accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                            />

                            <span>Para Quitar La Imagen Presione 
                                <i class="fa fa-arrow-right" aria-hidden="true"></i> 
                                <button style="border: none; background: transparent;" id="clearImg"> 
                                    <i style="color: red;" class="fa fa-ban" aria-hidden="true"></i>
                                </button>
                            </span>

                        </div>
                        <div class="col-sm-4">
                            <p style="text-align: center;" id="nameImage"></p>
                            <button id="btnShowImg" style="margin-inline-start: 3rem;" class="btn btn-info" data-toggle="modal" data-target="#ModalImg"></button>
                        </div>
                    </div>

                    <input type="hidden" id="NuevaLineaId" name="NuevaLineaId" value="">


                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                        <button id="validateFiles" type="submit" class="btn btn-primary">Crear Línea</button>
                    </div>

                </form>

                    <?php
                    $crearLinea = new ControladorVentas();
                    $crearLinea->ctrCrearLineaExterior();

                    ?>


            </div>

        </div>
    </div>
</div>


<!-- Modal IMG-->
<div class="modal inmodal" id="ModalImg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div  class="modal-content animated fadeIn">
            <div class="modal-body" style="display: flex; justify-content: center;">
                <img id="imgSrc" alt="imagen" srcset="" style="width:80%;">  
                <embed 
                    id="pdfSrc" 
                    type="application/pdf" 
                    width="100%" 
                    height="470px"
                />  
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal ver imagen -->
<div class="modal inmodal" id="verImg">
    <div class="modal-dialog">
        <div  class="modal-content animated fadeIn">
            <div class="modal-body" style="display: flex; justify-content: center;">
                <img id="modalImg" alt="imagen" style="width:80%;">    
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>
