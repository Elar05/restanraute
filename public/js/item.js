// Load table
function loadTable() {
    $("#table_item").DataTable({
      destroy: true,
      ajax: {
        type: "post",
        url: "item/list",
        data: {},
      },
    });
  }
  
  $(document).ready(function () {
    loadTable();
  });
  
  // Establecer la acción al agregar item -> create
  $("#add_item").click(function () {
    $("#form_item")[0].reset();
    $("#action").val("create");
    $("#idItem").val("");
    $("#img").empty(); //limpiar div
  });
  
  // Form item => create / update
  $("#form_item").submit(function (e) {
    e.preventDefault();
  
    let form = $(this);
    if (form[0].checkValidity()) {
      let data = new FormData(form[0]);
      let url = $("#action").val();

      $.ajax({
        type: "post",
        url: `item/${url}`,
        data,
        contentType: false,
        processData: false,
        success: function (data) {
          data = JSON.parse(data);
          if ("success" in data) {
            iziToast.success({
              title: "Éxito, ",
              message: data.success,
              position: "topCenter",
              displayMode: 1,
            });
            loadTable();
            $("#modal_item").modal("toggle");
          } else {
            iziToast.error({
              title: "Error, ",
              message: data.error,
              position: "topCenter",
              displayMode: 1,
            });
          }
        },
      });

    }
    form.addClass("was-validated");
  });
  
  // Llenar el form item
  $(document).on("click", "button.edit", function () {
    $("#form_item")[0].reset();
    $("#action").val("edit");
    $("#modal_item").modal("toggle");
    let idItem = $(this).attr("idItem");
    $.post(
      `item/get`,
      { idItem },
      function (data, textStatus, jqXHR) {
        if ("item" in data) {
          $("#idItem").val(data.item.idItem);
          $("#idcategoria").val(data.item.idcategoria);
          $("#tipo").val(data.item.tipo);
          $("#precio_c").val(data.item.precio_c);
          $("#precio_v").val(data.item.precio_v);
          $("#stock").val(data.item.stock);
          $("#stock_min").val(data.item.stock);
          $("#descripcion").val(data.item.stock);
          $("#f_registro").val(data.item.stock);
          $("#estado").val(data.item.stock);
          $("#urlfoto").val(data.item.foto);
          $("#img").empty(); //limpiar div
          $("#img").append(`
          <img src="${data.item.foto}" alt="" width="50">`);
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
    let idItem = $(this).data("idItem"),
      estado = $(this).data("estado");
    $.post(
      `item/updateStatus`,
      { idItem, estado },
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

  $(document).on("click", "button.img", function () {
    let foto = $(this).attr("foto");
    console.log(foto);
    $("#body_img").empty();
    $("#body_img").append(`<img src="${foto}" class='img-fluid'>`);
    $("#modal_img").modal("toggle");
  });
  
  