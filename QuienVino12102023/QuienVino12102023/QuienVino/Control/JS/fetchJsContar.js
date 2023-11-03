 async function buscarFetch(dni) {
  if (dni === "") {
    window.location.reload();
    console.log("is Empty");
  } else {
    await fetch("../Control/buscarAlumnoContar.php?dni=" + dni)
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


