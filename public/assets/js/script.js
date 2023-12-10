$(".form").submit(function () {
  $.post(
    "index.php", // адрес обработчика
    $(".form").serialize(), // отправляемые данные

    function (msg) {
      $(".form").hide("slow");
      $(".wrap").html(msg);
    }
  );

  return false;
});
