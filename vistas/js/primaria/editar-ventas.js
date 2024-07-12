$(document).on("click","#return", () => window.location = "ventas");


$(document).on("click", "#showImei", function () {
  $("#modalImg").attr("src", $(this).attr("imei"));
});

$(document).on("click", "#showSimcard", function () {
  $("#modalImgSimcard").attr("src", $(this).attr("simcard"));
});

$(document).on("click", "#showLinea", function () {
  $("#modalImgLinea").attr("src", $(this).attr("linea"));
});