<div class="col-lg-12 animated fadeInRight" style="margin-top: 15px;">
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Acciones</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-8">
                        <?php 
                        if(($_SESSION["perfil"] != "Administrador") && ($_SESSION["perfil"] != "Coordinador")){
                            echo '<a href="crear-venta"><button type="button" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Nueva Venta</button></a>';
                        }
                        
                        ?>
                        <a href="ventas"><button type="button" class="btn btn-warning cancelarFecha"><i class="fa fa-window-close"></i>&nbsp;Cancelar Fechas</button></a>
                        <button id="reportrange" type="button" style="background: #fff; cursor: pointer; padding: 6px 10px; border: 2px solid #ccc; width:25%;border-radius: 5px;">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                    <div class="col-lg-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 animated fadeInRight">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Ventas Realizadas</h5>
            </div>
            <div class="ibox-content">
                <table id="tablePlanesVenta" class="table table-bordered table-striped dt-responsive">
                </table>
                        <?php
                            echo '<input type="hidden" value="'.$_SESSION["perfil"].'" id="perfil" />';
                            if ($_SESSION["perfil"] == "Administrador") {
                                if (isset($_GET["fechaInicial"])){
                                echo '<input type="hidden" value="'.$_GET["fechaInicial"].'" id="fechaInicial" />';
                                echo '<input type="hidden" value="'.$_GET["fechaFinal"].'" id="fechaFinal" />';  
                                }
                            }
                            else if ($_SESSION["perfil"] == "Comercial") {
                                echo '<input type="hidden" value="'.$_SESSION["id"].'" id="sessionId" />';
                                echo '<input type="hidden" value="vendedor" id="perfilUser" />';
                                if (isset($_GET["fechaInicial"])){
                                    echo '<input type="hidden" value="'.$_GET["fechaInicial"].'" id="fechaInicial" />';
                                    echo '<input type="hidden" value="'.$_GET["fechaFinal"].'" id="fechaFinal" />';  
                                }
                            
                            } else if ($_SESSION["perfil"] == "Agencias") {
                                echo '<input type="hidden" value="'.$_SESSION["usuario"].'" id="sessionUser" />';
                                echo '<input type="hidden" value="'.$_SESSION["id"].'" id="sessionId" />';
                                echo '<input type="hidden" value="agregopadre" id="perfilag" />';
                                if (isset($_GET["fechaInicial"])){
                                    echo '<input type="hidden" value="'.$_GET["fechaInicial"].'" id="fechaInicial" />';
                                    echo '<input type="hidden" value="'.$_GET["fechaFinal"].'" id="fechaFinal" />';  
                                }

                            } else if ($_SESSION["perfil"] == "Coordinador") {
                                $valor1 = 1;
                                echo '<input type="hidden" value="'.$_SESSION["usuario"].'" id="sessionUser" />';
                                echo '<input type="hidden" value="'.$_SESSION["id"].'" id="sessionId" />';
                                echo '<input type="hidden" value="coordinador" id="perfilag" />';
                                if (isset($_GET["fechaInicial"])){
                                    echo '<input type="hidden" value="'.$_GET["fechaInicial"].'" id="fechaInicial" />';
                                    echo '<input type="hidden" value="'.$_GET["fechaFinal"].'" id="fechaFinal" />';  
                                }
                            }

                        ?>
            </div>
        </div>
    </div>
</div>

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

<div class="modal inmodal" id="verDes">
    <div class="modal-dialog">
        <div  class="modal-content animated fadeIn">
            <div class="modal-body" >
                <h1>Descripción de la Venta</h1> 
                <p id="contentobser"></p>  
                <h1>Observación del Plan</h1> 
                <p id="contentdesc"></p>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<script src="./vistas/js/primaria/crear-ventas.js"></script>