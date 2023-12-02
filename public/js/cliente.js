// Load table
function loadTable() {
    $("#tablaClientes").DataTable({
      destroy: true,
      ajax: {
        type: "post",
        url: "cliente/list",
        data: {},
      },
    });
  }
  
  $(document).ready(function () {
    loadTable();
  });
  
  // Establecer la acción al agregar cliente -> create
  $("#add_cliente").click(function () {
    $("#form_cliente")[0].reset();
    $("#action").val("create");
    $("#idcliente").val("");
  });
  
  // Form cliente => create / update
  $("#form_cliente").submit(function (e) {
    e.preventDefault();
  
    let form = $(this);
    if (form[0].checkValidity()) {
      let data = form.serialize();
      let url = $("#action").val();
      $.post(
        `cliente/${url}`,
        data,
        function (data, textStatus, jqXHR) {
          if ("success" in data) {
            iziToast.success({
              title: "Éxito, ",
              message: data.success,
              position: "topCenter",
              displayMode: 1,
            });
            loadTable();
            $("#modal_cliente").modal("toggle");
          } else {
            iziToast.error({
              title: "Error, ",
              message: data.error,
              position: "topCenter",
              displayMode: 1,
            });
          }
        },
        "json"
      );
    }
  
    form.addClass("was-validated");
  });
  
  // Llenar el form cliente
  $(document).on("click", "button.edit", function () {
    $("#form_cliente")[0].reset();
    $("#action").val("edit");
    $("#password").removeAttr("required");
    $("#modal_cliente").modal("toggle");
    let idcliente = $(this).attr("idcliente");
    $.post(
      `cliente/get`,
      { idcliente },
      function (data, textStatus, jqXHR) {
        if ("cliente" in data) {
          $("#idcliente").val(data.cliente.idCliente);
          $("#documento").val(data.cliente.documento);
          $("#nombres").val(data.cliente.nombres);
          $("#email").val(data.cliente.email);
          $("#telefono").val(data.cliente.telefono);
          $("#direccion").val(data.cliente.direccion);
        } else {
          iziToast.error({
            title: "Error, ",
            message: data.error,
            position: "topCenter",
            displayMode: 1,
          });
        }
      },
      "json"
    );
  });
  
  // Cambiar estado
  $(document).on("click", "button.estado", function () {
    let idcliente = $(this).data("idcliente"),
      estado = $(this).data("estado");
    $.post(
      `cliente/updateStatus`,
      { idcliente, estado },
      function (data, textStatus, jqXHR) {
        if ("success" in data) {
          iziToast.success({
            title: "Éxito, ",
            message: data.success,
            position: "topCenter",
            displayMode: 1,
          });
          loadTable();
        } else {
          iziToast.error({
            title: "Error, ",
            message: data.error,
            position: "topCenter",
            displayMode: 1,
          });
        }
      },
      "json"
    );
  });
  