export function generarCarrusel(cursos, categoría) {
    const carousel = document.getElementById("carouselCursos");
    const indicadores = document.getElementById("carouselIndicadores");

    cursos.forEach((curso, index) => {

        const item = document.createElement("div");
        item.className = `carousel-item ${index === 0 ? "active" : ""}`;

        item.innerHTML = `
            <article class="course-card">

                <div class="flyer-wrapper">
                    <img
                        src="${curso.imagen}"
                        alt="Flyer del curso ${curso.nombre}"
                    >
                </div>

                <div class="course-info">

                    <span class="course-category">${categoría}</span>

                    <h3 class="course-title">
                        ${curso.nombre}
                    </h3>

                    <div class="course-data">

                        <div class="data-row">
                            <span class="data-icon" aria-hidden="true">
                                <i class="bi bi-calendar3"></i>
                            </span>
                            <div>
                                <span class="data-label">Días</span>
                                <span class="data-value">${curso.dias}</span>
                            </div>
                        </div>

                        <div class="data-row">
                            <span class="data-icon" aria-hidden="true">
                                <i class="bi bi-clock"></i>
                            </span>
                            <div>
                                <span class="data-label">Horario</span>
                                <span class="data-value">${curso.horario}</span>
                            </div>
                        </div>

                        <div class="data-row">
                            <span class="data-icon" aria-hidden="true">
                                <i class="bi bi-cash-coin"></i>
                            </span>
                            <div>
                                <span class="data-label">Costo</span>
                                <span class="data-value">${curso.costo}</span>
                            </div>
                        </div>

                        <div class="data-row">
                            <span class="data-icon" aria-hidden="true">
                                <i class="bi bi-person"></i>
                            </span>
                            <div>
                                <span class="data-label">Docente</span>
                                <span class="data-value">${curso.docente}</span>
                            </div>
                        </div>

                    </div>

                    <a
                        class="whatsapp-btn"
                        href="https://wa.me/${curso.whatsapp}"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Contactar por WhatsApp al docente de ${curso.nombre}"
                    >
                        <i class="bi bi-whatsapp" aria-hidden="true"></i>
                        Consultar por WhatsApp
                    </a>

                </div>

            </article>
        `;

        carousel.appendChild(item);


        const indicador = document.createElement("button");

        indicador.type = "button";
        indicador.dataset.bsTarget = "#cursosCarousel";
        indicador.dataset.bsSlideTo = index;
        indicador.setAttribute(
            "aria-label",
            `Mostrar curso ${index + 1}: ${curso.nombre}`
        );

        if (index === 0) {
            indicador.classList.add("active");
            indicador.setAttribute("aria-current", "true");
        }

        indicadores.appendChild(indicador);
    });
}
