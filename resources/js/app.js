import './bootstrap';
import { initNavbar } from './navbar';
import { initMexicoMaps } from './map';
import { initDivisionSwitcher } from './divisions';
import { initReveal } from './reveal';
import { initParallax } from './parallax';
import { initCounters } from './counters';

document.addEventListener('DOMContentLoaded', () => {
    initNavbar();
    initMexicoMaps();
    initDivisionSwitcher();
    initReveal();
    initParallax();
    initCounters();
});
