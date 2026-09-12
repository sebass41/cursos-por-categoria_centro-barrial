import { generarCarrusel } from "./carrousel.js";

const cursos = [
    {
        nombre: "De la huerta a la mesa",
        descripcion: "Clases de cocina y huerta para aprender a cultivar y preparar alimentos saludables.",
        dias: "Miércoles",
        horario: "No definido",
        costo: "$ 500",
        docente: "Cristina Valiente",
        whatsapp: "59898172421",
        imagen: "../assets/flyers/huerta-mesa.jpg"
    },

    {
        nombre: "Pequeños chefs: cocinar, crear y compartir",
        descripcion: "Clases para niños y niñas sobre cocina, creación y compartir comidas saludables.",
        dias: "Miércoles",
        horario: "No definido",
        costo: "$ 200 por clase",
        docente: "Catherine Command",
        whatsapp: "59891219118",
        imagen: "../assets/flyers/pequenos-chefs.jpg"
    }
];

generarCarrusel(cursos, "COCINA, HUERTA Y ALIMENTACIÓN");