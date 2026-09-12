import { generarCarrusel } from "./carrousel.js";

const cursos = [
    {
        nombre: "Herramientas Digitales Básicas",
        descripcion: "Propuesta para aprender, crear y compartir en el entorno digital.",
        dias: "Viernes",
        horario: "No definido",
        costo: "$ 500 mensual",
        docente: "Matías Otte",
        whatsapp: "59891002902",
        imagen: "./assets/flyers/herramientas-digitales.jpg"
    },

    {
        nombre: "Ajedrez",
        descripcion: "Espacio de aprendizaje y práctica del ajedrez.",
        dias: "Martes",
        horario: "No definido",
        costo: "$ 250 por clase",
        docente: "Juan Froste",
        whatsapp: "59898626661",
        imagen: "./assets/flyers/ajedrez.jpg"
    },

    {
        nombre: "Apoyo Liceal",
        descripcion: "Apoyo académico para estudiantes de nivel secundario.",
        dias: "Viernes",
        horario: "No definido",
        costo: "$ 450 por clase",
        docente: "Andrea Tourn",
        whatsapp: "59899933662",
        imagen: "./assets/flyers/apoyo-liceal.jpeg"
    },
    {
        nombre: "Reparación de celulares",
        descripcion: "Aprendizaje práctico sobre reparación de dispositivos móviles.",
        dias: "Martes",
        horario: "No definido",
        costo: "$ 3500 por mes",
        docente: "Julio Brites",
        whatsapp: "59899002332",
        imagen: "./assets/flyers/reparacion-de-celulares.jpeg"
    }
];

generarCarrusel(cursos, "Apoyo y Formación");