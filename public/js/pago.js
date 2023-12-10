// Load table
function loadTable() {
    $("#table_pago").DataTable({
      destroy: true,
      ajax: {
        type: "post",
        url: "pago/list",
        data: {},
      },
    });
  }
  
  $(document).ready(function () {
    loadTable();
  });
  
  // Establecer la acción al agregar pago -> create
  $("#add_pago").click(function () {
    $("#form_pago")[0].reset();
    $("#action").val("create");
    $("#idPago").val("");
  });
  
  // Form pago => create / update
  $("#form_pago").submit(function (e) {
    e.preventDefault();
  
    let form = $(this);
    if (form[0].checkValidity()) {
      let data = form.serialize();
      let url = $("#action").val();
      $.post(
        `pago/${url}`,
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
            $("#modal_pago").modal("toggle");
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
  
  // Llenar el form pago
  $(document).on("click", "button.edit", function () {
    $("#form_pago")[0].reset();
    $("#action").val("edit");
    $("#modal_pago").modal("toggle");
    let idPago = $(this).attr("idPago");
    $.post(
      `pago/get`,
      { idPago },
      function (data, textStatus, jqXHR) {
        if ("pago" in data) {
          $("#idPago").val(data.pago.idPago);
          $("#nombre").val(data.pago.nombre);
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
    let idPago = $(this).data("idPago"),
      estado = $(this).data("estado");
    $.post(
      `pago/updateStatus`,
      { idPago, estado },
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
  