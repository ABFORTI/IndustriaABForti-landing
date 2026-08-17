const SVG_NS = 'http://www.w3.org/2000/svg';

export function initLogistics() {
    initLogisticsRoutes();
    initLogisticsDrawer();
    initCompanyCards();
    initGotoCenter();
}

function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

function buildPathD(points) {
    return points
        .map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`)
        .join(' ');
}


function initLogisticsRoutes() {
    const root = document.querySelector('[data-logistics-map-root]');
    const svg = root?.querySelector('[data-logistics-routes]');
    const dataScript = root?.querySelector('[data-logistics-routes-data]');

    if (!root || !svg || !dataScript) {
        return;
    }

    let routes = [];
    try {
        routes = JSON.parse(dataScript.textContent || '[]');
    } catch {
        return;
    }

    const reduceMotion = prefersReducedMotion();

    routes.forEach((route) => {
        if (!Array.isArray(route.points) || route.points.length < 2) {
            return;
        }

        const d = buildPathD(route.points);
        const mode = route.mode === 'sea' ? 'sea' : 'land';

        const path = document.createElementNS(SVG_NS, 'path');
        path.setAttribute('d', d);
        path.setAttribute('class', `logistics-route logistics-route--${mode}`);
        path.dataset.routeId = route.id;

        const title = document.createElementNS(SVG_NS, 'title');
        title.textContent = `${route.label}: ${route.description}`;
        path.appendChild(title);

        svg.appendChild(path);

        if (reduceMotion) {
            return;
        }

        const particle = document.createElementNS(SVG_NS, 'circle');
        particle.setAttribute('r', '4');
        particle.setAttribute('class', `logistics-route__particle logistics-route__particle--${mode}`);

        const motion = document.createElementNS(SVG_NS, 'animateMotion');
        motion.setAttribute('dur', mode === 'sea' ? '7s' : '5s');
        motion.setAttribute('repeatCount', 'indefinite');
        motion.setAttribute('rotate', 'auto');
        motion.setAttribute('path', d);

        particle.appendChild(motion);
        svg.appendChild(particle);
    });
}

function initLogisticsDrawer() {
    const root = document.querySelector('[data-logistics-map-root]');
    const drawer = root?.querySelector('[data-logistics-drawer]');
    const backdrop = root?.querySelector('[data-logistics-drawer-backdrop]');

    if (!root || !drawer) {
        return;
    }

    const fields = {
        company: drawer.querySelector('[data-drawer-company]'),
        city: drawer.querySelector('[data-drawer-city]'),
        sector: drawer.querySelector('[data-drawer-sector]'),
        segments: drawer.querySelector('[data-drawer-segments]'),
        services: drawer.querySelector('[data-drawer-services]'),
    };

    const renderTags = (container, items) => {
        if (!container) return;
        container.innerHTML = '';
        (items || []).forEach((item) => {
            const tag = document.createElement('span');
            tag.className = 'logistics-drawer__tag';
            tag.textContent = item;
            container.appendChild(tag);
        });
    };

    const open = (meta) => {
        if (fields.company) fields.company.textContent = meta.company || 'UpperLogistics';
        if (fields.city) fields.city.textContent = meta.city || '';
        if (fields.sector) fields.sector.textContent = [meta.sector, meta.state].filter(Boolean).join(' · ');
        renderTags(fields.segments, meta.segments);
        renderTags(fields.services, meta.services);

        drawer.classList.add('is-open');
        drawer.setAttribute('aria-hidden', 'false');
        backdrop?.classList.add('is-open');
    };

    const close = () => {
        drawer.classList.remove('is-open');
        drawer.setAttribute('aria-hidden', 'true');
        backdrop?.classList.remove('is-open');
    };

    root.querySelectorAll('[data-marker][data-marker-type="center"]').forEach((marker) => {
        marker.addEventListener('click', () => {
            if (!marker.dataset.meta) return;

            try {
                open(JSON.parse(marker.dataset.meta));
            } catch {
                // data-meta inválido: no bloquea el resto de la interacción del mapa.
            }
        });
    });

    drawer.querySelector('[data-logistics-drawer-close]')?.addEventListener('click', close);
    backdrop?.addEventListener('click', close);

    document.addEventListener('click', (event) => {
        if (!root.contains(event.target) && event.target !== backdrop) {
            close();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            close();
        }
    });
}

/**
 * UpperLogistics / Control Up Logistics: expansión por hover (CSS) o por
 * click/teclado (BRIEF §3). El hover puro ya lo resuelve app.css; aquí solo
 * se agrega el estado persistente para touch y accesibilidad por teclado.
 */
function initCompanyCards() {
    const cards = document.querySelectorAll('[data-company-card]');

    if (!cards.length) {
        return;
    }

    cards.forEach((card) => {
        const toggle = () => {
            const expanded = card.classList.toggle('is-expanded');
            card.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        };

        card.addEventListener('click', toggle);
        card.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                toggle();
            }
        });
    });
}

/**
 * "Seleccionar UpperLogistics → mostrar sus centros → seleccionar centro"
 * (BRIEF §7): un chip de empresa hace scroll al mapa y abre el drawer del
 * centro correspondiente, todo en la misma vista.
 */
function initGotoCenter() {
    const buttons = document.querySelectorAll('[data-goto-center]');

    if (!buttons.length) {
        return;
    }

    const reduceMotion = prefersReducedMotion();

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const marker = document.querySelector(
                `[data-map-instance="logistica-network"] [data-marker][data-slug="${button.dataset.gotoCenter}"]`
            );

            if (!marker) return;

            marker.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'center' });
            window.setTimeout(() => marker.click(), reduceMotion ? 0 : 450);
        });
    });
}
