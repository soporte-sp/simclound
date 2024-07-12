$(document).ready(() => {
  if($('#perfil').val() != "Comercial"){
     getTableUsers();
  }
  if($('#mostrar').val() == 'Agencias'){
    //$('#showAgencia').show();
    $('#editarPerfil').hide()
    //getPerfil('Agencias');
  }
});


const getTableUsers = () => {
  
  DATA = new FormData();
  DATA.append("ACTION","GET_TABLE_USERS");
  if($('#perfil').val() == "Administrador"){
    OBJECT_DATA = {perfil: $('#perfil').val()}
  }
  if($('#perfil').val() == "Coordinador"){
    //debe traer todas las agencias asociadas a ese usuario
    $('#createAption').hide();
    OBJECT_DATA = {
      perfil: $('#perfil').val(),
      id: $('#idSession').val(),
      //comercial: $('#userSession').val()
    }
  };
  if($('#perfil').val() == "Agencias"){
    OBJECT_DATA = {
      perfil: $('#perfil').val(),
      id: $('#idSession').val(),
      comercial: $('#userSession').val()
    }
  }
  DATA.append("DATA", JSON.stringify(OBJECT_DATA));
  
  app.callAjax('controladores/usuario.controlador.php', DATA, (response) => {
      let arrayData = [];
      response.map((user, index) => {
        if(!user.idpadre){
          arrayData[index] = 
              [index+1,
               user.nombre, //agencia
               user.nombre,
               user.usuario2,
               changePerfilComercial(user.perfil),
               statusUser(user.estado,user.id),
               actionUser(user.estado,user.id,user.usuario2)]
          }else{
            arrayData[index] = 
              [index+1,
               getNameAgencia(user.idpadre,user.nombre, response),
               user.nombre,
               user.usuario2,
               changePerfilComercial(user.perfil),
               statusUser(user.estado,user.id),
               actionUser(user.estado,user.id,user.usuario2)]
          }
      })
          $("#showTableUser").DataTable({
              "language": {
                  "lengthMenu": "Mostrar _MENU_ registros",
                  "zeroRecords": "No se encontraron resultados",
                  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
                  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                  "sSearch":         "Buscar:",
                  "oPaginate": {
                      "sFirst":    "Primero",
                      "sLast":     "Último",
                      "sNext":     "Siguiente",
                      "sPrevious": "Anterior"
                      }
              },
              data: arrayData,
              columns: [
                  {title: '#'},
                  {title: 'Agencia'},
                  {title: 'Nombre'},
                  {title: 'Usuario'},
                  {title: 'Perfil'},
                  {title: 'Estado'},
                  {title: 'Acciones'},
              ],
          })
      
  });
}

const getNameAgencia = (idpadre, user, response) => {
    if(idpadre != "0"){
      const rta = response.find(item => item.id == idpadre);
      return rta.nombre;
    }else{
      return user;
    }
}

const changePerfilComercial = (perfil) => {
  if(perfil == "Comercial"){
    return "Asesor"
  }else{
    return perfil;
  }
}

const statusUser = (status,id) => {
  if(status == "1"){
    return `
      <button 
        class="btn btn-success btn-xs btnActivarUsuario" 
        idUsuario="${id}" 
        estadoUsuario="0"
      >
        Activado
      </button>
    `;
  }else if(status == "0"){
    return `
      <button 
        class="btn btn-info btn-xs btnActivarUsuario" 
        idUsuario="${id}" 
        estadoUsuario="1"
      >
        Desactivado
      </button>
    `;
  }else{
    return `
      <button class="btn btn-danger btn-xs" disabled>
        Eliminado
      </button>
    `;
  }
}

$(document).on("click", ".btnActivarUsuario", function(){
  DATA = new FormData();
  DATA.append("ACTION","SET_STATUS_CHANGE");
  OBJECT_DATA = {
    id: $(this).attr("idUsuario"),
    estado: $(this).attr("estadoUsuario"),
  };
DATA.append("DATA", JSON.stringify(OBJECT_DATA));
  app.callAjax('controladores/usuario.controlador.php', DATA, (response) => {
    if(response.RESULT == "0"){
      $(this).removeClass('btn-success');
      $(this).addClass('btn-info');
      $(this).html('Desactivado');
      $(this).attr('estadoUsuario',1);
    }else{
      $(this).addClass('btn-success');
      $(this).removeClass('btn-info');
      $(this).html('Activado');
      $(this).attr('estadoUsuario',0);
    }
    //window.location.reload();
  })
})

