export const URL_BASE = "http://localhost/restaurante";

export function getDataSelect(select, url = "", data = "") {
  $(`#${select}`).empty();
  $(`#${select}`).append(
    `<option value="" selected disabled>__ Seleccione __</option>`
  );

  if (url != "" && data != "") {
    $.ajax({
      type: "post",
      url,
      data,
      dataType: "json",
      success: function (response) {
        if ("data" in response) {
          response.data.forEach((item) => {
            $(`#${select}`).append(
              `<option value="${item.id}">${item.nombre}</option>`
            );
          });
        }
      },
      error: function (error) {
        console.error("Error en la solicitud AJAX: " + error);
      },
    });
  }
}

export function getCliente(data, callback) {
  $.ajax({
    type: "post",
    url: `${URL_BASE}/cliente/get`,
    data,
    dataType: "json",
    success: function (response) {
      callback(response);
    },
    error: function (error) {
      console.error("Error en la solicitud AJAX: " + error);
    },
  });
}