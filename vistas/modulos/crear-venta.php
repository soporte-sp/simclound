<?php date_default_timezone_set("America/Bogota"); ?>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-2"></div>

        <div class="col-lg-9">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Agregar Venta</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" class="form-horizontal" id="crearVenta"  enctype="multipart/form-data">     
                        <div>
                            
                            <?php 
                                echo '<input type="hidden" class="form-control" value="' . $_SESSION["idcoordinadordeadmin"] . '" id="nuevoCoordinador">';

                                if ($_SESSION["perfil"] == "Agencias" || $_SESSION["perfil"] == "Coordinador") {
                                    echo '
                                        <input type="hidden" class="form-control" value="' . $_SESSION["usuario"] . '" id="nuevoAgregoPadre">
                                    ';
                                } else if ($_SESSION["perfil"] == "Comercial") {
                                    echo '<input type="hidden" class="form-control" value="' . $_SESSION["comercial"] . '" id="nuevoAgregoPadre">';
                                } else if ($_SESSION["perfil"] == "Administrador") {
                                    echo '<input type="hidden" class="form-control" value="NA" id="nuevoAgregoPadre">';
                                }
                            ?>
                            <input type="hidden" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["id"] ?>"/>
                            <input type="hidden" class="form-control" id="nuevoCierreHora" value="<?php echo date('G:i') ?>">
                            <input type="hidden" class="form-control" id="nuevoAgrego" value="<?php echo $_SESSION["usuario"] ?>" />
                            <!-- <input type="hidden" class="form-control" id="nuevoEstado" value="desactivado"> -->

                        </div>

                        <div class="form-group">
                            <p class="col-sm-6 h4 text-danger" style="color: #Ff9aac;">Datos Del Pasajero</p>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nombre: <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nuevoCliente" id="nuevoCliente">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Numero de celular: <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="nuevoCelular" id="nuevoCelular">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email: <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="nuevoCorreo" id="nuevoCorreo">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Pasaporte</label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" name="nuevoPasaporte" id="filePasaporte">
                                <span id="msgValidPas" style="color: red; display: none;">Formato no permitido agregar un pdf o imagen</span>
                            </div>
                            <div id="showImgPas" class="col-sm-3"></div>
                        </div>

                        <input type="hidden" value="<?php echo $_SESSION["perfil"] ?>" id="perfil">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">IMEI: <span style="color: red">*</span></label>
                            <div class="col-sm-7">
                                <input id="fileImgImei" type="file" class="form-control" name="imei">
                                <p>Para obtener el código IMEI del teléfono, se debe marcar <strong>*#06#</strong></p>
                                <span id="msgValidImg" style="color: red; display: none;">Formato no permitido agregar un pdf o una imagen</span>
                            </div>
                            <div id="showImg" class="col-sm-4"></div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                            </div>
                        </div>

                        <div class="form-group">
                            <p class="col-sm-6 h4 text-danger" style="color: #Ff9aac;">Datos Del Plan</p>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tipo De SimCard: <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control m-b" name="tipoSimCard" id="tipoSimCard" >
                                    <option value="">Escoge El Tipo De SimCard</option>
                                    <option value="E">Esim</option>
                                    <option value="F">Fisica</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="destinos" style="display: none;">
                            <label class="col-sm-3 control-label">Destinos: <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control m-b" name="nuevoDestino" id="destinosCargados"></select>
                            </div>
                        </div>

                        <div class="form-group" id="plan" style="display: none;">
                            <label class="col-sm-3 control-label">Plan: <span style="color: red">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control m-b" name="tipoPlan" id="tipoPlan" >
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="description" style="display: none;">
                            <label class="col-sm-3 control-label">Descripción:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control m-b" rows="3" name="textDescription" id="textDescription" disabled></textarea>
                            </div>
                        </div>

                        <div class="form-group" id="priceDesc" style="display: none;">
                            <label class="col-sm-3 control-label">Precio: </label>
                            <div class="col-sm-6">
                                <input id="price" type="text" class="form-control" name="price" disabled>
                            </div>
                        </div>

                        <div class="form-group" id="simcard" style="display: none;">
                            <label class="col-sm-3 control-label">SimCard: </label>
                            <div class="col-sm-6">
                                <input id="fileSimcard" type="file" class="form-control" name="nuevoSimCard" />
                                <span id="msgValidImgSim" style="color: red; display: none;">Formato no permitido solo se acepta imagen</span>
                            </div>
                            <div id="showSimCard" class="col-sm-3"></div>
                        </div>

                        <div class="form-group" id="fechas" >

                            <div class="col-sm-6">
                                <label class="col-sm-6 control-label">Fecha De Salida: <span style="color: red">*</span></label>
                                <div class="col-sm-6">
                                    <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" class="form-control" id="fechaSalida" name="fechaSalida" min="<?php echo date("Y-m-d"); ?>">
                                </div>
                                </div>
                            </div>

                            <div class="col-sm-6" id="fechaRgs">
                                <label class="col-sm-6 control-label">Fecha De Regreso: <span style="color: red">*</span></label>
                                <div class="col-sm-6">
                                    <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" id="fechaRegreso" class="form-control" name="fechaRegreso" disabled />
                                </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-group" id="fechaV">
                            <label class="col-sm-3 control-label">Fecha De Venta:</label>
                            <div class="col-sm-9">
                                <div class="input-group date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" id="fechaVenta" class="form-control" value="<?php echo date("Y-m-d"); ?>" name="fechaVenta" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="observacion">
                            <label class="col-sm-3 control-label">Observaciones:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control m-b" rows="3" name="observacion" id="observaciontext" ></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-6 control-label"></label>
                            <button type="submit" id="btnCrearVenta" class="btn btn-success">Guardar</button>
                            <img id="loading" style="display: none;" width="40" src="./vistas/img/pagina/loading.gif" alt="loading">
                        </div>
                    </form>
                    <button onclick="javascript:window.location = 'ventas'" class="btn btn-info return">Volver</button>
                </div>
            </div>
            
            <script src="./vistas/js/primaria/crear-ventas.js"></script>
        </div>
     </div>
    </div>
  </div>