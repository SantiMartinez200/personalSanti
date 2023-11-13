function alerta_eliminar(codigo) {
  Swal.fire({
    title: "Seguro?",
    text: "Se eliminarán todos los parámetros!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
     window.location = "eliminarParametros.php?codigo=" + codigo;
    }
  });
}

/*function mandar_php(codigo) {
  parametros = { id: codigo };
  $.ajax({
    data: parametros,
    url: "eliminarParametros.php",
    type: "POST",
    beforeSend: function () {},
    success: function () {
      Swal.fire("Eliminados!", "Parametros reseteados a cero.", "success").then(
        (result) => {
          window.location.href = "eliminarParametros.php";
        }
      );
    },
  });
}*/
