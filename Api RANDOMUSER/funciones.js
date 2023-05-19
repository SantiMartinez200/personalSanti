const contenedor = document.getElementById("contenedor");


function miFuncion() {
  fetch(`https://randomuser.me/api/`)
    .then((res) => res.json())
    .then((data) => {
      const datos = data.results;
     // console.log(datos);

      const nombre = document.createElement("h2");
      nombre.textContent = "Nombre: " + datos[0].name.first;
      // console.log(nombre);

      const img = document.createElement("img");
      img.src = datos[0].picture.large;

      const apellido = document.createElement("h2");
      apellido.textContent = "Apellido: " + datos[0].name.last

      const DNI = document.createElement("h2");
      DNI.textContent = "Identificacion: " + datos[0].id.value;

      const coordenadaLatitud = document.createElement("h2");
      coordenadaLatitud.textContent = "Latitud: " + datos[0].location.coordinates.latitude;

      const coordenadaLongitud = document.createElement("h2");
      coordenadaLongitud.textContent = "Longitud: " + datos[0].location.coordinates.longitude;

      var GENERO = datos[0].gender;
      //console.log(GENERO);

      if (GENERO=="male") {
        document.getElementById("contenedor").style.backgroundColor = "green";
      } else if (GENERO=="female") {
        document.getElementById("contenedor").style.backgroundColor = "yellow";
      }

      const div = document.createElement("div");
      div.appendChild(nombre);
      div.appendChild(apellido);
      div.appendChild(DNI);
      div.appendChild(coordenadaLatitud);
      div.appendChild(coordenadaLongitud);
      div.appendChild(img);
      
      contenedor.appendChild(div);

      var latitud = datos[0].location.coordinates.latitude;
      var longitud = datos[0].location.coordinates.longitude;
      console.log(latitud);
      console.log(longitud);
      
      var map = L.map("map").setView([latitud, longitud], 13);
      L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution:
          '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
      }).addTo(map);
      var marker = L.marker([latitud, longitud]).addTo(map);
    });
}

//TP3
//Boton consultar
//traer una persona de RandomUser y otro de Rick and Morty.
//randomizar una ID de rick and morty.
//mostrar la persona random de un lado y el rick del otro
//cuando coinciden los generos, hacer "MATCH! como tinder. mostrar un icono de "tick" correcto.
//TP3


//mapa https://leafletjs.com/index.html