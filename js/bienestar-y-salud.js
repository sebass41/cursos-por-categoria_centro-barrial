import { generarCarrusel } from "./carrousel.js";

const cursos = [
    {
        nombre: "Yoga en sillas",
        descripcion: "Práctica de yoga en sillas.",
        dias: "Lunes y Viernes",
        horario: "No definido",
        costo: "$ 1100 dos veces por semana y $ 800 una vez por semana",
        docente: "Gabriela Fromaget",
        whatsapp: "59892772677",
        imagen: "../assets/flyers/yoga-en-sillas.jpg"
    },

    {
        nombre: "Yoga integral comunitario",
        descripcion: "Práctica de yoga integral en un entorno comunitario.",
        dias: "Lunes y Miércoles",
        horario: "No definido",
        costo: "$ 1200 por mes",
        docente: "María de los Milagros Nocetti",
        whatsapp: "59891041599",
        imagen: "../assets/flyers/yoga-integral-comunitario.jpg"
    },

    {
        nombre: "Taller de educación emocional",
        descripcion: "Taller de educación emocional para desarrollar habilidades de manejo de emociones.",
        dias: "Lunes",
        horario: "No definido",
        costo: "$ 1000 por mes",
        docente: "Marelene Carro",
        whatsapp: "59896982498",
        imagen: "../assets/flyers/taller-de-educacion-emocional.jpeg"
    },
    {
        nombre: "Meditación y mindfulness",
        descripcion: "Práctica de meditación y mindfulness para reducir el estrés y mejorar la concentración.",
        dias: "Miércoles",
        horario: "No definido",
        costo: "$ 1000 por mes",
        docente: "Flavia Silveira",
        whatsapp: "59898219513",
        imagen: "../assets/flyers/meditacion-y-mindfulness.jpg"
    },
    {
        nombre: "Clases de yoga",
        descripcion: "Práctica de yoga para mejorar la flexibilidad y el bienestar general.",
        dias: "Viernes",
        horario: "No definido",
        costo: "$ 350 por clase",
        docente: "Mariana Rodríguez",
        whatsapp: "59892877497",
        imagen: "../assets/flyers/yoga.jpg"
    }
];

generarCarrusel(cursos, "Bienestar y Salud");