const actionUser = (estado,id,usuario2) => {
  if(estado != "2"){
      return `
      <div class="btn-group">
      <button 
        class="btn btn-warning btnEditarUsuario" 
        idUsuario="${id}" 
        type="button" 
        data-toggle="modal" 
        data-target="#editarUsuario"
      >
        <i class="fa fa-edit" aria-hidden="true"></i>
      </button>
      <button 
        class="btn btn-danger btnEliminarUsuario" 
        idUsuario="${id}" 
        usuario="${usuario2}" 
        type="button"
      >
        <i class="fa fa-times" aria-hidden="true"></i>
      </button>
      </div>`;
  }else{
    return `
    <div class="btn-group">
    <button 
      class="btn btn-warning btnEditarUsuario" 
      idUsuario="${id}" 
      type="button" 
      data-toggle="modal" 
      data-target="#editarUsuario"
      disabled
    >
      <i class="fa fa-edit" aria-hidden="true"></i>
    </button>
    <button 
      class="btn btn-danger btnEliminarUsuario" 
      idUsuario="${id}" 
      usuario="${usuario2}" 
      type="button"
      disabled
    >
      <i class="fa fa-times" aria-hidden="true"></i>
    </button>
    </div>`;
  }
}

$(document).on('change', '#comboPerfil', function(){
  const tipoPerfilSelect = $("#comboPerfil option:selected").val();
  console.log(tipoPerfilSelect);
  if(tipoPerfilSelect == "Agencias"){
    $('#nit').show();
    getPerfil('Coordinador');
    $('#showCordinador').show();
  }else{
    $('#nit').hide();
    $('#showCordinador').hide();
  }

  /* if(tipoPerfilSelect == "Coordinador"){
    getPerfil('Coordinador');
    $('#showCordinador').show();

  }else{
    $('#showCordinador').hide();
  } */

  if(tipoPerfilSelect == "Comercial"){
    getPerfil('Agencias');
    $('#showAgencia').show();
  }else{
    $('#showAgencia').hide();
  }
});

const getPerfil = (perfil) => {
  DATA = new FormData();
  DATA.append("ACTION","GET_PERFIL");
  OBJECT_DATA = {
    perfil: perfil
  };
  DATA.append("DATA", JSON.stringify(OBJECT_DATA));
  app.callAjax('controladores/usuario.controlador.php', DATA, (response) => {

    if(response.PERFIL == "Coordinador"){
      $('#addcordinadoradmin').empty();
      $("#addcordinadoradmin").append('<option value="">Escoge El Coordinador</option>');
      response.RESULT.map((user) => {
        $("#addcordinadoradmin").append(
          `<option value="${user.id}">${user.nombre}</option>`
          );
        });
      }

    if(response.PERFIL == "Agencias"){
      $('#capturarIdAgencia').empty();
      $("#capturarIdAgencia").append('<option value="">Escoge Usuario</option>');
      response.RESULT.map((user) => {
        $("#capturarIdAgencia").append(
          `<option value="${user.usuario2}">${user.nombre}</option>`
          );
        });
      }

  })
}

$("#capturarIdAgencia").change(function(){
  DATA = new FormData();
  DATA.append("ACTION","GET_ID_AGENCIA");
  OBJECT_DATA = {
    usuario2: $(this).val()
  };
  DATA.append("DATA", JSON.stringify(OBJECT_DATA));
  app.callAjax('controladores/usuario.controlador.php', DATA, (response) => {
    $("#capturarIdPadre").val(response.id);
  })
});

$("#capturarIdAgencia2").change(function(){
  DATA = new FormData();
  DATA.append("ACTION","GET_ID_AGENCIA");
  OBJECT_DATA = {
    usuario2: $(this).val()
  };
  DATA.append("DATA", JSON.stringify(OBJECT_DATA));
  app.callAjax('controladores/usuario.controlador.php', DATA, (response) => {
    $("#capturarIdPadre2").val(response.id);
  })
});

