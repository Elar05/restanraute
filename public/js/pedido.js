import { URL_BASE } from "./exports.js";

// Cargar tabla de pedidos
function loadTable() {
  $("#table_pedido").DataTable({
    destroy: true,
    ajax: {
      type: "post",
      url: "http://localhost/restaurante/pedido/list",
    },
  });
}

// Cargar tabla de productos
function loadTableItems() {
  $("#tableItems").DataTable({
    destroy: true,
    ajax: {
      type: "post",
      url: "http://localhost/restaurante/item/list",
      data: { filtro: 1 },
    },
  });
}

$(document).ready(function () {
  $("body").addClass("sidebar-mini");
  loadTableItems();
  loadTable();
});

$("#tipo").change(function () {
  if ($(this).val() == "local") {
    $("#group_delivery").addClass("d-none");
    $("#group_reserva").addClass("d-none");
  } else if ($(this).val() == "delivery") {
    $("#group_delivery").removeClass("d-none");
    $("#group_reserva").addClass("d-none");
  } else {
    $("#group_delivery").addClass("d-none");
    $("#group_reserva").removeClass("d-none");
  }
});

// Agregar detalle
$(document).on("click", "button.item", function (e) {
  e.preventDefault();
  let id = $(this).attr("idItem");
  let descripcion = $(this).attr("descripcion");
  let precio = $(this).attr("precio");
  let stock = $(this).attr("stock");

  // Buscar si ya existe una fila con el mismo ID
  let existingRow = $("#tbody_detalle").find(`tr[data-iditem='${id}']`);

  if (existingRow.length > 0) {
    // Si ya existe, aumentar la cantidad y recalcular el subtotal
    let cantidadInput = existingRow.find(".cantidad");
    let cantidad = parseInt(cantidadInput.val()) + 1;

    if (cantidad <= stock) {
      cantidadInput.val(cantidad);

      let precioInput = existingRow.find(".precio");
      let precio = parseInt(precioInput.val());

      let subtotalInput = existingRow.find(".subtotal");
      let subtotal = cantidad * precio;
      subtotalInput.val(subtotal);
    } else {
      iziToast.warning({
        title: "La cantidad excede el stock disponible",
        message: "",
        position: "topCenter",
        displayMode: 1,
      });
    }
  } else {
    $("#tbody_detalle").append(`
      <tr data-iditem='${id}'>
        <td>${descripcion}</td>
        <td><input type=number min=${precio} value='${precio}' class='form-control form-control-sm precio'></td>      
        <td><input type=number min=1 value=1 max=${stock} class='form-control form-control-sm cantidad'></td>
        <td><input type=number min=${precio} value='${precio}' class='form-control form-control-sm subtotal' readonly></td>
        <td><button class='btn btn-sm btn-danger deleteItem'><i class='fas fa-times'></td>
      </tr>
    `);
  }

  calcTotal();
});

// Calcular el subtotal al cambiar el precio
$(document).on("input", ".precio", function () {
  let precio = parseInt($(this).val());
  let cantidad = parseInt($(this).closest("tr").find(".cantidad").val());
  let subtotal = precio * cantidad;

  // Actualizar el valor del subtotal
  $(this).closest("tr").find(".subtotal").val(subtotal);

  calcTotal();
});

// Calcular el subtotal al cambiar la cantidad
$(document).on("input", ".cantidad", function () {
  let stock = $(this).attr("max");
  let cantidad = parseInt($(this).val());
  if (cantidad <= stock) {
    let precio = parseInt($(this).closest("tr").find(".precio").val());
    let subtotal = cantidad * precio;

    // Actualizar el valor del subtotal
    $(this).closest("tr").find(".subtotal").val(subtotal);
  } else {
    iziToast.warning({
      title: "La cantidad excede el stock disponible",
      message: "",
      position: "topCenter",
      displayMode: 1,
    });
    $(this).val(stock);
  }
  calcTotal();
});

// Calcular el subtotal al eliminar un proudcto del resumen
$(document).on("click", ".deleteItem", function () {
  // Actualizar el valor del subtotal
  $(this).closest("tr").remove();
  calcTotal();
});

// Función para calcular y actualizar el total
function calcTotal() {
  let items = [];
  let total = 0;

  // Iterar sobre todas las filas de la tabla
  $("#tbody_detalle tr").each(function () {
    let iditem = $(this).data("iditem");
    let cantidad = parseInt($(this).find(".cantidad").val());
    let precio = parseFloat($(this).find(".precio").val()) || 0;
    let subtotal = cantidad * precio;
    $(this).find(".subtotal").val(subtotal);

    items.push({ iditem, cantidad, precio, subtotal });

    // Sumar el subtotal al total
    total += subtotal;
  });

  // Actualizar el valor del total
  let igv = total * 0.18;
  let subtotal = total - igv;

  $("#total").val(total.toFixed(2));
  $("#igv").val(igv.toFixed(2));
  $("#subtotal").val(subtotal.toFixed(2));
  $("#items").val(JSON.stringify(items));
}

$("#form_pedido").submit(function (e) {
  e.preventDefault();

  let form = $(this);
  if (form[0].checkValidity()) {
    let data = form.serialize();

    $.post(
      `${URL_BASE}/pedido/create`,
      data,
      function (data, textStatus, jqXHR) {
        if ("success" in data) {
          iziToast.success({
            title: "Éxito, ",
            message: data.success,
            position: "topCenter",
            displayMode: 1,
          });
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
