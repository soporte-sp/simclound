
<!--header-->
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

                <h3 class="font-bold">Ingresar los planes</h3>
                <p>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#CrearPlanes"><i class="fa fa-check"></i>&nbsp;Crear Planes</button>
                </p>
            </div>
        </div>
    </div>
</div>

<!--modal crear planes-->
<div class="modal inmodal" id="CrearPlanes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-clock-o modal-icon"></i>
                <h4 class="modal-title">Ingresar el Plan</h4>
                <small>Ingrese los datos correspondientes del plan</small>
            </div>

            <div class="modal-body">
                <form method="post" class="form-horizontal" id="formCreatePlans" enctype="multipart/form-data">
                    <div class="form-group">

                        <label class="col-sm-3" form="tipoDeSimcard">Tipo De Simcard</label>
                        
                        <div class="col-sm-9">
                            <select class="form-control m-b" name="tipoDeSimcard" id="tipoDeSimcard" required>
                                <option value="">Por Favor Selecione El Tipo De Simcard...</option>
                                <option value="E">E-Sim</option>
                                <option value="F">Física</option>
                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3">Destino</label>
                        <div class="col-sm-9">
                            <select class="form-control m-b" name="destino" id="destino" required>
                                <option value="">Por Favor Selecione Un Destino...</option>
                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3">Tipo De Plan</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Ingrese El Tipo De Plan" name="tipoPlan" id="tipoPlan" class="form-control" required>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3">Precio Dolares</label>
                        <div class="col-sm-9">
                            <input type="number" placeholder="10 USD" name="preciodolares" id="preciodolares" class="form-control" min="1" max="10000" required>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3">Codigo Interno</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="23H42" name="codigointerno" id="codigointerno" class="form-control" required>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3">Descripcion</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="descripcion"  id="descripcion" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="createPlan">Crear Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--tabla planes-->
<div class="row">
        <div class="col-lg-12 animated fadeInRight">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Planes</h5>
            </div>
            <div class="ibox-content">
            <table id="showPlans" class="table table-bordered table-striped dt-responsive " >
            </table>
     
        </div>
        </div>
    </div>
  </div>

 <style>
     .unselectable {
        background-color: #ddd;
        cursor: not-allowed;
    }
 </style>

<!--modal editar planes-->
<div class="modal inmodal" id="EditPlans" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-clock-o modal-icon"></i>
                <h4 class="modal-title">Editar Plan</h4>
                <small>Ingrese los datos correspondientes del plan</small>
            </div>

            <div class="modal-body">
                <form method="post" class="form-horizontal" id="formEditPlans" enctype="multipart/form-data">
                    <p style="display: none;" id="idPlan"></p>
                    <div class="form-group">

                        <label class="col-sm-3" form="tipoDeSimcard">Tipo De Simcard</label>
                        
                        <div class="col-sm-9">
                            <select class="form-control m-b" name="editTipoDeSimcard" id="editTipoDeSimcard" disabled>
                                <option selected="true" value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3">Destino</label>
                        <div class="col-sm-9">
                            <select class="form-control m-b" name="editDestino" id="editDestino" disabled>
                                <option selected="true" value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3">Tipo De Plan</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Ingrese El Tipo De Plan" name="editTipoPlan" id="editTipoPlan" class="form-control" required>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3">Precio Dolares</label>
                        <div class="col-sm-9">
                            <input type="number" placeholder="10 USD" name="editPreciodolares" id="editPreciodolares" class="form-control" min="1" max="10000" required>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3">Codigo Interno</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="23H42" name="editCodigointerno" id="editCodigointerno" class="form-control" required>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-3">Descripcion</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="editDescripcion"  id="editDescripcion" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="editarPlan">Editar Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal inmodal" id="verDescripcion">
    <div class="modal-dialog">
        <div  class="modal-content animated fadeIn">
            <div class="modal-body" >
            <h1>Descripción Del Plan</h1>
                <p id="modalDescription"></p>   
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>

<script src="./vistas/js/primaria/planes.js"></script>
