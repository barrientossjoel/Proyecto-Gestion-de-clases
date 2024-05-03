
import { fn_button_alta, fn_button_modificacion, fn_button_baja } from "./app.js"

const d = document

d.addEventListener("DOMContentLoaded", () => {
  const $closeModal = d.querySelector(".modal__close")
  const $closeModal2 = d.querySelector(".modal2__close")
  const $closeModal3 = d.querySelector(".modal3__close")

  const $btnAlta = d.getElementById("id-btn-alta")
  const $btnModificar = d.getElementById("id-btn-modificar")
  const $btnBaja = d.getElementById("id-btn-baja")
  const $checkboxModifyDelete = d.querySelectorAll(".input-checkbox-register");

  // inhabilitar o habilitar btn-baja:
  var acumuladorBaja = 0;
  var acumuladorModif = 0;
  var array = [];

  for (let i = 0; i < $checkboxModifyDelete.length; i++) {
    $checkboxModifyDelete[i].addEventListener("click", (e) => {
      // e.preventDefault()
      $btnBaja.removeAttribute('disabled');
      $btnModificar.removeAttribute('disabled');

      if ($checkboxModifyDelete[i].checked) {
        acumuladorBaja++;
        acumuladorModif++;
        if (acumuladorBaja >= 1 && acumuladorModif == 1) {
          array[i] = $checkboxModifyDelete[i].value;
          // console.log('Checkbox seleccionado: ' + array[i]);
          console.log('Checkbox seleccionado. \nClase: ' + $checkboxModifyDelete[i].id + '\nValor: ' + $checkboxModifyDelete[i].value);
        }
        else if (acumuladorBaja >= 1 && acumuladorModif != 1) {
          $btnModificar.setAttribute('disabled', "true");
          array[i] = $checkboxModifyDelete[i].value;
          // console.log('Checkbox seleccionado: ' + array[i]);
          console.log('Checkbox seleccionado. \nClase: ' + $checkboxModifyDelete[i].id + '\nValor: ' + $checkboxModifyDelete[i].value);
        }
      } else {
        acumuladorBaja--;
        acumuladorModif--;
        array.splice(i, 1); // elimino del array el valor del chechbox indicado.
        console.log('Checkbox no seleccionado. \nClase: ' + $checkboxModifyDelete[i].id + '\nValor: ' + $checkboxModifyDelete[i].value);
        if (acumuladorBaja == 0) {
          $btnBaja.setAttribute('disabled', "true");
        }
        if (acumuladorModif == 0) {
          $btnModificar.setAttribute('disabled', "true");
        }
      }

      // Convertir array a JSON y enviarlo al servidor
      var arrayJSON = JSON.stringify(array)
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
  }

  fn_button_alta($btnAlta, $closeModal)
  fn_button_modificacion($btnModificar, $closeModal3)
  fn_button_baja($btnBaja, $closeModal2)
});
