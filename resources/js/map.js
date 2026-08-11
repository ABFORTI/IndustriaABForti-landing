export function initMexicoMaps() {
    document.querySelectorAll('[data-map-instance]').forEach(initMapInstance);
}

function initMapInstance(root) {
    const svg = root.querySelector(':scope > svg[role="img"]');
    const markersLayer = root.querySelector('[data-map-markers]');
    const connectionsLayer = root.querySelector('[data-map-connections]');
    const tooltip = root.querySelector('[data-map-tooltip]');

    if (!svg || !markersLayer) {
        return;
    }

    const viewBox = svg.viewBox && svg.viewBox.baseVal;
    const vbWidth = viewBox && viewBox.width ? viewBox.width : 1000;
    const vbHeight = viewBox && viewBox.height ? viewBox.height : 630;

    const markers = Array.from(markersLayer.querySelectorAll('[data-marker]'));
    const points = [];
    let describedElements = [];

    const clearHighlights = () => {
        markers.forEach((m) => m.classList.remove('is-hovered'));
        root.querySelectorAll('[data-active-location]').forEach((el) => el.classList.remove('is-highlighted'));
    };

    const clearPins = () => {
        markers.forEach((m) => m.classList.remove('is-pinned'));
    };

    const showTooltip = (marker, stateEl) => {
        if (!tooltip) return;

        tooltip.innerHTML = `
            <p class="map-tooltip__city">${marker.dataset.city}</p>
            <p class="map-tooltip__state">${marker.dataset.stateName}</p>
            <p class="map-tooltip__tags">${marker.dataset.highlights}</p>
        `;
        tooltip.style.left = marker.style.left;
        tooltip.style.top = marker.style.top;
        // El tooltip toma el color de la división de la ubicación activa.
        tooltip.style.setProperty('--marker-color', `var(--color-${marker.dataset.accent})`);
        tooltip.hidden = false;

        describedElements = [marker, stateEl].filter(Boolean);
        describedElements.forEach((el) => el.setAttribute('aria-describedby', tooltip.id));
    };

    const hideTooltip = () => {
        if (tooltip) {
            tooltip.hidden = true;
        }
        describedElements.forEach((el) => el.removeAttribute('aria-describedby'));
        describedElements = [];
    };

    const activate = (marker, stateEl) => {
        clearHighlights();
        marker.classList.add('is-hovered');
        if (stateEl) {
            stateEl.classList.add('is-highlighted');
        }
        showTooltip(marker, stateEl);
    };

    const forceDeactivate = (marker, stateEl) => {
        marker.classList.remove('is-hovered', 'is-pinned');
        if (stateEl) {
            stateEl.classList.remove('is-highlighted');
        }
        hideTooltip();
    };

    const deactivate = (marker, stateEl) => {
        if (marker.classList.contains('is-pinned')) {
            return;
        }
        forceDeactivate(marker, stateEl);
    };

    markers.forEach((marker) => {
        const pointEl = svg.querySelector(`#${CSS.escape(marker.dataset.pointId)}`);
        const stateEl = svg.querySelector(`#${CSS.escape(marker.dataset.stateId)}`);

        if (!pointEl) {
            return;
        }

        const cx = parseFloat(pointEl.getAttribute('cx'));
        const cy = parseFloat(pointEl.getAttribute('cy'));

        marker.style.left = `${(cx / vbWidth) * 100}%`;
        marker.style.top = `${(cy / vbHeight) * 100}%`;

        points.push({ slug: marker.dataset.slug, accent: marker.dataset.accent, cx, cy });

        marker.addEventListener('mouseenter', () => activate(marker, stateEl));
        marker.addEventListener('mouseleave', () => deactivate(marker, stateEl));
        marker.addEventListener('focus', () => activate(marker, stateEl));
        marker.addEventListener('blur', () => deactivate(marker, stateEl));

        const togglePin = () => {
            const wasPinned = marker.classList.contains('is-pinned');
            clearPins();

            if (wasPinned) {
                forceDeactivate(marker, stateEl);
            } else {
                marker.classList.add('is-pinned');
                activate(marker, stateEl);
            }
        };

        marker.addEventListener('click', togglePin);

        if (stateEl) {
            stateEl.addEventListener('mouseenter', () => activate(marker, stateEl));
            stateEl.addEventListener('mouseleave', () => deactivate(marker, stateEl));
            stateEl.addEventListener('click', togglePin);
            stateEl.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    togglePin();
                }
            });
        }
    });

    if (connectionsLayer) {
        const hub = points.find((p) => p.slug === 'cdmx');

        if (hub) {
            points
                .filter((p) => p.slug !== 'cdmx')
                .forEach((point) => {
                    const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                    line.setAttribute('x1', String(hub.cx));
                    line.setAttribute('y1', String(hub.cy));
                    line.setAttribute('x2', String(point.cx));
                    line.setAttribute('y2', String(point.cy));
                    line.setAttribute('class', 'map-connection');
                    // Cada línea toma el color de la división del destino,
                    // en vez de un único tono para toda la red.
                    line.style.stroke = `var(--color-${point.accent})`;
                    connectionsLayer.appendChild(line);
                });
        }
    }

    document.addEventListener('click', (event) => {
        if (!root.contains(event.target)) {
            clearPins();
            clearHighlights();
            hideTooltip();
        }
    });

    root.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            clearPins();
            clearHighlights();
            hideTooltip();
        }
    });
}
