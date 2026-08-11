# PLAN.md — Landing corporativo Grupo (Industria · Logística · Inmobiliaria)

Basado en `BRIEF.md`. Stack confirmado en el proyecto ya inicializado: **Laravel 12 + Blade + Tailwind CSS v4 (vía `@tailwindcss/vite`, tokens en CSS con `@theme`, sin `tailwind.config.js`) + Vite**.

Arquitectura confirmada contigo: **multi-página**. Home (`/`) resume el recorrido narrativo (hero → mapa → divisiones → por qué nosotros → cobertura → CTA), y cada división tiene su propia ruta indexable: `/industria`, `/logistica`, `/inmobiliaria`, con H1, meta tags y schema propios (sección 20 del brief).

---

## Decisiones abiertas que asumo por defecto (dime si alguna no es correcta antes de aprobar)

1. **Tipografía**: `Plus Jakarta Sans` para títulos + `Inter` para cuerpo de texto (dos familias, como pide la sección 15). Es una propuesta, no una preferencia tuya confirmada — se ajusta fácilmente en Fase 1 si prefieres otra combinación de las 4 sugeridas en el brief.
2. **Nav "Nosotros" y "Contacto"**: a diferencia de Industria/Logística/Inmobiliaria (que sí son páginas propias por SEO), interpreto que **"Nosotros" y "Contacto" son anclas dentro del Home** (`#nosotros` → sección "Por qué nosotros", `#contacto` → sección CTA final), porque el brief no les da un contenido único distinto al que ya describe en las secciones 11 y 13, y crear páginas vacías solo para esos dos ítems inventaría estructura no especificada. Si prefieres que también sean páginas propias (por ejemplo con un formulario de contacto), dímelo — eso añadiría una fase.
3. **Colores de acento por división**: el brief pide basarlos en la identidad de Innovet (Industria) y Upper Logistics (Logística). No tengo capacidad de "ver" esos sitios como lo haría un diseñador — en Fase 1 intentaré extraer colores de marca de su HTML/CSS público (meta theme-color, variables CSS) como punto de partida, pero el ajuste final de tono/matiz te lo voy a mostrar en el style guide de Fase 1 para que confirmes antes de propagarlo a todo el sitio.
4. **Mapa de México (SVG real)**: no tengo un archivo SVG de los estados mexicanos a la mano. En la Fase 3 lo obtendré de una fuente de mapas vectoriales de dominio público/CC (p. ej. Wikimedia Commons, mapa en blanco de estados de México), no lo voy a dibujar path por path a mano. Te confirmo la fuente exacta antes de integrarlo por si prefieres proveer tú el archivo.
5. **Formulario de contacto**: el brief no especifica campos, validaciones ni destino de envío para ningún formulario — solo botones CTA ("Hablar con un especialista", "Solicitar información") y datos de contacto tipo placeholder en el footer. Por ahora esos botones enlazarán a `mailto:`/`https://wa.me/` con placeholders (sección 25), **sin construir un formulario ni backend de envío**, hasta que me confirmes si lo necesitas y con qué campos.

---

## Fase 1 — Fundación: sistema de diseño + arquitectura de rutas

**Objetivo:** dejar lista la base técnica y visual que usarán todas las fases siguientes: paleta, tipografía, tokens de Tailwind v4, estructura de carpetas de componentes Blade, capa de datos de divisiones/ubicaciones, layout base con slots de SEO, y las rutas/controlador para las 4 páginas del sitio.

**Cubre del BRIEF:** sección 15 (diseño visual), 16 (paleta), 21 (tecnología/arquitectura), 22 (estructura de datos, parcial).

**Archivos principales:**
- `resources/css/app.css` — tokens `@theme` (colores neutros + acento por división, tipografía, spacing/grid)
- `resources/views/layouts/app.blade.php` — layout base con slots para `title`/`meta description`/OG
- `resources/views/components/ui/button.blade.php`, `section-heading.blade.php`
- `config/divisions.php` — nombre, slug, tagline, color de acento por división
- `config/locations.php` — estructura de ubicaciones del mapa (según ejemplo de la sección 22)
- `app/Http/Controllers/PageController.php` (o `DivisionController`) + `routes/web.php` — rutas `/`, `/industria`, `/logistica`, `/inmobiliaria`
- `resources/views/style-guide.blade.php` — vista temporal de revisión (se elimina en Fase 8)

**Criterio de "hecho":** con `npm run dev` + `php artisan serve`, visitar `/style-guide` y ver paleta, tipografía y botones aplicados; visitar `/`, `/industria`, `/logistica`, `/inmobiliaria` y ver un placeholder con el layout base (navbar/footer aún no existen, así que solo confirma que el routing y el layout responden).

---

## Fase 2 — Navbar + Footer (componentes globales)

**Objetivo:** construir los dos componentes que aparecen en todas las páginas.

**Cubre del BRIEF:** sección 3 (navbar), sección 14 (footer).

**Archivos principales:**
- `resources/views/components/layout/navbar.blade.php`
- `resources/views/components/layout/footer.blade.php`
- `resources/js/navbar.js` (sticky + transformación en scroll, menú mobile)
- Actualización de `resources/views/layouts/app.blade.php` para incluirlos

**Criterio de "hecho":** en cualquiera de las 4 páginas, el navbar se mantiene sticky, se transforma (altura/blur/fondo) al hacer scroll, el menú hamburguesa abre/cierra en mobile con animación, y el footer muestra las 5 columnas + datos de contacto en placeholder.

---

## Fase 3 — Hero + Mapa interactivo de México (Home)

**Objetivo:** construir la sección más visual del Home: hero con propuesta de valor y el mapa vectorial interactivo.

