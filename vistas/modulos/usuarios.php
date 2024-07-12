<?php
if ($_SESSION["perfil"] == "Comercial") {
  echo '<script> 
    window.location = "inicio";
  </script>';
  return;
}

?>

<div class="row wrapper border-bottom white-bg page-heading">

  <div class="col-lg-10">

    <h2>Usuarios</h2>

    <ol class="breadcrumb">

      <li>

        <a href="inicio">Home</a>

      </li>

      <li class="active">

        <strong>Usuarios</strong>

      </li>

    </ol>

  </div>

  <div class="col-lg-2">

  </div>

</div>


<div class="col-lg-12 animated fadeInRight" id="createAption" style="margin-top: 15px;">

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

        <h3 class="font-bold">Ingresar los usuarios</h3>

        <p>

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CrearUsuario"><i
              class="fa fa-check"></i>&nbsp;Crear Usuario</button>

        </p>

      </div>

    </div>

  </div>

</div>


<!--Tabla-->

<div class="row">

  <div class="col-lg-12 animated fadeInRight">

    <div class="ibox float-e-margins">

      <div class="ibox-title">

        <h5>Usuarios</h5>

      </div>

      <div class="ibox-content">

        <table class="table table-bordered table-striped dt-responsive" id="showTableUser">

        </table>

        <input type="hidden" value="<?php echo $_SESSION["perfil"] ?>" id="perfil">

        <input type="hidden" value="<?php echo $_SESSION["id"] ?>" id="idSession">

        <input type="hidden" value="<?php echo $_SESSION["usuario"] ?>" id="userSession">

      </div>

    </div>

  </div>

</div>


<!--Crear-->

<div class="modal inmodal" id="CrearUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
            class="sr-only">Close</span></button>
        <i class="fa fa-clock-o modal-icon"></i>
        <h4 class="modal-title">Crear Nuevo Usuario</h4>
        <small>Ingrese los datos correspondientes del usuario</small>
      </div>
      <div class="modal-body">
        <form method="post" class="form-horizontal" id="formInsert">
          <div class="form-group">
            <label class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Nombre" id="nombre" name="nuevoNombre" class="form-control" required>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Usuario</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Username" id="usuario" name="nuevoUsuario" class="form-control" required>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Correo</label>
            <div class="col-sm-10">
              <input type="text" placeholder="simcloud@dominio.com" name="correo" id="correo" class="form-control"
                required>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Contraseña</label>
            <div class="col-sm-10">
              <input type="password" placeholder="****" name="nuevoPassword" id="password" class="form-control"
                minlength=6 required>
            </div>
          </div>
          <div class="hr-line-dashed"></div>

          <!--administrador-->
          <input type="hidden" value="<?php echo $_SESSION["perfil"] ?>" id="mostrar" />
          <!--agencias-->
          <input type="hidden" name="addcordinadoradmin" value="<?php echo $_SESSION["idcoordinadordeadmin"] ?>">

          <?php
          if ($_SESSION["perfil"] == "Administrador") {
            echo '
                        <div class="form-group">
                         <label class="col-sm-2 control-label">Perfil</label>
                         <div class="col-sm-10">
                            <select class="form-control m-b" name="nuevoPerfil" id="comboPerfil">
                                <option value="Administrador">Administrador</option>
                                <option value="Agencias">Agencias</option>
                                <!--option value="Comercial">Asesor</option-->
                                <option value="Coordinador">Coordinador</option>
                            </select>
                         </div>
                     <input type="hidden" name="nuevoCoordinador" id="nuevoCoordinador" value="0" class="form-control">
                     <input type="hidden" placeholder="idpadre" id="capturarIdPadre" name="nuevoIdPadre" value="" class="form-control">
                     </div>';
            ?>
            <div class="form-group" id="nit" style="display: none;">
              <label class="col-sm-2 control-label">Nit</label>
              <div class="col-sm-10">
                <input type="text" placeholder="NIT" name="nuevoNit" id="nitInput" class="form-control">
              </div>
            </div>
            <div class="form-group" style="display: none;" id="showCordinador">
              <label class="col-sm-2 control-label">Escoger el Coordinador</label>
              <div class="col-sm-10">
                <select class="form-control m-b" name="addcordinadoradmin" id="addcordinadoradmin"
                  data-placeholder="Escoge el Coordinador">
                </select>
              </div>
            </div>
            <?php

          } else if ($_SESSION["perfil"] == "Agencias") {
            echo '
                        <div class="form-group">
                         <label class="col-sm-2 control-label">Perfil</label>
                         <div class="col-sm-10">
                            <select class="form-control m-b" name="nuevoPerfil" id="comboPerfil">
                                <option value="Comercial">Asesor</option>
                            </select>
                         </div>

                          <input type="hidden" name="nuevoCoordinador" id="nuevoCoordinador" value="1" class="form-control">
                          <input type="hidden" placeholder="idpadre" name="nuevoIdPadre" id="capturarIdPadre" class="form-control" value="' . $_SESSION["id"] . '" >
                          <input type="hidden" name="capturarIdAgencia" id="capturarIdAgencia" value="' . $_SESSION["usuario"] . '" >
                          <input type="hidden" id="addcordinadoradmin" value="' . $_SESSION["idcoordinadordeadmin"] . '">

                        </div>';

          } else if ($_SESSION["perfil"] == "Coordinador") {
            echo '
                          <div class="form-group">
                          <label class="col-sm-2 control-label">Perfil</label>
                          <div class="col-sm-10">
                              <select class="form-control m-b" name="nuevoPerfil" id="comboPerfil1" onchange="cambiar1()" required>
                                  <option value="Agencias">Agencias</option>
                                  <option value="Comercial">Asesor</option>
                              </select>
                          </div>
                        </div>
                          <input type="hidden" placeholder="idpadre" id="capturarIdPadre8" name="nuevoIdPadre" value="" class="form-control">
                          <input type="hidden" name="nuevoCoordinador" value="1" class="form-control">
                          <input type="hidden" name="addcordinadoradmin" value="' . $_SESSION["id"] . '">';
          }

          ?>

          <div class="form-group" id="showAgencia" style="display: none;">
            <label class="col-sm-2 control-label">Agencias</label>
            <div class="col-sm-10">
              <select class="form-control m-b" id="capturarIdAgencia" name="nuevoComercial">
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Crear Usuario</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--editar-->

