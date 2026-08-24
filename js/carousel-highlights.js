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

        cards.forEach((card, cardIndex) => {
          card.classList.toggle("is-active", cardIndex === activeIndex);
        });

        setControls();
      };

      const measure = () => {
        maxX = Math.max(0, track.scrollWidth - viewport.clientWidth);
        block.classList.toggle("is-scrollable", maxX > 1);
        block.classList.toggle("is-static", maxX <= 1);

        cardStops = cards.map((card) =>
          Math.max(0, Math.min(card.offsetLeft, maxX)),
        );

        if (cardStops.length) {
          cardStops[cardStops.length - 1] = maxX;
        }

        setActiveByIndex(Math.min(activeIndex, cardStops.length - 1));
      };

      const goToCard = (index) => {
        const safeIndex = Math.max(0, Math.min(index, cardStops.length - 1));
        const targetX = cardStops[safeIndex] || 0;

        track.style.transform = `translate3d(${-targetX}px, 0, 0)`;
        setActiveByIndex(safeIndex);
      };

      prev?.addEventListener("click", () => goToCard(activeIndex - 1));
      next?.addEventListener("click", () => goToCard(activeIndex + 1));

      const refreshCarousel = () => {
        measure();
        goToCard(activeIndex);
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
