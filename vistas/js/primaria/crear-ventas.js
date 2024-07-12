$(document).ready(() => {
  getRangoVentasFechasPlanes();
  validator();
});

$(document).on("change", "#tipoSimCard", function (event) {
  const tipoSimSelect = $("#tipoSimCard option:selected").val();
  $("#plan").hide();
  $("#description").hide();
  $("#priceDesc").hide();

  if (tipoSimSelect === "F") {
    $("#simcard").show();
    $("#destinos").show();
    getDestinoSimSelect("F");
  } else if (tipoSimSelect === "E") {
    $("#destinos").show();
    $("#simcard").hide();
    getDestinoSimSelect("E");
  } else {
    $("#simcard").hide();
    $("#destinos").hide();
  }
});

$(document).on("change", "#destinosCargados", function () {
  const destinoPlanSelect = $("#destinosCargados option:selected").val();
  const tipoSimSelect = $("#tipoSimCard option:selected").val();
  $("#plan").show();
  $("#tipoPlan").empty();

  DATA = new FormData();
  DATA.append("ACTION", "GET_DESTINO_PLAN");
  OBJECT_DATA = {
    destination: destinoPlanSelect,
    typeSimCard: tipoSimSelect,
  };
  DATA.append("DATA", JSON.stringify(OBJECT_DATA));
  app.callAjax("controladores/planes.controlador.php", DATA, (response) => {
    $("#tipoPlan").append('<option value="">Escoge El Tipo De Plan</option>');
    response.map((plan) => {
      $("#tipoPlan").append(
        `<option value="${plan.tipodeplan}">${plan.tipodeplan}</option>`
      );
    });
  });
});

$(document).on("change", "#tipoPlan", function (event) {
  const simCart = $("#tipoSimCard option:selected").val();
  const destino = $("#destinosCargados option:selected").val();
  const plan = $("#tipoPlan option:selected").val();

  DATA.append("ACTION", "GET_DESCRIPTION_AND_PRICE");
  OBJECT_DATA = {
    typeSimCard: simCart,
    destination: destino,
    plan: plan,
  };
  DATA.append("DATA", JSON.stringify(OBJECT_DATA));
  app.callAjax("controladores/planes.controlador.php", DATA, (response) => {
    $("#description").show();
    $("#textDescription").val(response.descripcion);
    $("#priceDesc").show();
    $("#price").val(`${response.preciodolares} USD`);
  });
});

$(document).on("change", "#fechaSalida", function (event) {
  console.log();
  if (!$("#fechaRegreso").prop("disabled")) {
    $("#fechaRegreso").val("");
    $("#fechaRegreso").prop("min", $("#fechaSalida").val());
  } else {
    $("#fechaRegreso").prop("min", $("#fechaSalida").val());
    $("#fechaRegreso").prop("disabled", false);
  }
});

$(document).on("change", "#fileImgImei", function (event) {
  const {status, extension} = validarExtension(this,".png, .gif, .jpeg, .jpg, .pdf");
  if (status) {
    extension == "pdf" ? $("#showImghide").hide() : loadImg(this, "showImg");
    $("#msgValidImg").hide();
    clearInterval();
  } else {
    $("#msgValidImg").show();
    $("#showImghide").hide();
    $("#fileImgImei").val("");
    setInterval(() => {
      $("#msgValidImg").hide();
    }, 3000);
  }
});

$(document).on("change", "#fileSimcard", function (event) {
  const {status, extension} = validarExtension(this,".png, .gif, .jpeg, .jpg");
  if (status) {
    loadImg(this, "showSimCard");
    $("#msgValidImgSim").hide();
  } else {
    $("#msgValidImgSim").show();
    $("#showSimCardhide").hide();
    $("#fileSimcard").val("");
  }
});

$(document).on("change", "#filePasaporte", function (event) {
  const {status, extension} = validarExtension(this,".png, .gif, .jpeg, .jpg, .pdf");
  if (status) {
    if(extension == "pdf"){
       $("#showImgPashide").hide();
      }else{
        loadImg(this, "showImgPas"); 
      }
    $("#msgValidPas").hide();
    clearInterval();
  } else {
    $("#msgValidPas").show();
    $("#showImgPashide").hide()
    $("#filePasaporte").val("");
    setInterval(() => {
      $("#msgValidPas").hide();
    }, 3000);
  }
});

$(document).on("click", "btnCrearVenta", function (event) {
  event.preventdefault();
});

const loadImg = (input, id) => {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = (e) => {
      $(`#${id} + img`).remove();
      $(`#${id}`).after(
        `<img src="${e.target.result}" width="120" height="80" id="${id}hide" />`
      );
    };
    reader.readAsDataURL(input.files[0]);
  }
};

