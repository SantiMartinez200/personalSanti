
function myFunction() {
  const idPj1 = document.getElementById("p1").value; //tomo valores de los inputs
  const idPj2 = document.getElementById("p2").value;
  const personajeContainer = document.getElementById("contpj");
  if (idPj1=="" || idPj2=="" || idPj1>826 || idPj1<0 || idPj2>826 || idPj2<0) {
    alert("Valores incorrectos O no ingresados, revísalos y volvé a intentar, reiniciando documento."); //si no se cumple la condicion reinicio el programa y que se ingrese devuelta
    document.location.reload();
  } else {
    fetch(`https://rickandmortyapi.com/api/character/${idPj1},${idPj2}`)
          .then((res) => res.json())
      .then((data) => {   //todo el proceso que requiere el archivo JSON a datos, con funcion FLECHA, puede no ser aplicable a otros procedimientos.
        console.log(data);
        /*Para personaje 1*/
        const img = document.createElement("img");
        img.src = data[0].image;
        const Nombre = document.createElement("h3");
        Nombre.textContent = "Nombre: " + data[0].name;
        const Estado = document.createElement("h3");
        Estado.textContent = "Estado: " + data[0].status;
        const Especie = document.createElement("h3"); //valores PJ1
        Especie.textContent = "Especie: " + data[0].species;
        const Genero = document.createElement("h3");
        Genero.textContent = "Género: " + data[0].gender;
        const cantEP = document.createElement("h3");
        cantEP.textContent =
          "Aparece en: " + data[0].episode.length + " Capítulos";
        const DIV = document.createElement("div");
        DIV.appendChild(img);
        DIV.appendChild(Nombre);
        DIV.appendChild(Estado);
        DIV.appendChild(Genero); //guardando valores PJ1
        DIV.appendChild(cantEP);
        /*------------------------------------------------------------------------------------ */
        /*Para personaje 2*/
        const img2 = document.createElement("img");
        img2.src = data[1].image;
        const Nombre2 = document.createElement("h3");
        Nombre2.textContent = "Nombre: " + data[1].name;
        const Estado2 = document.createElement("h3");
        Estado2.textContent = "Estado: " + data[1].status;
        const Especie2 = document.createElement("h3"); //valores PJ2
        Especie2.textContent = "Especie: " + data[1].species;
        const Genero2 = document.createElement("h3");
        Genero2.textContent = "Género: " + data[1].gender;
        const cantEP2 = document.createElement("h3");
        cantEP2.textContent =
          "Aparece en: " + data[1].episode.length + " Capítulos";
        const DIV2 = document.createElement("div");
        DIV2.appendChild(img2);
        DIV2.appendChild(Nombre2);
        DIV2.appendChild(Estado2);
        DIV2.appendChild(Genero2); //guardando valores PJ2
        DIV2.appendChild(cantEP2);
        personajeContainer.appendChild(DIV);
        personajeContainer.appendChild(DIV2); //Asignando al HTML, por un contenedor
        /*------------------------------------------------------------------------------------ */
        /* Devolviendo el mensaje de cual personaje aparece en más capítulos */
        const mensaje = document.createElement("h2");
        var numEP = data[0].episode.length;
        var numEP2 = data[1].episode.length;
        var paux = data[0].name;
        var paux2 = data[1].name;
        const DIVmsj = document.createElement("div");
          if (numEP>numEP2) {
            console.log("gana pj 1", numEP);
            mensaje.textContent = paux + " Es el personaje que aparece en mas capitulos";
            DIVmsj.appendChild(mensaje);
          }else if (numEP<numEP2) {
             console.log("gana pj 2", numEP2);
            mensaje.textContent = paux2 + " Es el personaje que aparece en mas capitulos";
            DIVmsj.appendChild(mensaje);
          } else {
            mensaje.textContent = paux + " aparece en la misma cantidad de capitulos que " + paux2;
            DIVmsj.appendChild(mensaje);
            
        }
        personajeContainer.appendChild(DIVmsj);
        DIV.classList.add("divpj1");
        DIV2.classList.add("divpj2");
        DIVmsj.classList.add("msj");
        /*------------------------------------------------------------------------------------ */
      });

    }
  }