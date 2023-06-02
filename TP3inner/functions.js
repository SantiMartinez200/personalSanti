document.querySelector("#ent").addEventListener("click", miFuncion, (e) => {
  e.preventDefault();
});
var img1 = "pngwingv.png";
var img2 = "pngwing.com.png";

function generarNumeroAleatorio() {
  return Math.floor(Math.random() * 826) + 1;
}
var numeroAleatorio = generarNumeroAleatorio();

async function miFuncion() {
  let GeneroR = "";
  let GeneroU = "";

  await fetch(`https://randomuser.me/api/`)
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      const datos = data.results;
      
      let randomCont = document.querySelector("#randomUser");
      randomCont.innerHTML = `
        <h3>Nombre: ${datos[0].name.first}</h3>
        <h3>Apellido: ${datos[0].name.last}</h3>
        <h3>Género: ${datos[0].gender}</h3>
        <h3>DNI: ${datos[0].id.value}</h3>
        <h3>Longitud: ${datos[0].location.coordinates.latitude}</h3>
        <h3>Latitud: ${datos[0].location.coordinates.longitude}</h3>
        <img src=${datos[0].picture.large} />
      `;

      if (datos[0].gender == "male") {
        document.getElementById("randomUser").style.backgroundColor = "green";
        GeneroU = "Male";
      } else if (datos[0].gender == "female") {
        document.getElementById("randomUser").style.backgroundColor = "yellow";
        GeneroU = "Female";
      }

    });

  ////////////////////////////////////////////////////////////////////////////

  /*nombre,estado,especie,genero,cantEP,imagen */
  await fetch(`https://rickandmortyapi.com/api/character/${numeroAleatorio}`)
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      GeneroR = data.gender;

      let rickCont = document.querySelector("#rickMorty");
      rickCont.innerHTML = `
        <h3>Nombre: ${data.name} </h3>
        <h3>Estado: ${data.status}</h3>
        <h3>Especie: ${data.species}</h3>
        <h3>Género: ${data.gender}</h3>
        <h3>Cantidad de Episodios en los que aparece: ${data.episode.length}</h3>
        <img src=${data.image} />
      `;
    });
  ////////////////////////////////////////////////////////////////////////////
  if (GeneroR == GeneroU) {
    console.log("Match!");
    let icon = document.querySelector("#match");
    icon.innerHTML = `<img src=${img1} />`
  } else {
    console.log("No match.");
    let icon = document.querySelector("#match");
    icon.innerHTML = `<img src=${img2} />`;
  }
  //MAPA!*
}