const validarExtension = (datos,extensionesValidas) => {
  const ruta = datos.value;
  const extension = ruta.substring(ruta.lastIndexOf(".") + 1).toLowerCase();
  const extensionValida = extensionesValidas.indexOf(extension);

  if (extensionValida < 0) {
    return {
      status: false,
      extension
    };
  } else {
    return {
      status: true,
      extension
    };
  }
};

const getDestinoSimSelect = (value) => {
  $("#destinosCargados").empty();
  DATA = new FormData();
  DATA.append("ACTION", "GET_DESTINO_SIM");
  OBJECT_DATA = { typeSimCard: value };
  DATA.append("DATA", JSON.stringify(OBJECT_DATA));
  app.callAjax("controladores/planes.controlador.php", DATA, (response) => {
    $("#destinosCargados").append(
      '<option value="">Escoge el destino</option>'
    );
    response.map((destino) => {
      $("#destinosCargados").append(
        `<option value="${destino.destino}">${destino.nombre_destino}</option>`
      );
    });
  });
};

const validator = () => {
  $.validator.addMethod(
    "emailWithDot",
    function (value, element) {
      return (
        this.optional(element) ||
        /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value)
      );
    },
    "Por favor, introduce un correo electrónico válido"
  );

  $.validator.addMethod(
    "exactLength",
    function (value, element, param) {
      return this.optional(element) || value.length === param;
    },
    "Número de teléfono inválido"
  );
};

const rules = {
  nuevoCliente: { required: true },
  nuevoCelular: {
    required: true,
    exactLength: 10,
    number: true,
  },
  nuevoCorreo: {
    required: true,
    emailWithDot: true,
    email: true,
  },
  nuevoPasaporte: { required: false },
  imei: { required: true },
  tipoSimCard: { required: true },
  nuevoDestino: { required: true },
  tipoPlan: { required: true },
  textDescription: { required: false },
  price: { required: false },
  nuevoSimCard: { required: false },
  fechaSalida: { required: true },
  fechaRegreso: { required: true },
  fechaVenta: { required: true },
};

const messages = {
  nuevoCliente: { required: "Nombre Requerido" },
  nuevoCelular: {
    required: "Numero De Telefono Requerido",
    exactLength: "Número de teléfono inválido",
    number: "Por favor, introduce un valor numérico",
  },
  nuevoCorreo: {
    required: "Email Requerido",
    emailWithDot: "Por favor, introduce un correo electrónico válido",
    email: "Por favor, introduce un correo electrónico válido",
  },
  tipoSimCard: { required: "Tipo De SimCard Requerida" },
  nuevoDestino: { required: "Destino Requerido" },
  tipoPlan: { required: "Plan Requerido" },
  fechaSalida: { required: "Fecha De Salida Requerida" },
  fechaRegreso: { required: "Fecha De Regreso Requerida" },
  fechaVenta: { required: "Fecha De Venta Requerida" },
  imei: { required: "Imei Requerido" },
};

$("#crearVenta").validate({
  rules: rules,
  messages: messages,
  submitHandler: (form) => {
    $("#btnCrearVenta").hide();
    $(".return").attr("disabled",true);
    $("#loading").show();
    OBJECT_DATA = {
      nuevoCliente: $("#nuevoCliente").val(),
      nuevoVendedor: $("#nuevoVendedor").val(),
      tipoPlan: $("#tipoPlan").val(),
      fechaSalida: $("#fechaSalida").val(),
      fechaRegreso: $("#fechaRegreso").val(),
      fechaVenta: $("#fechaVenta").val(),
      observacion: $("#observaciontext").val(),
      price: $("#price").val(),
      estado: 'desactivado',
      agrego: $("#nuevoAgrego").val(),
      nuevoCelular: $("#nuevoCelular").val(),
      nuevoCorreo: $("#nuevoCorreo").val(),
      agregoPadre: $("#nuevoAgregoPadre").val(),
      destinosCargados: $("#destinosCargados").val(),
      destino: $("#destinosCargados option:selected").text(),
      horaIngreso: new Date().getHours(),
      horaCieere: $("#nuevoCierreHora").val(),
      coordinador: $("#nuevoCoordinador").val(),
      textDescription: $("#textDescription").val(),
      tipoSimCard: $("#tipoSimCard").val(),
    };
    DATA = new FormData();
    DATA.append("ACTION", "CREATE_VENTA");
    DATA.append("IMEI", $("#fileImgImei")[0].files[0]);
    DATA.append("SIM", $("#fileSimcard")[0].files[0]);
    DATA.append("PASAPORTE", $("#filePasaporte")[0].files[0]);
    DATA.append("DATA", JSON.stringify(OBJECT_DATA));
    app.callAjax(
      "controladores/crear-venta.controlador.php",
      DATA,
      (response) => {
        if (response.RESULT) {
           $("#loading").hide();
          swal({
            title: "¡Venta Creada!",
            text: response.MESSAGE,
            type: "success",
            confirmButtonText: "¡Cerrar!",
          }).then(function (result) {
            if (result.value) {
              $("#btnCrearVenta").show();
              $(".return").attr("disabled",false);
            } else {
              $("#btnCrearVenta").show();
              $(".return").attr("disabled",false);
            }
          });
          clearInput();
        } else {
          swal({
            title: "¡Alerta!",
            text: response.MESSAGE,
            type: "error",
            confirmButtonText: "¡Cerrar!",
          });
        }
      }
    );
  },
});

