<?php

$item = "id";
$valor = $_GET["idVenta"];
$item1 = null;
$valor3 = null;

$ventas = ControladorVentas::ctrMostrarVentas($item, $valor, $item1, $valor3,$_SESSION['perfil']);
//var_dump($ventas);
?>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Consultar Venta</h5>
                </div>
                <div class="ibox-content">

                   <div class="form-horizontal">

                    <div class="form-group">
                            <label class="col-sm-3 control-label">Código</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["codigo"]; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nombre del Pasajero</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["cliente"]; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Numero del celular</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["celular"]; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["email"]; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Numero De pasaporte</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["pasaporte"]; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Imei</label>
                            <div class="col-sm-9">
                                <button class="btn btn-info" id="showImei" data-toggle="modal" data-target="#verImei" imei="<?php echo $ventas["imei"];?>">Ver Imei</button>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tipo Simcard</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["tiposimcard"] == "E" ? "Esim": "Fisica" ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Destino</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["destino"]; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Plan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["tipoplan"]; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Descripción</label>
                            <div class="col-sm-9">
                                <textarea class="form-control m-b" rows="3" disabled><?php echo $ventas["descripcion"]?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Precio</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["valor"]; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Simcard</label>
                            <div class="col-sm-9">
                                <?php 
                                 if(empty($ventas["simcard"])){
                                    echo '<input type="text" class="form-control" value="Simcard No Asignada" disabled>';
                                 }else{
                                    ?><button class="btn btn-info" id="showSimcard" data-toggle="modal" data-target="#verSimcard" simcard="<?php echo $ventas["simcard"]?>">Ver Simcard</button><?php
                                }
                                ?>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="col-sm-6 control-label">Fecha de llegada</label>
                                <div class="col-sm-6">
                                    <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" value="<?php echo $ventas["fechallegada"]; ?>" disabled>
                                </div>
                                </div>
                            </div>

                            <div class="col-sm-6" id="fechaRgs">
                                <label class="col-sm-6 control-label">Fecha de regreso</label>
                                <div class="col-sm-6">
                                    <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" value="<?php echo $ventas["fecharegreso"]; ?>" disabled>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Fecha Venta</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" value="<?php echo $ventas["fechaventa"]; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Linea Exterior</label>
                            <div class="col-sm-9">
                                <?php 
                                if($ventas["lineaexterior"] != ""){
                                    echo '<input type="text" class="form-control" value="'.$ventas["lineaexterior"].'" disabled>';
                                }else if($ventas["imagelinea"] != ""){
                                    ?><button class="btn btn-info" id="showLinea" data-toggle="modal" data-target="#verLinea" linea="<?php echo $ventas["imagelinea"]?>">Ver Linea Exterior</button><?php
                                }else{
                                    echo '<input type="text" class="form-control" value="Aun No Asignada" disabled>';  
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Estado de Linea</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["estado"]; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Observacion</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" disabled><?php echo $ventas["observacion"]; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Agencia</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["agencia"] === null ? $ventas["nombre"] : $ventas["agencia"]?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Vendedor</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $ventas["nombre"]; ?>" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-12 control-label"></label>
                            <button type="button" class="btn btn-success" id="return">Volver</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>

<!-- Modal ver imagen Imei -->
<div class="modal inmodal" id="verImei">
    <div class="modal-dialog">
        <div  class="modal-content animated fadeIn">
            <div class="modal-body" style="display: flex; justify-content: center;">
                <img id="modalImg" alt="imagen">  
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal ver imagen Simcard -->
<div class="modal inmodal" id="verSimcard">
    <div class="modal-dialog">
        <div  class="modal-content animated fadeIn">
            <div class="modal-body" style="display: flex; justify-content: center;">
                <img id="modalImgSimcard" alt="imagen">  
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal ver imagen Linea -->
<div class="modal inmodal" id="verLinea">
    <div class="modal-dialog">
        <div  class="modal-content animated fadeIn">
            <div class="modal-body" style="display: flex; justify-content: center;">
                <img id="modalImgLinea" alt="imagen">  
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<script src="./vistas/js/primaria/editar-ventas.js"></script>
    
