document.querySelector("#bot").addEventListener("click", traerDatos);
const contenedor = document.getElementById("cont");
var encontrado = "";

function traerDatos() {
  const val = document.getElementById("n").value;
  //console.log(val);
  //console.log("funca");
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "models.json", true);
  xhttp.send();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      let obj = JSON.parse(this.responseText);
      //console.log(obj);

      for (let index = 0; index < obj.autos.length; index++) {
        //console.log(obj.autos[index]);
        if (val == obj.autos[index].id) {
          console.log("t");
          //console.log(obj.autos[index]);
          encontrado = obj.autos[index];
          console.log(encontrado);
          const marca = document.createElement("h3");
          marca.textcontent = "marca " + obj.autos[index].nombre;

          const topspeed = document.createElement("h3");
          topspeed.textcontent = " Vel. maxima " + obj.autos[index].topspeed;

          const div = document.createElement("div");
          div.appendChild(marca);
          div.appendChild(topspeed);
          console.log(div);
          contenedor.appendChild(div);
        }
      }
    }
  };
}
