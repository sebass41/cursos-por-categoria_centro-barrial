import { generarCarrusel } from "./carrousel.js";

const cursos = [
    {
        nombre: "Manicura - Semi permanente",
        descripcion: "Práctica de manicura con esmalte semi-permanente.",
        dias: "Martes",
        horario: "No definido",
        costo: "$ 3000 por curso completo",
        docente: "Analía González",
        whatsapp: "59899421622",
        imagen: "../assets/flyers/manicura.jpg"
    },

    {
        nombre: "Crochet",
        descripcion: "Práctica de crochet para desarrollar habilidades de tejido.",
        dias: "Viernes",
        horario: "15:00 a 17:00",
        costo: "$ 350 por mes",
        docente: "María de los Milagros Nocetti",
        whatsapp: "59891486672",
        imagen: "../assets/flyers/crochet.jpg"
    },

    {
        nombre: "Costura Dinámica",
        descripcion: "Práctica de costura para desarrollar habilidades de confección.",
        dias: "Lunes y Jueves",
        horario: "No definido",
        costo: "$ 850 estimado",
        docente: "Verónica Janavel",
        whatsapp: "59898806186",
        imagen: "../assets/flyers/costura-dinamica.jpg"
    },
    {
        nombre: "Jabones y Velas",
        descripcion: "Práctica de elaboración de jabones y velas artesanales.",
        dias: "Lunes y Jueves",
        horario: "No definido",
        costo: "$ 850 estimado",
        docente: "Verónica Janavel",
        whatsapp: "59898806186",
        imagen: "../assets/flyers/jabones-y-velas.jpg"
    },
    {
        nombre: "Kokedamas",
        descripcion: "Práctica de elaboración de kokedamas para desarrollar habilidades de diseño.",
        dias: "Lunes y Jueves",
        horario: "No definido",
        costo: "$ 850 estimado",
        docente: "Verónica Janavel",
        whatsapp: "59898806186",
        imagen: "../assets/flyers/kokedamas.jpg"
    }
];

generarCarrusel(cursos, "Artesanías y Oficios Creativos");