**Cubre del BRIEF:** sección 4 (hero), sección 5 (mapa), sección 22 (mapa técnico/data-driven).

**Archivos principales:**
- `resources/views/components/sections/hero.blade.php`
- `resources/views/components/map/mexico-map.blade.php`
- `resources/views/components/map/location-marker.blade.php`
- `public/images/mexico-states.svg` (fuente pública, ver nota arriba)
- `resources/js/map.js` (hover, tooltip, pulse, conexiones entre puntos)
- Consumo de `config/locations.php`

**Criterio de "hecho":** en `/`, el hero muestra headline/subtítulo/botones del brief; el mapa responde a hover/click en los 5 puntos (Edomex, CDMX, Querétaro, Guadalajara, Manzanillo) mostrando tooltip con divisiones/servicios, con animación pulse, y es utilizable por touch en mobile.

---

## Fase 4 — "Tres divisiones, una misma visión" + transición (Home)

**Objetivo:** presentar las tres divisiones como parte de un mismo grupo, con transición visual coherente entre ellas.

**Cubre del BRIEF:** sección 6 (tres divisiones), sección 7 (transición).

**Archivos principales:**
- `resources/views/components/sections/divisions-overview.blade.php`
- Tarjetas/bloques por división con CTA que enlazan a `/industria`, `/logistica`, `/inmobiliaria`

**Criterio de "hecho":** en `/`, tras el mapa, se ven los tres bloques con texto y CTA del brief, cada uno con la personalidad visual (acento de color) de su división, y el paso de uno a otro se siente parte del mismo sistema, no bloques aislados.

---

## Fase 5 — Páginas de división: Industria, Logística, Inmobiliaria

**Objetivo:** construir el contenido completo de cada página propia.

**Cubre del BRIEF:** sección 8 (Industria), sección 9 (Logística), sección 10 (Inmobiliaria).

**Archivos principales:**
- `resources/views/pages/industria.blade.php`, `logistica.blade.php`, `inmobiliaria.blade.php`
- Componentes de apoyo: `components/sections/industries-served.blade.php` (industrias que atiende), `components/sections/infrastructure-stats.blade.php` (m² por sede en Logística), `components/sections/process-steps.blade.php` (01–06 en Inmobiliaria), placeholders de galería de proyectos

**Criterio de "hecho":** cada ruta (`/industria`, `/logistica`, `/inmobiliaria`) muestra su headline (H1), sus capacidades/servicios, y lo específico de cada una (industrias atendidas en Industria; m² por sede como indicador visual en Logística; proceso 01–06 + placeholders de proyectos en Inmobiliaria), todo sin inventar cifras/clientes/proyectos reales (sección 25).

---

## Fase 6 — "Por qué nosotros" + Cobertura + CTA final (Home)

**Objetivo:** cerrar el recorrido del Home con la justificación de valor, el mapa reutilizado como "red empresarial" y la sección de conversión antes del footer.

**Cubre del BRIEF:** sección 11 (por qué nosotros), sección 12 (cobertura), sección 13 (CTA).

**Archivos principales:**
- `resources/views/components/sections/why-us.blade.php`
- `resources/views/components/sections/coverage.blade.php` (reutiliza `mexico-map.blade.php` de Fase 3)
- `resources/views/components/sections/cta-final.blade.php`

**Criterio de "hecho":** el Home queda completo de principio a fin (hero → mapa → divisiones → por qué nosotros → cobertura → CTA → footer), navegable en un solo scroll.

---

## Fase 7 — SEO + accesibilidad (las 4 páginas)

**Objetivo:** dejar cada página lista para indexación y uso con teclado/lector de pantalla.

**Cubre del BRIEF:** sección 20 (SEO), partes de sección 18 (accesibilidad).

**Archivos principales:**
- Slots de SEO en `layouts/app.blade.php` (title, meta description, Open Graph, canonical)
- Schema markup `Organization` (global) + `LocalBusiness` en páginas con ubicaciones físicas (p. ej. Logística)
- Alt text en todos los placeholders de imagen
- Ajustes ARIA/foco visible en navbar, menú mobile y mapa

**Criterio de "hecho":** ver-código-fuente de cada página muestra title/meta/OG/schema correctos y sin keyword stuffing; navegación completa por teclado (tab) funciona en navbar, menú mobile y mapa.

---

## Fase 8 — Pulido: animaciones, responsive, performance, revisión final

**Objetivo:** afinar la experiencia final sin sacrificar velocidad ni usabilidad (sección 26).

**Cubre del BRIEF:** sección 17 (animaciones), sección 18 (UX), sección 19 (conversión), sección 24 (efecto visual general).

**Archivos principales:**
- Ajustes de animación (fade-up/fade-in, parallax ligero, microinteracciones) en componentes ya creados
- Revisión responsive en breakpoints mobile/tablet/desktop
- Build de producción (`npm run build`) y checklist de performance
- Eliminación de `resources/views/style-guide.blade.php` (era temporal)

**Criterio de "hecho":** recorrido completo del sitio en desktop y mobile sin animaciones excesivas ni saltos de layout, `npm run build` corre sin errores, y cada página cumple la lista de 5 preguntas de la sección 18 (qué empresa es, qué hace, qué industrias atiende, dónde opera, cómo contactar) en menos de 5 segundos de scroll.

---

## Cómo avanzaremos

Una fase a la vez. Al terminar cada una te digo qué archivos toqué y cómo verla en el navegador, y espero tu aprobación (o ajustes) antes de seguir con la siguiente. Si durante una fase encuentro contenido que el brief no da explícitamente (cifras, clientes, certificaciones, imágenes reales), uso un placeholder marcado y te pregunto en vez de inventarlo.
