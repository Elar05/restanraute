// Cargar tabla de pedidos
function loadTable() {
  $("#table_delivery").DataTable({
    destroy: true,
    ajax: {
      type: "post",
      url: "delivery/list",
    },
  });
}

$(document).ready(function () {
  loadTable();
});
