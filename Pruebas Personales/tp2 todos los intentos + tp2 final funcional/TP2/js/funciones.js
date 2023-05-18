const input = document.getElementById("pj1");
const input2 = document.getElementById("pj2")
const button = document.querySelector("button");
const personajeContainer = document.querySelector(".personaje-container");
const episodioContainer = document.querySelector(".episodio-container");

button.addEventListener('click', (e) => {
  e.preventDefault();
  traerPersonaje(input.value);
  traerOtropersonaje(input2.value);
  console.log(input.value);
  console.log(input2.value);
}  )


function traerPersonaje(personaje,personaje2) {
  fetch(`https://rickandmortyapi.com/api/character/${personaje},${personaje2}`)
    .then((res) => res.json())
    .then((data) => {
      crearPersonaje(data);
      //var episodioArray = data.episode;
      //console.log(episodioArray);
      
    })
    .catch(error => console.log(error))
}

function traerOtropersonaje(personaje2) {
  fetch(`https://rickandmortyapi.com/api/character/${personaje2}`)
    .then((res2) => res2.json())
    .then((data2) => {
      crearPersonaje(data2);
      console.log(data2);
      //var episodioArray = data.episode;
      //console.log(episodioArray);
    })
    .catch((error) => console.log(error));
}
//2 personajes (dos inputs), decir cual de los dos aparece en más episodios.

 




function crearPersonaje(personaje,personaje2) {
  const img = document.createElement("img");
  img.src = personaje.image;

  const name = document.createElement("h3");
  name.textContent = "Nombre: " + personaje.name;

  const species = document.createElement("h4");
  species.textContent = "Raza: " + personaje.species;

  const status = document.createElement("h4");
  status.textContent = "Estado: " + personaje.status;

  const div = document.createElement("div");
  div.appendChild(img);
  div.appendChild(name);
  div.appendChild(species);
  div.appendChild(status);
  
  

  const episodioArray = personaje.episode;
  //console.log(episodioArray);
  //-------------------------------------------------------
  //var foo = episodioArray.map(function (bar) {
  //  return "<li class='list-group-item active'>" + bar + "</li>"; <<<RECORREMOS CREANDO OTRO ARRAY APARTIR DEL QUE YA ESTABA>>>
  //    
  //});
  //-------------------------------------------------------
  //let text = "";
  //for (let i = 0; i < episodioArray.length; i++) {
  //  text += episodioArray[i] + "<br><br>";          //recorremos array
  //}
  //-------------------------------------------------------
  //let text = "";
  //episodioArray.forEach(myFunction);
  //function myFunction(item) {     //recorremos array pt2
  //    text += item + "<br><br>";;
    
  //}


  //document.getElementById("foo").innerHTML = text;

  let numEpi = episodioArray.length;
  console.log(numEpi);
  const cantEpisodios = document.createElement("h4");
  cantEpisodios.textContent = "Aparece en: " + numEpi + " capítulos.";
  div.appendChild(cantEpisodios);
  
  personajeContainer.appendChild(div);
  //episodioContainer.appendChild(foo);

  const img2 = document.createElement("img");
  img2.src = personaje2.image;

  const name2 = document.createElement("h3");
  name2.textContent = "Nombre: " + personaje2.name;

  const species2 = document.createElement("h4");
  species2.textContent = "Raza: " + personaje2.species;

  const status2 = document.createElement("h4");
  status2.textContent = "Estado: " + personaje2.status;

  
  div.appendChild(img2);
  div.appendChild(name2);
  div.appendChild(species2);
  div.appendChild(status2);

  const episodioArray2 = personaje.episode;

  let numEpi2 = episodioArray.length;
  console.log(numEpi2);
  const cantEpisodios2 = document.createElement("h4");
  cantEpisodios2.textContent =
    "Aparece en: " + episodioArray2.length + " capítulos.";
  div.appendChild(cantEpisodios2);
  //realizar con un fetch, api tiene apartado de multiple character, traer ambos con 1 sola llamada
}



