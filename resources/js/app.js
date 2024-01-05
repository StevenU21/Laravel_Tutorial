import "./bootstrap";
import Swal from "sweetalert2";

window.addEventListener("success", (event) => {
    Swal.fire({
        title: "¡Éxito!",
        text: "Renta Registrada con éxito.",
        icon: "success",
        confirmButtonText: "OK",
    });
});

window.addEventListener("danger", (event) => {
    Swal.fire({
        title: "¡Éxito!",
        text: "Renta Eliminada con éxito.",
        icon: "danger",
        confirmButtonText: "OK",
    });
});

window.addEventListener("error", (event) => {
    Swal.fire({
        title: "¡Ups!",
        text: "Parece que algo Salió Mal :(.",
        icon: "warning",
        confirmButtonText: "OK",
    });
});

window.addEventListener("message", (event) => {
    Swal.fire({
        title: "¡Éxito!",
        text: "Renta Actualizada con éxito.",
        icon: "info",
        confirmButtonText: "OK",
    });
});



