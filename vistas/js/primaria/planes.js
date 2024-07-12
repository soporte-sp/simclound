$(document).ready(() => {
    getTablePlans();
    getDestinations();
});

const getDestinations = () => {
   DATA = new FormData();
   DATA.append("ACTION","GET_DESTINATION");
   app.callAjax('controladores/planes.controlador.php', DATA, (response) => {
        response.map((destino) => {
          $("#destino").append(
            `<option value="${destino.id}">${destino.nombre_destino}</option>`
          );
        });
   });
};

//modalDescription
$(document).on('click','.verDescripcion', function(){
    $("#modalDescription").text($(this).attr("descri"));
})

const showDescription = (descripcion) => {
    return `
    <div class="btn-group">
        <button 
            class="btn btn-default btn-xs verDescripcion" 
            data-toggle="modal" 
            data-target="#verDescripcion"
            descri="${descripcion}"
        >Ver Descripción</button> 
    </div>
    `
}

const getTablePlans = () => {
    DATA = new FormData();
    DATA.append("ACTION","GET_TABLE_PLANS");
    app.callAjax('controladores/planes.controlador.php', DATA, (response) => {
        let arrayData = [];
        response.map((plan, index) => {
            let tipoP = plan.tiposimcard == 'E' ? 'E-Sim': 'Física'
            arrayData[index] = 
                [index+1,
                 tipoP,
                 plan.destino,
                 plan.tipodeplan,
                 `${plan.preciodolares} USD`,
                 showDescription(plan.descripcion),
                 plan.codigointerno,
                 statusPlans(plan.estado, plan.id),
                 actionPlans(plan.estado,plan.id)]
        })
            $("#showPlans").DataTable({
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
                    {title: 'Tipo De SimCard'},
                    {title: 'Destino'},
                    {title: 'Tipo De Plan'},
                    {title: 'Precio En Dolar'},
                    {title: 'Descripcion'},
                    {title: 'Codigo Interno'},
                    {title: 'Estado'},
                    {title: 'Acciones'},
                ],
            })
        
    });
}

const actionPlans = (estado,id) => {
    if(estado == 2){
        return `
        <div class="btn-group">
            <button 
            class="btn btn-warning" 
            type="button" 
            disabled
        ><i class="fa fa-edit" aria-hidden="true"></i>
        </button>
        <button 
            class="btn btn-danger" 
            type="button"
            disabled
        ><i class="fa fa-times" aria-hidden="true"></i>
        </button>
        </div>`;
    }else{
        return ` 
        <div class="btn-group">
        <button 
        id="${id}"
        class="btn btn-warning showEditPlan" 
        type="button" 
        data-toggle="modal"
        data-target="#EditPlans"
        >
        <i class="fa fa-edit" aria-hidden="true"></i>
        </button>
        <button 
        id="${id}"
        class="btn btn-danger showDeletePlan" 
        type="button"
        >
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        </div>`;
    }
}

const statusPlans = (estado, id) => {
    if(estado == 0){
        return `<button class="btn btn-success btn-xs activatePlan" id="${id}" status="1">Activado</button> `;
    }
    if(estado == 1){
        return `<button class="btn btn-warning btn-xs activatePlan" id="${id}" status="0">Desactivado</button> `;
    }
    if(estado == 2){
        return `<button class="btn btn-danger btn-xs activatePlan" disabled>Eliminado</button> `;
    }
}

const clearInput = () => {
    $('#tipoDeSimcard').val("");
    $('#destino').val("");
    $('#tipoPlan').val("");
    $('#preciodolares').val("");
    $('#descripcion').val("");
}

$("#formCreatePlans").validate({
    rules: {
        tipoDeSimcard: { required: true },
        destino: { required: true },
        tipoPlan: { required: true },
        preciodolares: { required: true,min: 1,max: 10000 },
        descripcion: { required: true },
        codigointerno: { required: true }
    },
    messages: {
        tipoDeSimcard: {required: "Por Favor Escoja Una Opcion"},
        destino: {required: "Por Favor Escoja Una Opcion"},
        tipoPlan: {required: "Este Campo Es Requerido"},
        preciodolares: { 
            required: "Este Campo Es Requerido",
            min: "El Valor Minimo Es De 1 USD",
            max: "El Valor Debe Se Menor A 10000 USD" 
        },
        codigointerno: { required: "Este Campo Es Requerido" },
        descripcion: { required: "Este Campo Es Requerido" }
    },
    submitHandler: (form) => {
        DATA = new FormData();
        DATA.append("ACTION", "INSERT");
        OBJECT_DATA = {
            typeSimCard: $('#tipoDeSimcard').val(),
            destination: $('#destino').val(),
            typeDestination: $('#tipoPlan').val(),
            priceDollar: $('#preciodolares').val(),
            description: $('#descripcion').val(),
            internalCode: $('#codigointerno').val(),
            status: 0
        };
        DATA.append("DATA", JSON.stringify(OBJECT_DATA));
        app.callAjax('controladores/planes.controlador.php', DATA, (response) =>{
            if(response.RESULT){
                swal({
                    title: '¡Éxito!',
                    text: response.MESSAGE,
                    type: 'success',
                    confirmButtonText: "¡Cerrar!"
                  });
                  clearInput();
                $("#CrearPlanes").modal("hide");
                setTimeout(()=>window.location.reload(),1000)
            }else{
                swal({
                    title: '¡Alerta!',
                    text: response.MESSAGE,
                    type: 'error',
                    confirmButtonText: "¡Cerrar!"
                  });
            }
        });
    }
});

