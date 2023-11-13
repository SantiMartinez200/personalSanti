async function buscarFetch(dni) {
  if (dni === "") {
    window.location.reload();
  } else {
    await fetch("../Control/buscarAlumno.php?dni=" + dni)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error en la solicitud: " + response.status);
        }
        return response.text();
      })
      .then((data) => {
        document.getElementById("buscar").innerHTML = data;
        document.getElementById("vaciar").innerHTML = "";
      });
  }
}
