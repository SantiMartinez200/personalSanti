function confirmar(evento) {
  if (confirm("¿Desea eliminar este registro?")) {
    return true
  }else{
    evento.preventDefault();
  }
}
let linkDelete = document.querySelectorAll(".table__item__link");

for (let i = 0; i < linkDelete.length; i++) {
  linkDelete[i].addEventListener('click', confirmar);
  
}