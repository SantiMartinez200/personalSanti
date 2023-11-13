async function buscarFetch(dni) {
  if ((dni === "")) {
    window.location.href= "../../ABM/Alumno/ABM_Alumno.php";
  } else {
    await fetch("../../Control/buscarAlumnoABM.php?dni=" + dni)
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