/* const ValidarUser = () => {
  console.log($('#usuario').val())
  console.log($('#correo').val())
  return false;
} */

$("#formInsert").validate({
  rules: {
    nuevoNombre: { required: true },
    nuevoUsuario: { required: true },
    nuevoPassword: { /* required: true, */ minlength: 6},
    nuevoPerfil: { required: true,},
    nuevoNit: { required: true },
    nuevoComercial: { required: true },
    nuevoIdPadre: { required: true },
    correo: {required: true},
    addcordinadoradmin: {required: true}
  },
  messages: {
    nuevoNombre: {required: "Este Campo Es Requerido"},
    nuevoUsuario: {required: "Este Campo Es Requerido"},
    nuevoPassword: {minlength: "La Contraseña Debe Tener Minimo 6 Caracteres"},
    nuevoPerfil: { required: "Este Campo Es Requerido"},
    nuevoNit: { required: "Este Campo Es Requerido" },
    nuevoComercial: { required: "Este Campo Es Requerido" },
    correo: { required: "Este Campo Es Requerido" },
    addcordinadoradmin: {required: "Este Campo Es Requerido"}
  },
  submitHandler: (form) => {
      DATA = new FormData();
      DATA.append("ACTION", "INSERT_USER");
      OBJECT_DATA = {
          nombre: $('#nombre').val(),
          usuario2: $('#usuario').val(),
          correo: $('#correo').val(),
          password: $('#password').val(),
          perfil: $('#comboPerfil').val(),
          mostrar: $('#mostrar').val() == "Administrador" ? 0 : 1,
          nit: $('#nitInput').val() == null ? "" : $('#nitInput').val(),
          comercial: $('#capturarIdAgencia').val() == null ? "": $('#capturarIdAgencia').val(),
          idpadre: $('#capturarIdPadre').val(),
          coordinador: $('#nuevoCoordinador').val(),
          idcoordinadordeadmin: $('#addcordinadoradmin').val(),
      };
      DATA.append("DATA", JSON.stringify(OBJECT_DATA));
      app.callAjax('controladores/usuario.controlador.php', DATA, (response) =>{
          if(response.RESULT){
              swal({
                  title: '¡Usuario Creado!',
                  text: response.MESSAGE,
                  type: 'success',
                  confirmButtonText: "¡Cerrar!"
                });
              $("#CrearUsuario").modal("hide");
              setTimeout(()=>window.location.reload(),1000)
          }else{
              swal({
                  title: '¡Alerta!',
                  text: response.MESSAGE,
                  type: 'error',
                  confirmButtonText: "¡Cerrar!"
                });
              $("#CrearUsuario").modal("hide");

          }
      });
  }
});

$(document).on("click", ".btnEditarUsuario", function(){
  
  DATA = new FormData();
  DATA.append("ACTION","SHOW_EDITAR_USER");
  OBJECT_DATA = {id: $(this).attr("idUsuario")};
  DATA.append("DATA", JSON.stringify(OBJECT_DATA));
  
  app.callAjax('controladores/usuario.controlador.php', DATA, (response) => {
      $("#editarNombre").val(response.nombre);
      $("#editarUsuario2").val(response.usuario2);
      $("#editarCorreo").val(response.correo);
      $("#editarPerfil").html(changePerfilComercial(response.perfil));
      $("#editarPerfil").val(response.perfil);
      $("#editarIdUsuario").val(response.id);
      if(response.perfil == "Agencias"){
        $('#showNitEditar').show();
        $("#editarNit").val(response.nit);
        $('#showCordinadorEditar').show();
          getPerfilEditar("Coordinador",response.idcoordinadordeadmin);
      }else{
        $('#showNitEditar').hide();
        $('#showCordinadorEditar').hide();
      }
      /* if(response.perfil == "Comercial"){
        $('#campo_otroPerfil3').show();
        console.log(response.comercial);
        getPerfilEditar("Agencias",response.comercial);
      }else{
        $('#campo_otroPerfil3').hide();
      } */
      /* if(response.perfil == "Coordinador"){
        $('#showCordinadorEditar').show();
          getPerfilEditar("Coordinador",response.idcoordinadordeadmin);
      }else{
        $('#showCordinadorEditar').hide();
      } */
      $("#editarComercial2").html(response.comercial);
      $(".idpadretraer").val(response.idpadre);
      $("#passwordActual").val(response.password);
  })
});

