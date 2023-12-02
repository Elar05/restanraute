// Load table
function loadTable() {
  $("#table_usuario").DataTable({
    destroy: true,
    ajax: {
      type: "post",
      url: "usuario/list",
      data: {},
    },
  });
}

$(document).ready(function () {
  loadTable();
});

// Establecer la acción al agregar usuario -> create
$("#add_usuario").click(function () {
  $("#form_usuario")[0].reset();
  $("#action").val("create");
  $("#idUsuario").val("");
});

// Form usuario => create / update
$("#form_usuario").submit(function (e) {
  e.preventDefault();

  let form = $(this);
  if (form[0].checkValidity()) {
    let data = form.serialize();
    let url = $("#action").val();
    $.post(
      `usuario/${url}`,
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
          $("#modal_usuario").modal("toggle");
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

// Llenar el form usuario
$(document).on("click", "button.edit", function () {
  $("#form_usuario")[0].reset();
  $("#action").val("edit");
  $("#password").removeAttr("required");
  $("#modal_usuario").modal("toggle");
  let idUsuario = $(this).attr("idUsuario");
  $.post(
    `usuario/get`,
    { idUsuario },
    function (data, textStatus, jqXHR) {
      if ("user" in data) {
        $("#idUsuario").val(data.user.idUsuario);
        $("#tipo").val(data.user.idtipo);
        $("#nombres").val(data.user.nombres);
        $("#email").val(data.user.email);
        $("#telefono").val(data.user.telefono);
        $("#direccion").val(data.user.direccion);
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
  let idUsuario = $(this).data("idusuario"),
    estado = $(this).data("estado");
  $.post(
    `usuario/updateStatus`,
    { idUsuario, estado },
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
