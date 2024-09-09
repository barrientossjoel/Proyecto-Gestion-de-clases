
// cuando cargue el DOM va a ejecutar los siguientes fragmentos de código
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput'); // referencia del input de búsqueda
  const filterSelect = document.getElementById('filterSelect'); // referencia del select de filtrado
  const table = document.querySelectorAll('.table_principal-body'); // referencia de las tablas de clases
  const tituloMateria = document.querySelectorAll('.titulo-materia'); // referencia al div que almacena la materia
  const contenedorTituloMateria = document.querySelectorAll('.contenedor-materia');

  // Función que hará el filtrado de búsqueda
  function filterTable(e) {
    e.preventDefault();

    // Variable para almacenar el valor ingresado y lo convierto a minúsculas para facilitar la comparación
    const searchValue = searchInput.value.toLowerCase();

    // Variable para almacenar el valor seleccionado en el menú de filtro
    const filterValue = filterSelect.value;

    table.forEach(t => { // Itero sobre cada elemento de la tabla (cada fila y columna)
      // almaceno el cuerpo de la tabla
      const tableBody = t.querySelector('tbody');
      // Si NO hay tbody, sale de la función (no hay datos para filtrar y termina)
      if (!tableBody) return;
      
      // almaceno en una variable todas las filas dentro del cuerpo de la tabla
      const rows = tableBody.getElementsByTagName('tr');
      // itero sobre cada fila
      for (let i = 0; i < rows.length; i++) {
        // almaceno todas las celdas (td) adentro de la fila actual
        const cells = rows[i].getElementsByTagName('td');
        
        let rowContainsText = false; // Inicializo y declaro en false para ver si la fila actual tiene el texto actual ingresado
  
        // Si el valor es igual a "Filtrar"
        if (filterValue === "Filtrar") {
          rowContainsText = true; // muestro todas las filas
          columnIndex = -1; // esto es para que no se filtre en ninguna columna específica
          searchInput.value = ""; // limpio el input de búsqueda
          searchInput.placeholder = "Buscar por materia, comisión, aula..."; // cambio el texto del placeholder para decir que no se aplicó ningún filtro
          searchInput.disabled = true
        } else {
          let columnIndex; // inicializo el índice a verificar, por defecto es -1
          // Si se selecciona un filtro específico hacer para cada caso
          switch (filterValue) {
            case "Por Materia":
              columnIndex = 2; // fijo la columna que se va a filtrar (materia)
              searchInput.placeholder = "Buscar por materia...";
              searchInput.disabled = false
              break;
            case "Por Hora":
              columnIndex = 5; // fijo la columna que se va a filtrar (hora)
              searchInput.placeholder = "Buscar por Hora...";
              searchInput.disabled = false
              break;
            case "Por Fecha":
              columnIndex = 6; // fijo la columna que se va a filtrar (fecha)
              searchInput.placeholder = "Buscar por Fecha...";
              searchInput.disabled = false
              break;
          }

          // Si columnIndex es válido (mayor que -1) y que no se exceda el número de columnas en la fila
          if (columnIndex > -1 && columnIndex < cells.length) {
            // guardo el texto de la celda en la columna específica y lo convierte a minúsculas para comparar
            const cellText = cells[columnIndex].innerText || cells[columnIndex].textContent;
            // Si el texto tiene el valor buscado, entonces
            if (cellText.toLowerCase().includes(searchValue)) {
              rowContainsText = true; // marco la fila a ser mostrada
            }
            // si no, es porque no tiene el valor buscado y por lo tanto no tiene que ser mostrada
          }
        }
        
        // itero cada div de las materias agrupadas
        // muestro u oculto la fila si tiene el texto buscado
        // muestro u oculto el div de la materia q tienen sus clases según el filtro
        tituloMateria.forEach(div => {
          div.style.display = rowContainsText ? '' : 'none';
          // div.style.backgroundColor = rowContainsText ? 'blue' : 'red';
          rows[i].style.display = rowContainsText ? '' : 'none';
        });

        contenedorTituloMateria.forEach(conte => {
          conte.style.maxHeight = rowContainsText ? '' : 'fit-content';
        })
      }
    });

    
  }

  // Establezco eventos de Click, Change y KeyUp
  filterSelect.addEventListener('change', filterTable);
  searchInput.addEventListener('keyup', filterTable);
});
