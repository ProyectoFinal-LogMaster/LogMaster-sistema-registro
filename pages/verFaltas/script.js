const buttons = document.getElementsByClassName("ver-mas-btn");

for (let button of buttons) {
  button.addEventListener("click", (e) => {
    const section = button.parentElement;
    const justificacion = section.lastElementChild;

    if (!justificacion.classList.contains("visible")) {
      justificacion.classList.add("visible");
      button.textContent = "Ver menos";
    } else {
      justificacion.classList.remove("visible");
      button.textContent = "Ver más";
    }
  });
}
