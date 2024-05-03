
const d = document;
const $modal = d.querySelector(".modal"); // Variable global
const $modal2 = d.querySelector(".modal2"); // Variable global
const $modal3 = d.querySelector(".modal3"); // Variable global
const fondo_modal = document.querySelector(".modal__container");
const inputs_modal = document.querySelectorAll(".inputs-form-alta");

export const fn_button_alta = (openModalAlta, closeModalAlta) => {
  openModalAlta.addEventListener("click", (e) => {
    // e.preventDefault()
    $modal.classList.add("modal--show")
  })


  closeModalAlta.addEventListener("click", (e) => {
    // e.preventDefault();
    $modal.classList.remove("modal--show");
    const bad = document.querySelector(".bad");
    fondo_modal.style.borderColor = "white";
    for (let i = 0; i < inputs_modal.length; i++) {
      inputs_modal[i].style.borderColor = "white";
    }
    bad.style.display = "none";
  })
}

export const fn_button_modificacion = (openModalModificacion, closeModalModificacion) => {
  openModalModificacion.addEventListener("click", (e) => {
    // e.preventDefault()
    $modal3.classList.add("modal3--show")
  });


  closeModalModificacion.addEventListener("click", (e) => {
    // e.preventDefault();
    $modal3.classList.remove("modal3--show");
  });
}

export const fn_button_baja = (openModalBaja, closeModalBaja) => {
  openModalBaja.addEventListener("click", (e) => {
    // e.preventDefault()
    $modal2.classList.add("modal2--show")
  })


  closeModalBaja.addEventListener("click", (e) => {
    // e.preventDefault();
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
