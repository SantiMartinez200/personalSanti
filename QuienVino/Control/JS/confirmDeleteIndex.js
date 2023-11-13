function alerta_eliminar(codigo) {
  Swal.fire({
    title: "Seguro?",
    text: "El registro será eliminado!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      mandar_php(codigo);
    }
  });
}

function mandar_php(codigo) {
  parametros = { id: codigo };
  $.ajax({
    data: parametros,
    url: "../QuienVino/Control/eliminarAsistenciaIndex.php",
    type: "POST",
    beforeSend: function () {},
    success: function () {
      Swal.fire("Eliminado!", "Has eliminado el regisro.", "success").then(
        (result) => {
          window.location.href = "../QuienVino/index.php";
        }
      );
    },
  });
}
