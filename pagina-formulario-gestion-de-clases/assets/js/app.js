const d = document;
const $modal = d.querySelector(".modal"); // Variable global
const $modal2 = d.querySelector(".modal2"); // Variable global
const $modal3 = d.querySelector(".modal3"); // Variable global
const $checkboxModifyDelete = document.querySelectorAll(".input-checkbox-register");

export { $checkboxModifyDelete };

function limpiarCampos(elemento) {
  elemento.innerHTML = '';
  elemento.value = '';
}

function completarCampos(elemento, contenido) {
  elemento.innerHTML = `${contenido}`;
  elemento.value = `${contenido}`;
}

export const fn_button_alta = (openModalAlta, closeModalAlta) => {
  openModalAlta.addEventListener("click", (e) => {
    $modal.classList.add("modal--show");
  })

  closeModalAlta.addEventListener("click", (e) => {
    $modal.classList.remove("modal--show");
  })
}

export const fn_button_modificacion = (openModalModificacion, closeModalModificacion) => {
  openModalModificacion.addEventListener("click", (e) => {
    const opcion_materia = document.querySelector('#op-principal-materia');
    const opcion_comision = document.querySelector('#op-principal-comision');
    const campo_aula = document.querySelector('#new-aula-id');
    const opcion_hora = document.querySelector('#op-principal-hora');
    const campo_fecha = document.querySelector('#new-fecha-id');
    const campo_temas = document.querySelector('#temas-id');
    const campo_novedad = document.querySelector('#novedad-id');
    const campo_archivo = document.querySelector('#archivo_actual');

    limpiarCampos(opcion_materia);
    limpiarCampos(opcion_comision);
    limpiarCampos(campo_aula);
    limpiarCampos(opcion_hora);
    limpiarCampos(campo_fecha);
    limpiarCampos(campo_temas);
    limpiarCampos(campo_novedad);
    limpiarCampos(campo_archivo);

    $checkboxModifyDelete.forEach(checkbox => {
      if (checkbox.checked) {
        const id_clase = checkbox.value;
        const row = checkbox.closest('tr');
        const codigo_materia = row.cells[1].textContent;
        const nombre_materia = row.cells[2].textContent;
        const comision = row.cells[3].textContent;
        const aula = row.cells[4].textContent;
        const hora = row.cells[5].textContent;
        const fecha = row.cells[6].textContent;
        const temas = row.cells[7].textContent;
        const novedades = row.cells[8].textContent;
        const archivos = row.cells[9].textContent;

        opcion_materia.innerHTML = `${nombre_materia}`;
        opcion_materia.value = `${codigo_materia}`;
        completarCampos(opcion_comision, comision);
        completarCampos(campo_aula, aula);
        completarCampos(opcion_hora, hora);
        completarCampos(campo_fecha, fecha);
        completarCampos(campo_temas, temas);
        completarCampos(campo_novedad, novedades);
        campo_archivo.innerHTML = `${archivos}`
      }
    });

    $modal3.classList.add("modal3--show");
  });

  closeModalModificacion.addEventListener("click", (e) => {
    $modal3.classList.remove("modal3--show");
  });
}

export const fn_button_baja = (openModalBaja, closeModalBaja) => {
  const table_modal_baja = document.querySelector('#table_modal_baja tbody');

  openModalBaja.addEventListener("click", (e) => {
    table_modal_baja.innerHTML = ''; // Limpiar la tabla del modal

    $checkboxModifyDelete.forEach(checkbox => {
      if (checkbox.checked) {
        const id_clase = checkbox.value;
        const row = checkbox.closest('tr');
        const materia = row.cells[2].textContent;
        const comision = row.cells[3].textContent;
        const aula = row.cells[4].textContent;
        const hora = row.cells[5].textContent;
        const fecha = row.cells[6].textContent;
        const temas = row.cells[7].textContent;
        const novedades = row.cells[8].textContent;
        const archivos = row.cells[9].textContent;

        const newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td>${materia}</td>
        <td>${comision}</td> 
        <td>${aula}</td> 
        <td>${hora}</td>  
        <td>${fecha}</td>  
        <td>${temas}</td>  
        <td>${novedades}</td> 
        <td>${archivos} </td>`;
        table_modal_baja.appendChild(newRow);
      }

    });

    $modal2.classList.add("modal2--show");

  });


  closeModalBaja.addEventListener("click", (e) => {
    $modal2.classList.remove("modal2--show");
  });
}





