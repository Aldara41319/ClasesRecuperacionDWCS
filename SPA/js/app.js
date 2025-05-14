document.addEventListener("DOMContentLoaded", function () {
    function cargarContenido(pagina) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "contenido/" + pagina + ".php", true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                document.getElementById("contenido").innerHTML = xhr.responseText;
            } else {
                document.getElementById("contenido").innerHTML = "<p>Error al cargar la página.</p>";
            }
        };
        xhr.send();
    }

    // Cargar contenido por defecto
    cargarContenido("home");

    // Añadir eventos a los enlaces
    document.querySelectorAll("nav a").forEach(function (enlace) {
        enlace.addEventListener("click", function () {
            const pagina = this.getAttribute("data-page");
            cargarContenido(pagina);
            history.pushState(null, "", "#!" + pagina); // opcional para mostrar en la URL (sin recargar)
        });
    });

    // Manejo de navegación con el botón "Atrás"
    window.addEventListener("popstate", function () {
        const hash = location.hash.replace("#!", "") || "home";
        cargarContenido(hash);
    });
});
