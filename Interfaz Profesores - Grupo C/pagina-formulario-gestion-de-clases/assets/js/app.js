
// Para saber que estoy trabajando con el DOM, las variables tienen `$` adelante.
const $modal = document.querySelector(".modal"); 
const $modal2 = document.querySelector(".modal2"); 
const $modal3 = document.querySelector(".modal3"); 
const $fondo_modal = document.querySelector(".modal__container");  
const $fondo_modal_mdn = document.querySelector(".modal3__container");  
const $inputs_modal = document.querySelectorAll(".inputs-modal");
const $select_materia = document.querySelector(".mod_materia");
const $select_comision = document.querySelector(".mod_comision");
const $select_hora = document.querySelector(".mod_hora");

function actualizarHora(Hora) {
  let opcionesHTML = '';
  const opciones = {
    "8:00-10:00": ["8:00-10:00", "8:00-12:00", "10:10-12:00", "18:00-22:00", "20:10-22:00", "18:00-20:00"],
    "10:10-12:00": ["10:10-12:00", "8:00-10:00","10:10-12:00", "8:00-12:00", "20:10-22:00", "18:00-22:00", "18:00-20:00"],
    "8:00-12:00": ["8:00-12:00", "8:00-10:00", "10:10-12:00","8:00-12:00", "20:10-22:00", "18:00-22:00", "18:00-20:00"],
    "18:00-20:00": ["18:00-20:00", "8:00-10:00", "10:10-12:00", "8:00-12:00","18:00-20:00", "18:00-22:00", "20:10-22:00"],
    "20:10-22:00": ["20:10-22:00", "8:00-10:00", "10:10-12:00", "8:00-12:00", "18:00-20:00","20:10-22:00", "18:00-22:00",],
    "18:00-22:00": ["18:00-22:00", "8:00-10:00", "10:10-12:00", "8:00-12:00", "18:00-20:00", "20:10-22:00","18:00-22:00"]
  };

  const opcionesArray = opciones[Hora];
  for (let i = 0; i < opcionesArray.length; i++) {
    if(i==0){
      opcionesHTML += `<option value="${opcionesArray[i]}" hidden>${opcionesArray[i]}</option>`;
    }
    else{
      opcionesHTML += `<option value="${opcionesArray[i]}" >${opcionesArray[i]}</option>`;
    }
  }

  return opcionesHTML;
}

export const fn_button_alta = (openModalAlta, closeModalAlta) => {
  openModalAlta.addEventListener("click", (e) => {
    e.preventDefault()
    $modal.classList.add("modal--show")
  })

  closeModalAlta.addEventListener("click", (e) => {
    e.preventDefault();
    $modal.classList.remove("modal--show");
    const bad = document.querySelector(".bad"); 
    $fondo_modal.style.borderColor="white";
    for (let i = 0; i < $inputs_modal.length; i++) {
      $inputs_modal[i].style.borderColor = "white";
    }      
    bad.style.display="none";
  })
}

export const fn_button_modificacion =(openModalModificacion, closeModalModificacion) => {
  openModalModificacion.addEventListener("click", (e) => {
    e.preventDefault()
  
    $modal3.classList.add("modal3--show");

    let valorMateria = parseInt($select_materia.value);
    switch(valorMateria ){
      case 1: 
      $select_materia.innerHTML=" ";
      $select_materia.innerHTML+=`
      <option value="1" class="op-materia" >1.Análisis Matemático 1</option>
      <option value="2"  class="op-materia" >2.Inglés 2</option>
      <option value="3"  class="op-materia" >3.Prácticas Profesionalizantes 3</option> ` ;
      break;
      case 2: 
      $select_materia.innerHTML=" ";
      $select_materia.innerHTML+=`
      <option value="2" hidden>2.Inglés 2</option>
      <option value="1" class="op-materia" >1.Análisis Matemático 1</option>
      <option value="2"  class="op-materia" >2.Inglés 2</option>
      <option value="3"  class="op-materia" >3.Prácticas Profesionalizantes 3</option> ` ;
      break;
      case 3: 
      $select_materia.innerHTML=" ";
      $select_materia.innerHTML+=`
      <option value="3"  hidden >3.Prácticas Profesionalizantes 3</option>
      <option value="1" class="op-materia" >1.Análisis Matemático 1</option>
      <option value="2"  class="op-materia" >2.Inglés 2</option>
      <option value="3"  class="op-materia" >3.Prácticas Profesionalizantes 3</option>` ;
      break;
    }

    let valorComision = $select_comision.value;
    if(valorComision == "1.º, 1.ª"){
      $select_comision.innerHTML=" ";
      $select_comision.innerHTML+=`
      <option value="1.º, 1.ª" >1.º, 1.ª</option>
      <option value="1.º, 2.ª" >1.º, 2.ª</option>
      <option value="1.º, 3.ª" >1.º, 3.ª</option> `;
    }
    else if(valorComision == "1.º, 2.ª"){
      $select_comision.innerHTML=" ";
      $select_comision.innerHTML+=`
      <option value="1.º, 2.ª" hidden>1.º, 2.ª</option>
      <option value="1.º, 1.ª" >1.º, 1.ª</option>
      <option value="1.º, 2.ª" >1.º, 2.ª</option>
      <option value="1.º, 3.ª" >1.º, 3.ª</option> `;
    }
    else{
      $select_comision.innerHTML=" ";
      $select_comision.innerHTML+=`
      <option value="1.º, 3.ª" hidden >1.º, 3.ª</option>
      <option value="1.º, 1.ª" >1.º, 1.ª</option>
      <option value="1.º, 2.ª" >1.º, 2.ª</option>
      <option value="1.º, 3.ª" >1.º, 3.ª</option>
      `;
    }
    
    $select_hora.innerHTML = actualizarHora($select_hora.value);
  });

  closeModalModificacion.addEventListener("click", (e) => {
    e.preventDefault();
    $modal3.classList.remove("modal3--show");
    const bad = document.querySelector(".bad"); 
    $fondo_modal_mdn.style.borderColor="white";
    for (let i = 0; i < $inputs_modal.length; i++) {
      $inputs_modal[i].style.borderColor = "white";
    }      
    bad.style.display="none";
  });
}

export const fn_button_baja = (openModalBaja, closeModalBaja) => {
  openModalBaja.addEventListener("click", (e) => {
    e.preventDefault()
    $modal2.classList.add("modal2--show")
  })

  closeModalBaja.addEventListener("click", (e) => {
    e.preventDefault();
    $modal2.classList.remove("modal2--show");
  })
}


// Si no marqué ningun input checkbox, el botón de modificar debe estar inhabilitado
// Si marqué varios input checkbox, el botón de modificar debe estar inhabilitado, ya que solo se puede modificar 1 solo a la vez
// Si marqué un input checkbox, el botón de modificar se habilita y se podrá visualizar un formulario con esos mismos datos para poder editarlos.
const checkbox_modificar = (btnCheckModificar) => { /* TODO: Code here */ }

// Si no marqué ningún input checkbox, el botón de dar de baja debe estar inhabilitado
// Si marqué uno o varios input checkbox, el botón de dar de baja se habilita y saldrá un mensaje de alerta el cual mostrará los registros que se quieran eliminar y un botón de 'confirmar baja'
const checkbox_baja = (btnCheckBaja) => { /* TODO: Code here */ }