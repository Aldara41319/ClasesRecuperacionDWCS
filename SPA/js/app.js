document.addEventListener("DOMContentLoaded", function () {
    const contenido = document.getElementById("contenido");
    const loader = document.getElementById("loader");

    function cargarContenido(pagina) {
        loader.style.display = "block";
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "contenido/" + pagina + ".php", true);
        xhr.onload = function () {
            loader.style.display = "none";
            if (xhr.status === 200) {
                contenido.innerHTML = xhr.responseText;
            } else {
                contenido.innerHTML = "<p>Error al cargar la página.</p>";
            }
        };
        xhr.send();
    }

    document.querySelectorAll("nav a").forEach(function (enlace) {
        enlace.addEventListener("click", function () {
            const pagina = this.getAttribute("data-page");
            cargarContenido(pagina);
            history.pushState(null, "", "#!" + pagina);
        });
    });

    // Carga inicial
    const hash = location.hash.replace("#!", "") || "home";
    cargarContenido(hash);

    window.addEventListener("popstate", function () {
        const hash = location.hash.replace("#!", "") || "home";
        cargarContenido(hash);
    });
});
