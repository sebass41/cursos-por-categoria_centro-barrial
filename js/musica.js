import { generarCarrusel } from "./carrousel.js";

const cursos = [
    {
        nombre: "Guitarra",
        descripcion: "Aprende a tocar la guitarra con nuestro curso de iniciación.",
        dias: "Lunes y miércoles",
        horario: "No definido",
        costo: "$ 1400 por mes",
        docente: "Marianella Rodriguez",
        whatsapp: "59899764461",
        imagen: "./assets/flyers/guitarra.jpg"
    },

    {
        nombre: "Coro de niños",
        descripcion: "Participa en nuestro coro de niños y desarrolla tu voz musical.",
        dias: "Miércoles",
        horario: "No definido",
        costo: "$ 800 por mes",
        docente: "Marianella Rodriguez",
        whatsapp: "59899764461",
        imagen: "./assets/flyers/coro-ninos.jpg"
    },

    {
        nombre: "Taller integral de murga",
        descripcion: "Participa en nuestro taller integral de murga y desarrolla tus habilidades musicales.",
        dias: "Martes y jueves",
        horario: "No definido",
        costo: "$ 1500 taller entero",
        docente: "Pedro Sirito",
        whatsapp: "59893876556",
        imagen: "./assets/flyers/murga.jpeg"
    },

    {
        nombre: "Taller de canto, guitarra, teclado y ukelele",
        descripcion: "Participa en nuestro taller de canto, guitarra, teclado y ukelele y desarrolla tus habilidades musicales.",
        dias: "Miércoles",
        horario: "No definido",
        costo: "$ 1600 por mes",
        docente: "Leandro Giribone",
        whatsapp: "59899319585",
        imagen: "./assets/flyers/musica-giribone.png"
    }
];

generarCarrusel(cursos, "MÚSICA");