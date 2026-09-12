import { generarCarrusel } from "./carrousel.js";

const cursos = [
    {
        nombre: "Ritmos + Funcional",
        descripcion: "Clases de ritmos y funcional para mejorar la condición física y coordinación.",
        dias: "Martes y Jueves",
        horario: "No definido",
        costo: "$ 800 por mes o $ 180 por clase",
        docente: "Jessica Barolin",
        whatsapp: "59899000870",
        imagen: "../assets/flyers/funcional.jpeg"
    },

    {
        nombre: "Taekwondo",
        descripcion: "Práctica de taekwondo para desarrollar habilidades de lucha y condición física.",
        dias: "Martes y Jueves",
        horario: "No definido",
        costo: "$ 1800 por mes",
        docente: "Marcelo Morales",
        whatsapp: "5989397522",
        imagen: "../assets/flyers/taekwondo.jpeg"
    }
];

generarCarrusel(cursos, "MOVIMIENTO Y EXPRESIÓN");