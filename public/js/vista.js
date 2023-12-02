// Load table
function loadTable() {
  $("#table_vista").DataTable({
    destroy: true,
    ajax: {
      type: "post",
      url: "vista/list",
      data: {},
    },
  });
}

$(document).ready(function () {
  loadTable();
});

// Establecer la acción al agregar vista -> create
$("#add_vista").click(function () {
  $("#form_vista")[0].reset();
  $("#action").val("create");
});

// Form vista => create / update
$("#form_vista").submit(function (e) {
  e.preventDefault();
  e.stopPropagation();

  var form = $(this);
  if (form[0].checkValidity()) {
    let data = form.serialize();
    let url = $("#action").val();
    $.post(
      `vista/${url}`,
      data,
      function (data, textStatus, jqXHR) {
        if ("success" in data) {
          iziToast.success({
            title: "Éxito, ",
            message: data.success,
            position: "topCenter",
            displayMode: 1,
          });
          $("#modal_vista").modal("toggle");
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
  }

  form.addClass("was-validated");
});

// Llenar el form vista
$(document).on("click", "button.edit", function () {
  $("#form_vista")[0].reset();
  $("#action").val("edit");
  $("#modal_vista").modal("toggle");
  let id = $(this).attr("id");
  $.post(
    `vista/get`,
    { id },
    function (data, textStatus, jqXHR) {
      if ("vista" in data) {
        $("#id").val(data.vista.id);
        $("#nombre").val(data.vista.nombre);
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
$(document).on("click", "button.delete", function () {
  let id = $(this).attr("id");
  swal({
    title: "¿Seguro de querer eliminar?",
    text: "",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      $.post(
        `vista/delete`,
        { id },
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
    }
  });
});