const getPerfilEditar = (perfil,data) => {
  DATA = new FormData();
  DATA.append("ACTION","GET_PERFIL");
  OBJECT_DATA = {
    perfil: perfil
  };
  DATA.append("DATA", JSON.stringify(OBJECT_DATA));
  app.callAjax('controladores/usuario.controlador.php', DATA, (response) => {
    if(response.PERFIL == "Agencias"){
      $('#capturarIdAgencia2').empty();
      $("#capturarIdAgencia2").append(`<option value="${data}">${data}</option>`);
      response.RESULT.map((user) => {
        $("#capturarIdAgencia2").append(
          `<option value="${user.usuario2}">${user.nombre}</option>`
          );
        });
      }
      if(response.PERFIL == "Coordinador"){
        $('#addcordinadoradminedit').empty();
        $("#addcordinadoradminedit").append('<option value="">Escoge El Coordinador</option>');
        response.RESULT.map((user) => {
          if(user.id == data){
            $("#addcordinadoradminedit").append(
              `<option value="${user.id}"selected>${user.nombre}</option>`
              );
            }else{
              $("#addcordinadoradminedit").append(
                `<option value="${user.id}">${user.nombre}</option>`
                );
            }
          });
        }
  })
}

$("#formEditar").validate({
  rules: {
    editarNombre: {required: true},
    editarCorreo: {required: true}
  },
  messages: {
    editarNombre: {required: "Este Campo Es Requerido"},
    editarCorreo: {required: "Este Campo Es Requerido"},
  },
  submitHandler: (form) => {
      DATA = new FormData();
      DATA.append("ACTION", "EDITAR_USER");
      OBJECT_DATA = {
        nombre: $("#editarNombre").val(),
        correo: $("#editarCorreo").val(),
        usuario2: $("#editarUsuario2").val(),
        perfil: $("#editarPerfil").val(),
        id: $("#editarIdUsuario").val(),
        nit: $("#editarNit").val(),
        comercial: $("#capturarIdAgencia2").val() == null ? '' : $("#capturarIdAgencia2").val(),
        idpadre: $(".idpadretraer").val(),
        passwordActual: $("#passwordActual").val(),
        password: $("#editarPassword").val(),
        idcoordinadordeadmin: $('#addcordinadoradminedit').val() == null ? '':$('#addcordinadoradminedit').val()
      }
      console.log(OBJECT_DATA);
      DATA.append("DATA", JSON.stringify(OBJECT_DATA));
      app.callAjax('controladores/usuario.controlador.php', DATA, (response) =>{
          if(response.RESULT){
              swal({
                  title: '¡Usuario Editado!',
                  text: response.MESSAGE,
                  type: 'success',
                  confirmButtonText: "¡Cerrar!"
                });
              $("#editarUsuario").modal("hide");
              setTimeout(()=>window.location.reload(),1000)
          }else{
              swal({
                  title: '¡Alerta!',
                  text: response.MESSAGE,
                  type: 'error',
                  confirmButtonText: "¡Cerrar!"
                });
              $("#editarUsuario").modal("hide");
          }
      });
     
  } 
})

$(document).on("click",".btnEliminarUsuario", function(){
  const id = $(this).attr("idUsuario")
  swal({
    title: '¿Está seguro de borrar el usuario?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar usuario!'
  }).then(function(result){
  
    if(result.value){
      DATA = new FormData();
      DATA.append("ACTION","ELIMINAR_USER");
      OBJECT_DATA = {
        id: id,
        estado: 2
      };
      DATA.append("DATA", JSON.stringify(OBJECT_DATA));
      app.callAjax('controladores/usuario.controlador.php', DATA, (response) => {
        setTimeout(()=>window.location.reload(),1000)
      })
    }
  
  })
    
});


