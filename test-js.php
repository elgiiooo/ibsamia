	// Función para activar la navegación accesible en el step dado
function activateKeyboardNavigation(step) {
  const options = step.querySelectorAll('.radio-option');
  const nextBtn = step.querySelector('.next-step');
  const prevBtn = step.querySelector('.prev-step');
  const inputName = step.querySelector('input[type="radio"]')?.name;

  if (!options.length || !nextBtn || !inputName) return;

  options.forEach(opt => opt.setAttribute('tabindex', '0'));

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

  // Seleccionar primera opción si no hay ninguna seleccionada
  if (!step.querySelector(`input[name="${inputName}"]:checked`)) {
    const firstRadio = options[0].querySelector('input[type="radio"]');
    if (firstRadio) {
      firstRadio.checked = true;
      firstRadio.dispatchEvent(new Event('change', { bubbles: true }));
      options[0].focus(); // <-- Foco en el primer div radio-option
    }
  }
  updateNextButton();

  options.forEach((option, index) => {
    option.addEventListener('keydown', e => {
      const key = e.key;

      if (['ArrowRight', 'ArrowDown'].includes(key)) {
        e.preventDefault();
        if (index < options.length - 1) options[index + 1].focus();
        else nextBtn.focus();
      }

      if (['ArrowLeft', 'ArrowUp'].includes(key)) {
        e.preventDefault();
        if (index > 0) options[index - 1].focus();
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

    option.addEventListener('click', () => {
      const radio = option.querySelector('input[type="radio"]');
      if (radio) {
        radio.checked = true;
        radio.dispatchEvent(new Event('change', { bubbles: true }));
        updateNextButton();
      }
    });
  });

  nextBtn.setAttribute('tabindex', '0');
  nextBtn.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      nextBtn.click();
    }
    if (e.key === 'ArrowLeft') {
      e.preventDefault();
      if (prevBtn) prevBtn.focus();
      else options[options.length - 1].focus();
    }
    if (e.key === 'ArrowRight') {
      e.preventDefault();
      // Puedes decidir qué hacer si se presiona flecha derecha en nextBtn
      // Por ahora, no hago nada para no romper la lógica.
    }
    if (e.key === 'ArrowUp') {
      e.preventDefault();
      options[options.length - 1].focus();
    }
  });

  if (prevBtn) {
    prevBtn.setAttribute('tabindex', '0');
    prevBtn.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        prevBtn.click();
      }
      if (e.key === 'ArrowRight') {
        e.preventDefault();
        nextBtn.focus();
      }
      if (e.key === 'ArrowLeft') {
        e.preventDefault();
        // Opcional: si quieres ir al último option o algún otro foco
        options[0].focus();
      }
      if (e.key === 'ArrowUp') {
        e.preventDefault();
        options[options.length - 1].focus();
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('multi-step-form');
  const steps = Array.from(form.querySelectorAll('.step'));
  let currentStepIndex = steps.findIndex(step => step.classList.contains('visible'));

  if (currentStepIndex === -1) currentStepIndex = 0;
  activateKeyboardNavigation(steps[currentStepIndex]);

  form.addEventListener('click', (event) => {
    const nextBtn = event.target.closest('.next-step');
    const prevBtn = event.target.closest('.prev-step');

    if (nextBtn) {
      event.preventDefault();

      steps[currentStepIndex].classList.remove('visible');
      currentStepIndex = Math.min(currentStepIndex + 1, steps.length - 1);
      steps[currentStepIndex].classList.add('visible');

      setTimeout(() => {
        activateKeyboardNavigation(steps[currentStepIndex]);
      }, 50);
    }

    if (prevBtn) {
      event.preventDefault();

      steps[currentStepIndex].classList.remove('visible');
      currentStepIndex = Math.max(currentStepIndex - 1, 0);
      steps[currentStepIndex].classList.add('visible');

      setTimeout(() => {
        activateKeyboardNavigation(steps[currentStepIndex]);
      }, 50);
    }
  });
});
