document.addEventListener("DOMContentLoaded", function() {
    var header = document.querySelector("header");
    
    window.addEventListener("scroll", function() {
        if (window.scrollY > 50) { // Cambia este valor según cuándo quieras que cambie el color
            header.classList.add("solid");
            header.classList.remove("transparent");
        } else {
            header.classList.add("transparent");
            header.classList.remove("solid");
        }
    });
});