const clearInput = () => {
  $("#nuevoCliente").val("");
  $("#fileSimcard").val("");
  $("#tipoPlan").val("");
  $("#fechaSalida").val("");
  $("#fechaRegreso").val("");
  $("#fileImgImei").val("");
  $("#observaciontext").val("");
  $("#price").val("");
  $("#nuevoEstado").val("");
  $("#nuevoCelular").val("");
  $("#nuevoCorreo").val("");
  $("#nuevoPasaporte").val("");
  $("#textDescription").val("");
  $("#tipoSimCard").val("");
  $("#filePasaporte").val("");

  $("#plan").hide();
  $("#description").hide();
  $("#priceDesc").hide();
  $("#simcard").hide();
  $("#destinos").hide();

  $("#showImghide").hide();
  $("#showSimCardhide").hide();
  $("#showImgPashide").hide();
};

const addButtonImg = (url, title) => {
  if (url == "") {
    return `${title} No Agregada`;
  } else {
    return `<button class="btn btn-info btn-xs verImg" data-toggle="modal" imgSrc='${url}' data-target="#verImg">Ver ${title}</button>`;
  }
};

const getRangoVentasFechasPlanes = () => {
  DATA = new FormData();
  DATA.append("ACTION", "RANGO_FECHA_VENTA");

  OBJECT_DATA = {
    perfil: $("#perfil").val(),
    fechaInicial: $("#fechaInicial").val(),
    fechaFinal: $("#fechaFinal").val(),
    sessionUser: $("#sessionUser").val(),
    sessionId: $("#sessionId").val(),
  };
  DATA.append("DATA", JSON.stringify(OBJECT_DATA));
  app.callAjax(
    "controladores/crear-venta.controlador.php",
    DATA,
    (response) => {
      const dataArray = [];
      if (
        $("#perfil").val() == "Administrador" ||
        $("#perfil").val() == "Coordinador"
      ) {
        response.map((venta, index) => {
          dataArray[index] = [
            index + 1,
            venta.codigo,
            venta.cliente,
            venta.vendedor,
            venta.celular,
            venta.destino,
            venta.tipoplan,
            venta.valor,
            venta.fechallegada,
            addButtonImg(venta.simcard, "Simcard"),
            addButtonImg(venta.imei, "Imei"),
            addButtonDescripcion(venta.descripcion, venta.observacion),
            actionTable(venta.id, venta.estado),
          ];
        });
      } else {
        response.map((venta, index) => {
          dataArray[index] = [
            index + 1,
            venta.codigo,
            venta.vendedor,
            venta.celular,
            venta.destino,
            venta.tipoplan,
            venta.valor,
            venta.fechallegada,
            addButtonImg(venta.simcard, "Simcard"),
            addButtonImg(venta.imei, "Imei"),
            addButtonDescripcion(venta.descripcion, venta.observacion),
            actionTable(venta.id, venta.estado),
          ];
        });
      }

      $("#tablePlanesVenta").DataTable({
        language: {
          lengthMenu: "Mostrar _MENU_ registros",
          zeroRecords: "No se encontraron resultados",
          info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
          infoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
          infoFiltered: "(filtrado de un total de _MAX_ registros)",
          sSearch: "Buscar:",
          oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior",
          },
        },
        //codigo nuevo
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'excel', title: 'Ventas'},

            {extend: 'print',
             customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
            }
            }
        ],
        //hasta aqui
        data: dataArray,
        columns: showColumn($("#perfil").val()),
      });
    }
  );
};

const addButtonDescripcion = (descripcion, observacion) => {
  return `
      <div class="btn-group" style="display: flex; justify-content: center">
        <button 
          class="btn btn-info btn-xs verDes" 
          type="button"
          data-toggle="modal" 
          data-target="#verDes"
          descripcion="${descripcion}"
          observacion="${observacion}"
        >Ver</button>
      </div>
  `;
};

