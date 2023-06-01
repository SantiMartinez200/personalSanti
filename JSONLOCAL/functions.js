document.querySelector("#bot").addEventListener("click", FUNSION, (e) => { e.preventDefault(); } );
var detectado = ""

function FUNSION() {
  const val = document.getElementById("n").value;
  const contenedor = document.getElementById("cont");
  fetch(`models.json`)
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      console.log(val);
      for (let index = 0; index < data.autos.length; index++) {
        if (val == data.autos[index].id) {
         detectado = data.autos[index];
          console.log(detectado); 
        }
      }
      const marca = document.createElement("h3");
      marca.textContent = "marca: " + detectado.nombre;

      const topspeed = document.createElement("h3");
      topspeed.textContent = " Vel. maxima: " + detectado.topspeed + " km/h"

      const cil = document.createElement("h3");
      cil.textContent = "Cantidad de cilindros: " + detectado.motor.cilindros;

      const asp = document.createElement("h3");
      asp.textContent = "Aspiracion: " + detectado.motor.aspiracion;

      const cc = document.createElement("h3");
      cc.textContent = "Cilindrada: " + detectado.motor.cc;

      const imagen = document.createElement("img");
      imagen.src = detectado.img;

      const div = document.createElement("div");
      div.appendChild(marca);
      div.appendChild(topspeed);
      div.appendChild(cil);
      div.appendChild(asp);
      div.appendChild(cc);
      div.appendChild(imagen);
      contenedor.appendChild(div);

    });
}
