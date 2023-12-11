// Cargar tabla de pedidos
function loadTable() {
  $("#table_venta").DataTable({
    destroy: true,
    ajax: {
      type: "post",
      url: "venta/list",
    },
  });
}

$(document).ready(function () {
  loadTable();
});
