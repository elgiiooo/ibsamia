document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('multi-step-form');
  const steps = form.querySelectorAll('.step');

  steps.forEach((step, stepIndex) => {
    const options = step.querySelectorAll('.radio-option');
    const nextBtn = step.querySelector('.next-step');
    const inputName = step.querySelector('input[type="radio"]')?.name;

    if (!options.length || !nextBtn || !inputName) return;

    // Hacer opciones focusables
    options.forEach(opt => opt.setAttribute('tabindex', '0'));

    // Función para habilitar el botón si hay algo seleccionado
    function updateNextButton() {
      const checked = step.querySelector(`input[name="${inputName}"]:checked`);
      if (checked) {
        nextBtn.disabled = false;
        nextBtn.setAttribute('aria-disabled', 'false');
      } else {
        nextBtn.disabled = true;
        nextBtn.setAttribute('aria-disabled', 'true');
      }
    }

    // Seleccionar y enfocar automáticamente la primera opción
    const firstOption = options[0];
    if (firstOption) {
      const firstRadio = firstOption.querySelector('input[type="radio"]');
      if (firstRadio) {
        firstRadio.checked = true;
        firstRadio.dispatchEvent(new Event('change', { bubbles: true }));
        updateNextButton();
      }
      // Dar foco al div
      setTimeout(() => {
        firstOption.focus();
      }, 100);
    }

    // Navegación con teclado dentro del paso
    options.forEach((option, index) => {
      option.addEventListener('keydown', e => {
        const key = e.key;

        if (['ArrowRight', 'ArrowDown'].includes(key)) {
          e.preventDefault();
          if (index < options.length - 1) {
            options[index + 1].focus();
          } else {
            nextBtn.focus(); // última opción -> botón
          }
        }

        if (['ArrowLeft', 'ArrowUp'].includes(key)) {
          e.preventDefault();
          if (index > 0) {
            options[index - 1].focus();
          }
        }

        if (key === 'Enter' || key === ' ') {
          e.preventDefault();
          const radio = option.querySelector('input[type="radio"]');
          if (radio) {
            radio.checked = true;
            radio.dispatchEvent(new Event('change', { bubbles: true }));
            updateNextButton();
          }
        }
      });

      // También con clic
      option.addEventListener('click', () => {
        const radio = option.querySelector('input[type="radio"]');
        if (radio) {
          radio.checked = true;
          radio.dispatchEvent(new Event('change', { bubbles: true }));
          updateNextButton();
        }
      });
    });

    // Botón también accesible con teclado
    nextBtn.setAttribute('tabindex', '0');
    nextBtn.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        nextBtn.click();
      }

      if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
        e.preventDefault();
        options[options.length - 1].focus(); // volver a última opción
      }
    });
  });
});
