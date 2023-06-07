document.querySelector("#ent").addEventListener("click", Funcion, (a) => { a.preventDefault(); });

var hondas = [];
var yamahas = [];
var otras = [];

function Funcion() {
  /*let aleatorio = Math.floor(Math.random() * 8);
  console.log(aleatorio);*/
  //let input = document.querySelector("numero");
  fetch('models.json').then((res) => res.json()).then(data => {
    //console.log(data);
    for (let i = 0; i < data.motos.length; i++) {
      if (data.motos[i].nombre == "Honda") {
        hondas.push(data.motos[i]);
      } else if (data.motos[i].nombre == "Yamaha") {
        yamahas.push(data.motos[i]);
      } else {
        otras.push(data.motos[i]);
      }
    }
    /* console.log(hondas);
     console.log(yamahas);
     console.log(otras); */
    var max = 0;
    let maxHonda = [];
    let maxYamaha = [];
    let maxOtras = [];
    for (let i = 0; i < hondas.length; i++) {
      if (max < hondas[i].motor.cc) {
        max = hondas[i].motor.cc;
        maxHonda = hondas[i];
      }
    }
    max = 0;
    console.log(maxHonda);
    //////////////////////////////////////////////
    for (let i = 0; i < yamahas.length; i++) {
      if (max < yamahas[i].motor.cc) {
        max = yamahas[i].motor.cc;
        maxYamaha = yamahas[i];
      }
    }
    max = 0;
    console.log(maxYamaha);
    //////////////////////////////////////////////
    for (let i = 0; i < otras.length; i++) {
      if (max < otras[i].motor.cc) {
        max = otras[i].motor.cc;
        maxOtras = otras[i];
      }
    }
    console.log(maxOtras);
    //cargando////////////////////////////////////
    let Honda = document.getElementById("hondas");
    Honda.innerHTML = `
    <h3>Marca: ${maxHonda.nombre} </h3>
    <h3>Modelo: ${maxHonda.modelo} </h3>
    <h3>Cilindrada: ${maxHonda.motor.cc} Centímetros Cúbicos </h3>
    <h3>Motor: ${maxHonda.motor.cilindros} Cilindros </h3>
    <h3>Velocidad: ${maxHonda.topspeed} Km/h </h3>
    `;
    Honda.style.backgroundColor = 'red';
    let Yamaha = document.getElementById("yamahas");
    Yamaha.innerHTML = `
    <h3>Marca: ${maxYamaha.nombre} </h3>
    <h3>Modelo: ${maxYamaha.modelo} </h3>
    <h3>Cilindrada: ${maxYamaha.motor.cc} Centímetros Cúbicos </h3>
    <h3>Motor: ${maxYamaha.motor.cilindros} Cilindros </h3>
    <h3>Velocidad: ${maxYamaha.topspeed} Km/h </h3>
    `;
    Yamaha.style.backgroundColor = "blue";
    let Multimarca = document.getElementById("otras");
    Multimarca.innerHTML = `
    <h3>Marca: ${maxOtras.nombre} </h3>
    <h3>Modelo: ${maxOtras.modelo} </h3>
    <h3>Cilindrada: ${maxOtras.motor.cc} Centímetros Cúbicos </h3>
    <h3>Motor: ${maxOtras.motor.cilindros} Cilindros </h3>
    <h3>Velocidad: ${maxOtras.topspeed} Km/h </h3>
    `;
    Multimarca.style.backgroundColor = "grey";
  })
}