<div class="modal inmodal" id="editarUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
            class="sr-only">Close</span></button>
        <i class="fa fa-clock-o modal-icon"></i>
        <h4 class="modal-title">Editar el Usuario</h4>
        <small>Edite los datos correspondientes del usuario</small>
      </div>

      <div class="modal-body">
        <form method="post" class="form-horizontal" id="formEditar">
          <input type="hidden" name="editarIdUsuario" id="editarIdUsuario">

          <div class="form-group">
            <label class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" id="editarNombre" placeholder="Nombre" name="editarNombre" class="form-control">
            </div>
          </div>

          <div class="hr-line-dashed"></div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Usuario</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Usuario" id="editarUsuario2" name="editarUsuario2" class="form-control"
                disabled>
            </div>
          </div>

          <div class="hr-line-dashed"></div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Correo</label>
            <div class="col-sm-10">
              <input type="email" placeholder="simcloud@dominio.com" name="editarCorreo" id="editarCorreo"
                class="form-control">
            </div>
          </div>

          <div class="hr-line-dashed"></div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Contraseña</label>
            <div class="col-sm-10">
              <input type="password" placeholder="****" name="editarPassword" id="editarPassword" class="form-control">
              <input type="hidden" id="passwordActual" name="passwordActual">
            </div>
          </div>

          <div class="hr-line-dashed"></div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Perfil</label>
            <div class="col-sm-10">
              <select class="form-control m-b" name="editarPerfil" id="comboPerfil2" disabled>
                <option value="" id="editarPerfil"></option>
              </select>
            </div>
          </div>

          <?php


          if ($_SESSION["perfil"] == "Administrador") {
            echo '<input type="hidden" placeholder="idpadre" id="capturarIdPadre2" name="editarIdPadre" value="" class="form-control idpadretraer">';
          } else if ($_SESSION["perfil"] == "Coordinador") {
            echo '<input type="hidden" placeholder="idpadre" id="capturarIdPadre5" name="editarIdPadre" value="" class="form-control">
                  <input type="hidden" name="nuevoCoordinador" value="1" class="form-control">';
          }

          ?>

          <div class="hr-line-dashed"></div>

          <div class="form-group" id="campo_otroPerfil3" style="display: none;">
            <label class="col-sm-2 control-label">Agencias</label>
            <div class="col-sm-10">
              <select class="form-control m-b" name="editarComercial" id="capturarIdAgencia2">
              </select>
            </div>
          </div>

          <div class="form-group" style="display: none;" id="showCordinadorEditar">
            <label class="col-sm-2 control-label">Escoger el Coordinador</label>
            <div class="col-sm-10">
              <select class="form-control m-b" name="addcordinadoradminedit" id="addcordinadoradminedit"
                data-placeholder="Escoge el Coordinador">
              </select>
              <input type="hidden" id="idCordinadorActual">
            </div>
          </div>

          <div class="form-group" id="showNitEditar" style="display: none;">
            <label class="col-sm-2 control-label">Nit</label>
            <div class="col-sm-10">
              <input type="text" placeholder="NIT" name="editarNit" id="editarNit" class="form-control" disabled>
            </div>
          </div>

          <div class="hr-line-dashed"></div>

          <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Editar Usuario</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>



<script src="./vistas/js/primaria/usuarios.js"></script>