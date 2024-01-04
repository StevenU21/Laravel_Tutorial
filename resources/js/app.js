import "./bootstrap";
import Swal from "sweetalert2";

window.addEventListener("success", (event) => {
    Swal.fire({
        title: "¡Éxito!",
        text: "Producto Creado con éxito.",
        icon: "success",
        confirmButtonText: "OK",
    });
});

window.addEventListener("message", (event) => {
    Swal.fire({
        title: "¡Éxito!",
        text: "Producto Actualizado con éxito.",
        icon: "info",
        confirmButtonText: "OK",
    });
});

window.addEventListener("danger", (event) => {
    Swal.fire({
        title: "¡Éxito!",
        text: "Producto Borrado con éxito.",
        icon: "warning",
        confirmButtonText: "OK",
    });
});

