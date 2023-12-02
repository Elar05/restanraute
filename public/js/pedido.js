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
