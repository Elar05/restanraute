// Load table
function loadTable() {
  $("#table_tipousuario").DataTable({
    destroy: true,
    ajax: {
      type: "post",
      url: "tipousuario/list",
      data: {},
    },
  });
}

$(document).ready(function () {
  loadTable();
});

// Establecer la acción al agregar tipousuario -> create
$("#add_tipousuario").click(function () {
  $("#form_tipousuario")[0].reset();
  $("#action").val("create");
  $("#idTipo").val("");
});

// Form tipousuario => create / update
$("#form_tipousuario").submit(function (e) {
  e.preventDefault();

  let form = $(this);
  if (form[0].checkValidity()) {
    let data = form.serialize();
    let url = $("#action").val();
    $.post(
      `tipousuario/${url}`,
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
          $("#modal_tipousuario").modal("toggle");
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

// Llenar el form tipousuario
$(document).on("click", "button.edit", function () {
  $("#form_tipousuario")[0].reset();
  $("#action").val("edit");
  $("#modal_tipousuario").modal("toggle");
  let idTipo = $(this).attr("idTipo");
  $.post(
    `tipousuario/get`,
    { idTipo },
    function (data, textStatus, jqXHR) {
      if ("tipousuario" in data) {
        $("#idTipo").val(data.tipousuario.idTipo);
        $("#nombre").val(data.tipousuario.nombre);
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
  let idTipo = $(this).data("idtipo"),
    estado = $(this).data("estado");
  $.post(
    `tipousuario/updateStatus`,
    { idTipo, estado },
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

// Mostrar los permisos/vistas
$(document).on("click", "button.permisos", function () {
  $(".vista").prop("checked", false);
  let idTipo = $(this).data("idtipo");
  $("#idTipo").val(idTipo);
  $("#modal_vistas").modal("toggle");
  $.post(
    "permiso/get",
    { idTipo },
    function (data, textStatus, jqXHR) {
      if ("permisos" in data) {
        const { permisos } = data;
        if (permisos.length > 0) {
          let vistas = $(".vista");
          for (let i = 0; i < vistas.length; i++) {
            const checkboxValue = Number(vistas[i].value);
            if (permisos.includes(checkboxValue)) {
              vistas[i].checked = true;
            }
          }
        }
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

$(document).on("click", "input.vista", function () {
  let vista = $(this).val(),
    idTipo = $("#idTipo").val();
  $.post(
    "permiso/store",
    {
      vista,
      idTipo,
    },
    function (data, textStatus, jqXHR) {
      if ("success" in data) {
        iziToast.success({
          title: "Éxito, ",
          message: data.success,
          position: "topCenter",
          displayMode: 2,
        });
      } else {
        iziToast.error({
          title: "Error, ",
          message: data.error,
          position: "topCenter",
          displayMode: 2,
        });
      }
    },
    "json"
  );
});
