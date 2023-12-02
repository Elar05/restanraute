// Load table
function loadTable() {
    $("#table_categoria").DataTable({
        destroy: true,
        ajax: {
            type: "post",
            url: "categoria/list",
            data: {},
        },
    });
}

$(document).ready(function () {
    loadTable();
});

// Establecer la acción al agregar categoria -> create
$("#add_categoria").click(function () {
    $("#form_categoria")[0].reset();
    $("#action").val("create");
    $("#idcategoria").val("");
    $("#form_categoria").addClass("was-validated");

});

// Form categoria => create / update
$("#form_categoria").submit(function (e) {
    e.preventDefault();
    e.stopPropagation();

    var form = $(this);
    if (form[0].checkValidity()) {
        let data = form.serialize();
        let url = $("#action").val();
        $.post(
            `categoria/${url}`,
            data,
            function (data, textStatus, jqXHR) {
                if ("success" in data) {
                    iziToast.success({
                        title: "Éxito, ",
                        message: data.success,
                        position: "topCenter",
                        displayMode: 1,
                    });
                    $("#modal_categoria").modal("toggle");
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

// Llenar el form categoria
$(document).on("click", "button.edit", function () {
    $("#form_categoria")[0].reset();
    $("#action").val("edit");
    $("#modal_categoria").modal("toggle");
    let idcategoria = $(this).attr("idcategoria");
    $.post(
        `categoria/get`,
        { idcategoria },
        function (data, textStatus, jqXHR) {
            if ("categoria" in data) {
                $("#idcategoria").val(data.categoria.idCategoria);
                $("#nombre").val(data.categoria.nombre);
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
    let idcategoria = $(this).data("idcategoria"),
      estado = $(this).data("estado");
    $.post(
      `usuario/updateStatus`,
      { idcategoria, estado },
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
  