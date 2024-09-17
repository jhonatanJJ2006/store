(function() {
    const menu = document.querySelector("#menu");
    const menuMovil = document.querySelector(".barra__movil");
    const xIcon = document.querySelector(".barra__movil--x");
    const opacidad = document.querySelector(".barra__opacidad");

    if(menu) {

      menu.addEventListener("click", function() {
        menuMovil.classList.toggle("barra__activo");
        toggleScroll(); // Deshabilitar o habilitar el scroll
      });
    
      xIcon.addEventListener("click", function() {
        menuMovil.classList.remove("barra__activo");
        toggleScroll(); // Deshabilitar o habilitar el scroll
      });
  
      opacidad.addEventListener("click", function() {
        menuMovil.classList.remove("barra__activo");
        toggleScroll(); // Deshabilitar o habilitar el scroll
      });
  
      function toggleScroll() {
        document.body.classList.toggle("no-scroll");
      }
      
    }
  
})();
