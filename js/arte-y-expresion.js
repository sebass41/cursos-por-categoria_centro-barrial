import { generarCarrusel } from "./carrousel.js";

const cursos = [
    {
        nombre: "Teatro para adultos mayores",
        descripcion: "Práctica de teatro para adultos mayores.",
        dias: "Jueves",
        horario: "No definido",
        costo: "$ 800 por mes",
        docente: "Yéssica Ramírez",
        whatsapp: "59899791845",
        imagen: "./assets/flyers/teatro.jpeg"
    },

    {
        nombre: "Del dibujo a la historia",
        descripcion: "Práctica de dibujo y narración para desarrollar habilidades artísticas.",
        dias: "Martes y Jueves",
        horario: "No definido",
        costo: "$ 800 por mes",
        docente: "Brian Lechini",
        whatsapp: "59898499705",
        imagen: "./assets/flyers/dibujo-a-historia.jpg"
    },

    {
        nombre: "Dibujo y pintura",
        descripcion: "Práctica de dibujo y pintura para desarrollar habilidades artísticas.",
        dias: "Martes y Miércoles",
        horario: "No definido",
        costo: "$ 800 por mes",
        docente: "Fany Acosta",
        whatsapp: "59892240132",
        imagen: "./assets/flyers/dibujo-y-pintura.jpg"
    },
    {
        nombre: "Trabajos en yeso",
        descripcion: "Práctica de elaboración de trabajos en yeso para desarrollar habilidades de escultura.",
        dias: "Lunes y Jueves",
        horario: "No definido",
        costo: "$ 850 estimado",
        docente: "Verónica Janavel",
        whatsapp: "59898806186",
        imagen: "./assets/flyers/yeso.png"
    }
];

generarCarrusel(cursos, "ARTESANIAS Y OFICIOS CREATIVOS");