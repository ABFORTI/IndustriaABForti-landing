export function initHeroVideo() {
    const video = document.getElementById('hero-video');

    if (!video) return;

    const sources = [video.dataset.videoA, video.dataset.videoB].filter(Boolean);

    if (sources.length < 2) return;

    let index = 0;

    const playNext = () => {
        index = (index + 1) % sources.length;
        video.src = sources[index];
        video.play();
    };

    video.addEventListener('ended', playNext);
}
