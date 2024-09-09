import { $checkboxModifyDelete, fn_button_alta, fn_button_modificacion, fn_button_baja } from "./app.js"

const d = document

d.addEventListener("DOMContentLoaded", () => {
  const $closeModal = d.querySelector(".modal__close")
  const $closeModal2 = d.querySelector(".modal2__close")
  const $closeModal3 = d.querySelector(".modal3__close")

  const $btnAlta = d.getElementById("id-btn-alta")
  const $btnModificar = d.getElementById("id-btn-modificar")
  const $btnBaja = d.getElementById("id-btn-baja")

  let clasesSeleccionadas = [];

  function estadoBtns() {
    const acumuladorBaja = clasesSeleccionadas.length > 0;
    const acumuladorModif = clasesSeleccionadas.length === 1;

    $btnBaja.disabled = !acumuladorBaja;
    $btnModificar.disabled = !acumuladorModif;
  }


  $checkboxModifyDelete.forEach(checkbox => {
    checkbox.addEventListener('change', (e) => {
      const id_clase = checkbox.value;
      if (checkbox.checked) {
        if (!clasesSeleccionadas.includes(id_clase)) {  //Verifica si el ID del checkbox no esta en el array clasesSeleccionadas
          clasesSeleccionadas.push(id_clase);  // Si no esta en el array , lo agrega
        }
      }
      else {
        clasesSeleccionadas = clasesSeleccionadas.filter(clases_seleccionadas => clases_seleccionadas !== id_clase);  //Actualiza el array quitando los checkbox que se deseleccionaron
      }

      estadoBtns();

      // Convertir array a JSON y enviarlo al servidor
      var arrayJSON = JSON.stringify(clasesSeleccionadas)
      fetch('peticion_POST.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ arrayJSON: arrayJSON })
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok')
          }
          return response.text()
        })
        .then(data => {
          console.log(data)
        })
        .catch(error => {
          console.error('Hubo un problema con el fetching de datos:', error)
        });
    });
  });

  fn_button_alta($btnAlta, $closeModal);
  fn_button_modificacion($btnModificar, $closeModal3);
  fn_button_baja($btnBaja, $closeModal2);
});