$(document).on("click", ".verDes", function () {
  $("#contentdesc").text($(this).attr("descripcion"));
  $("#contentobser").text($(this).attr("observacion"));
});

const showColumn = (perfil) => {
  if (perfil == "Administrador" || perfil == "Coordinador") {
    return [
      { title: "#" },
      { title: "Código" },
      { title: "Cliente" },
      { title: "Pasajero" },
      { title: "Celular" },
      { title: "Destino" },
      { title: "Tipo de plan" },
      { title: "Valor" },
      { title: "Fecha de llegada" },
      { title: "SimCard" },
      { title: "imei" },
      { title: "Observación" },
      { title: "Acciones" },
    ];
  } else {
    return [
      { title: "#" },
      { title: "Código" },
      { title: "Pasajero" },
      { title: "Celular" },
      { title: "Destino" },
      { title: "Tipo de plan" },
      { title: "Valor" },
      { title: "Fecha de llegada" },
      { title: "SimCard" },
      { title: "imei" },
      { title: "Observación" },
      { title: "Acciones" },
    ];
  }
};

$(document).on("click", ".verImg", function () {
  $("#modalImg").attr("src", $(this).attr("imgSrc"));
});

const actionTable = (id, estado) => {
  if (estado == "Anulada") {
    /* return `
      <div class="btn-group" style="display: flex; justify-content: center">
        <button 
          class="btn btn-warning" 
          type="button"
          disabled
        >
          <i class="fa fa-ban" aria-hidden="true"></i>
        </button>
      </div>`; */
    return `
        <button 
          class="btn btn-success btnEditarVentas" 
          type="button" 
          idVenta="${id}" 
          disabled
        >
          <i class="fa fa-info" aria-hidden="true"></i>
        </button>
      </div>
      `;
  } else {
    return `
      <div class="btn-group" style="display: flex; justify-content: center">
        <button 
          class="btn btn-primary btnAnularVentas"
          idVenta="${id}" 
          type="button"
        >
          <i class="fa fa-ban" aria-hidden="true"></i>
        </button>
        <button 
          class="btn btn-success btnEditarVentas" 
          type="button" 
          idVenta="${id}" 
        >
          <i class="fa fa-info" aria-hidden="true"></i>
        </button>
      </div>
      `;
  }
  {
    /* 
      <button 
        class="btn btn-danger btnEliminarVentas" 
        type="button" 
        id="${id}" 
        simcards="${simcard}"
      >
        <i class="fa fa-times" aria-hidden="true"></i>
      </button>
    </div> */
  }
};

$(document).on("click", ".btnAnularVentas", function () {
  const id = $(this).attr("idVenta");
  $(".btnAnularVentas").hide();
  swal({
    title: "¿Deseas Anular Esta venta?",
    text: "¡No podrás revertir esto!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Sí, Anular!",
  }).then(function (result) {
    if (result.value) {
      DATA = new FormData();
      DATA.append("ACTION", "ANULAR_VENTA");
      OBJECT_DATA = {
        id: id,
        estado: "Anulada",
      };
      DATA.append("DATA", JSON.stringify(OBJECT_DATA));
      app.callAjax(
        "controladores/crear-venta.controlador.php",
        DATA,
        (response) => {
          $(".btnAnularVentas").show();
          window.location = "ventas";
        }
      );
    }
  });
});

/* $("#tablePlanesVenta").on("click", ".btnImprimirFactura", function () {
  var codigo = $(this).attr("codigo");
  window.open("extensiones/tcpdf/pdf/facturaVenta.php?codigo=" + codigo, "_blank");
}); */

$("#tablePlanesVenta").on("click", ".btnEditarVentas", function () {
  var idVenta = $(this).attr("idVenta");
  window.location = "index.php?ruta=editar-ventas&idVenta=" + idVenta;
});

$(document).on("click", ".btnEliminarVentas", function () {
  const id = $(this)[0].id;
  swal({
    title: "¿Deseas Eliminar Esta venta?",
    text: "¡No podrás revertir esto!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Sí, Borrarlo!",
  }).then(function (result) {
    if (result.value) {
      DATA = new FormData();
      DATA.append("ACTION", "ELIMINAR_VENTA");
      OBJECT_DATA = { id: id };
      DATA.append("DATA", JSON.stringify(OBJECT_DATA));
      app.callAjax(
        "controladores/crear-venta.controlador.php",
        DATA,
        (response) => {
          if (response.RESULT) {
            swal({
              type: "success",
              title: "La venta ha sido borrada correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
            }).then(function (result) {
              if (result.value) {
                window.location = "ventas";
              }
            });
          }
        }
      );
    }
  });
});
