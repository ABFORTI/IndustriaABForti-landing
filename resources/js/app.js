import './bootstrap';
import { initNavbar } from './navbar';
import { initMexicoMaps } from './map';
import { initDivisionSwitcher } from './divisions';
import { initIndustriesCarousel } from './industries';
import { initProductModal } from './product-modal';
import { initReveal } from './reveal';
import { initParallax } from './parallax';
import { initCounters } from './counters';
import { initLogistics } from './logistics-map';
import { initContactForm } from './contact-form';
import { initHeroVideo } from './hero-video';

document.addEventListener('DOMContentLoaded', () => {
    initNavbar();
    initMexicoMaps();
    initDivisionSwitcher();
    initIndustriesCarousel();
    initProductModal();
    initReveal();
    initParallax();
    initCounters();
    initLogistics();
    initContactForm();
    initHeroVideo();
});
