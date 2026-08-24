(function () {
  function initCarouselHighlights() {
    const blocks = document.querySelectorAll(".js-carousel-highlights");
    if (!blocks.length) return;

    blocks.forEach((block) => {
      if (block.dataset.carouselHighlightsReady === "true") return;

      const viewport = block.querySelector(".js-carousel-highlights-viewport");
      const track = block.querySelector(".js-carousel-highlights-track");
      const cards = Array.from(block.querySelectorAll(".js-carousel-highlights-card"));
      const prev = block.querySelector(".js-carousel-highlights-prev");
      const next = block.querySelector(".js-carousel-highlights-next");

      if (!viewport || !track || !cards.length) return;

      block.dataset.carouselHighlightsReady = "true";

      let maxX = 0;
      let cardStops = [];
      let activeIndex = 0;
      let resizeFrame = null;

      const setControls = () => {
        if (!prev || !next) return;

        if (maxX <= 1) {
          prev.disabled = true;
          next.disabled = true;
          return;
        }

        prev.disabled = activeIndex <= 0;
        next.disabled = activeIndex >= cardStops.length - 1;
      };

      const setActiveByIndex = (index) => {
        activeIndex = Math.max(0, Math.min(index, cardStops.length - 1));
        const activeX = cardStops[activeIndex] || 0;

        cards.forEach((card, cardIndex) => {
          const cardX = Math.max(0, Math.min(card.offsetLeft, maxX));
          card.classList.toggle("is-active", Math.abs(cardX - activeX) < 1);
        });

        setControls();
      };

      const measure = () => {
        maxX = Math.max(0, track.scrollWidth - viewport.clientWidth);
        block.classList.toggle("is-scrollable", maxX > 1);
        block.classList.toggle("is-static", maxX <= 1);

        cardStops = cards.reduce((stops, card) => {
          const stop = Math.round(Math.max(0, Math.min(card.offsetLeft, maxX)));
          const lastStop = stops[stops.length - 1];

          if (lastStop === undefined || Math.abs(lastStop - stop) > 1) {
            stops.push(stop);
          }

          return stops;
        }, []);

        if (maxX > 1 && Math.abs(cardStops[cardStops.length - 1] - maxX) > 1) {
          cardStops.push(maxX);
        }

        setActiveByIndex(Math.min(activeIndex, cardStops.length - 1));
      };

      const setTrackPosition = (x, animate = true) => {
        track.style.transition = animate
          ? "transform 650ms cubic-bezier(0.22, 1, 0.36, 1)"
          : "none";
        track.style.transform = `translate3d(${-x}px, 0, 0)`;
      };

      const goToCard = (index, animate = true) => {
        const safeIndex = Math.max(0, Math.min(index, cardStops.length - 1));
        const targetX = cardStops[safeIndex] || 0;

        setTrackPosition(targetX, animate);
        setActiveByIndex(safeIndex);
      };

      prev?.addEventListener("click", () => goToCard(activeIndex - 1));
      next?.addEventListener("click", () => goToCard(activeIndex + 1));

      const refreshCarousel = () => {
        measure();
        goToCard(activeIndex, false);
      };

      const scheduleRefresh = () => {
        if (resizeFrame) {
          window.cancelAnimationFrame(resizeFrame);
        }

        resizeFrame = window.requestAnimationFrame(() => {
          resizeFrame = null;
          refreshCarousel();
        });
      };

      const watchedImages = Array.from(block.querySelectorAll("img"));

      watchedImages.forEach((image) => {
        if (image.complete) return;
        image.addEventListener("load", scheduleRefresh, { once: true });
        image.addEventListener("error", scheduleRefresh, { once: true });
      });

      const layoutObserver =
        "ResizeObserver" in window
          ? new ResizeObserver(() => scheduleRefresh())
          : null;

      if (layoutObserver) {
        layoutObserver.observe(viewport);
        layoutObserver.observe(track);
      }

      window.addEventListener("resize", scheduleRefresh, { passive: true });

      refreshCarousel();
    });
  }

  document.addEventListener("DOMContentLoaded", initCarouselHighlights);
})();
