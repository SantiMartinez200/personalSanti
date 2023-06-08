document.getElementById("input").addEventListener('click', miFuncion);

async function miFuncion() {
  var paisUno = "";
  var paisDos = "";
  var lat1 = 0;
  var lon1 = 0;
  var lat2 = 0;
  var lon2 = 0;
  var genero1 = "";
  var genero2 = "";
  const personaUno = document.getElementById("personaUno");
  const personaDos = document.getElementById("personaDos");
  const match = document.getElementById("match");
  await fetch('https://randomuser.me/api/').then((res) => res.json()).then(data => {
    console.log(data);
    //console.log(data.results[0].name.last);
    let telefono = data.results[0].cell;
    let email = data.results[0].email;
    let dni = data.results[0].id.value;
    paisUno = data.results[0].location.country;
    lat1 = data.results[0].location.coordinates.latitude;
    lon1 = data.results[0].location.coordinates.longitude;
    let calleNum = data.results[0].location.street.number;
    let calleNom = data.results[0].location.street.name;
    let nombreUsuario = data.results[0].login.username;
    let fotito = data.results[0].picture.large;
     genero1 = data.results[0].gender;
    //console.log(telefono, email, dni, paisUno, calleNum, calleNom, nombreUsuario);
    personaUno.innerHTML = `
    <h3>Username: ${nombreUsuario}</h3>
    <h3>Email:  ${email}</h3>
    <h3>DNI:  ${dni}</h3>
    <h3>Pais:  ${paisUno}</h3>
    <h3>Direccion:  ${calleNum}</h3>
    <h3>Calle:  ${calleNom}</h3>
    <h3>Teléfono:  ${telefono}</h3>
    <img src='${fotito}'>
    `;
    personaUno.classList.add("bordesgruesos");
  })

  await fetch('https://randomuser.me/api/').then((res) => res.json()).then(data => {
    //console.log(data);
    let telefono = data.results[0].cell;
    let email = data.results[0].email;
    let dni = data.results[0].id.value;
    paisDos = data.results[0].location.country;
    lat2 = data.results[0].location.coordinates.latitude;
    lon2 = data.results[0].location.coordinates.longitude;
    let calleNum = data.results[0].location.street.number;
    let calleNom = data.results[0].location.street.name;
    let nombreUsuario = data.results[0].login.username;
    let fotito = data.results[0].picture.large;
    genero2 = data.results[0].gender;
    //console.log(telefono, email, dni, paisUno, calleNum, calleNom, nombreUsuario);
    personaDos.innerHTML = `
    <h3>Username: ${nombreUsuario}</h3>
    <h3>Email:  ${email}</h3>
    <h3>DNI:  ${dni}</h3>
    <h3>Pais:  ${paisDos}</h3>
    <h3>Direccion:  ${calleNum}</h3>
    <h3>Calle:  ${calleNom}</h3>
    <h3>Teléfono:  ${telefono}</h3>
    <img src='${fotito}'>
    `;
    personaDos.classList.add("bordesfinos");
  })

  if (paisUno == paisDos) {
    var correct = 'picaron.jpg';
    match.innerHTML = `
    <img src='${correct}'>
    `;
  } else {
    var incorrect = 'triste.jpg';
    match.innerHTML = `
    <img src='${incorrect}'>
    `;
  }

  var container = L.DomUtil.get("map");
  if (container != null) {
    container._leaflet_id = null;
  }

  var map = L.map("map").setView([lat1, lon1], 2);
  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution:
      '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);
  var marker = L.marker([lat1, lon1]).addTo(map);
  marker.bindPopup("Aqui vive el usuario 1.").openPopup();
  var marker2 = L.marker([lat2, lon2]).addTo(map);
  marker2.bindPopup("Aqui vive el usuario 2.").openPopup();

  if (genero1 == 'male') {
    personaUno.style.backgroundColor="blue";
  } else if (genero1=='female') {
    personaUno.style.backgroundColor="pink";
  }
  
  if (genero2 == "male") {
    personaDos.style.backgroundColor ='blue';
  } else if (genero2 == "female") {
    personaDos.style.backgroundColor ='pink';
  }

}