$(document).on('click','.showEditPlan', function(){
    DATA = new FormData();
    DATA.append("ACTION", "GET_PLAN");
    OBJECT_DATA = {
        idPlan: $(this).attr("id")
    };
    DATA.append("DATA", JSON.stringify(OBJECT_DATA));
    app.callAjax('controladores/planes.controlador.php', DATA, (res)=>{
        res.tiposimcard === "F" ? $('#editTipoDeSimcard option:selected').html("Física") : $('#editTipoDeSimcard option:selected').html("E-Sim");
        $('#editDestino option:selected').html(res.destino);
        $('#editTipoPlan').val(res.tipodeplan);
        $('#editPreciodolares').val(res.preciodolares);
        $('#editDescripcion').val(res.descripcion);
        $('#editCodigointerno').val(res.codigointerno);
        $('#idPlan').text(res.id)
    })
});

$(document).on('click','.showDeletePlan' , function(){
    const id = $(this).attr("id");
    swal({
        title: '¿Está seguro de borrar el plan?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar el plan!'
      }).then(function(result){
    
        if(result.value){
            DATA = new FormData();
            DATA.append("ACTION", "DELETE");
            OBJECT_DATA = { idPlan: id, status: 2 };
            DATA.append("DATA", JSON.stringify(OBJECT_DATA));
            app.callAjax('controladores/planes.controlador.php', DATA, (res)=>{
                
                if(res.RESULT){
                    swal({
                        title: '¡Éxito!',
                        text: res.MESSAGE,
                        type: 'success',
                        confirmButtonText: "¡Cerrar!"
                      });
                    window.location.reload();
                };
            });
        }
      })
})

$('#formEditPlans').validate({
    rules: {
        editTipoPlan: { required: true },
        editPreciodolares: { required: true,min: 1,max: 10000 },
        editDescripcion: { required: true },
        editCodigointerno: { required: true }
    },
    messages: {
        editTipoPlan: {required: "Este Campo Es Requerido"},
        editPreciodolares: { 
            required: "Este Campo Es Requerido",
            min: "El Valor Minimo Es De 1 USD",
            max: "El Valor Debe Se Menor A 10000 USD" 
        },
        editCodigointerno: { required: "Este Campo Es Requerido" },
        editDescripcion: { required: "Este Campo Es Requerido" }
    },
    submitHandler: (form) => {
        DATA = new FormData();
        DATA.append("ACTION", "EDIT");
        OBJECT_DATA = {
            typeDestination: $('#editTipoPlan').val(),
            priceDollar: $('#editPreciodolares').val(),
            description: $('#editDescripcion').val(),
            internalCode: $('#editCodigointerno').val(),
            idPlan: $('#idPlan').text(),
        };
        DATA.append("DATA", JSON.stringify(OBJECT_DATA));
        app.callAjax("controladores/planes.controlador.php",DATA, (response) => {
            if(response.RESULT){
                swal({
                    title: '¡Éxito!',
                    text: response.MESSAGE,
                    type: 'success',
                    confirmButtonText: "¡Cerrar!"
                  });
                $("#EditPlans").modal("hide");
                setTimeout(()=>window.location.reload(),1000)
            }else{
                swal({
                    title: '¡Alerta!',
                    text: response.MESSAGE,
                    type: 'error',
                    confirmButtonText: "¡Cerrar!"
                  });
            }
        })
    }
})

$(document).on('click','.activatePlan', function(){
    DATA = new FormData();
    DATA.append("ACTION", "ACTIVATE_PLANS");
    OBJECT_DATA = { idPlan: $(this).attr('id'), status: $(this).attr('status') };
    DATA.append("DATA", JSON.stringify(OBJECT_DATA));
    app.callAjax('controladores/planes.controlador.php', DATA, (res)=>{
        if(res.RESULT)window.location.reload();
    });
})

