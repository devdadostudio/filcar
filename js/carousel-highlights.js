(function () {
  function initCarouselHighlights() {
    if (!window.gsap || !window.ScrollTrigger) return;

    gsap.registerPlugin(ScrollTrigger);

    const blocks = document.querySelectorAll(".js-carousel-highlights");
    if (!blocks.length) return;

    const reduceMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)",
    ).matches;
    const smoother = window.ScrollSmoother ? window.ScrollSmoother.get() : null;

    blocks.forEach((block) => {
      if (block.dataset.carouselHighlightsReady === "true") return;

      const pin = block.querySelector(".js-carousel-highlights-pin");
      const viewport = block.querySelector(".js-carousel-highlights-viewport");
      const track = block.querySelector(".js-carousel-highlights-track");
      const cards = Array.from(block.querySelectorAll(".js-carousel-highlights-card"));
      const prev = block.querySelector(".js-carousel-highlights-prev");
      const next = block.querySelector(".js-carousel-highlights-next");

      if (!pin || !viewport || !track || !cards.length) return;

      block.dataset.carouselHighlightsReady = "true";

      let trigger = null;
      let tween = null;
      let maxX = 0;
      let cardStops = [];
      let activeIndex = 0;

      const setControls = () => {
        if (!prev || !next) return;

        if (maxX <= 1) {
          prev.disabled = true;
          next.disabled = true;
          return;
        }

        prev.disabled = activeIndex <= 0;
        next.disabled = activeIndex >= cards.length - 1;
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

        setControls();
        return maxX;
      };

      const setActiveByX = (x) => {
        let closestIndex = 0;
        let closestDistance = Number.POSITIVE_INFINITY;

        cardStops.forEach((stop, index) => {
          const distance = Math.abs(stop - x);

          if (distance < closestDistance) {
            closestDistance = distance;
            closestIndex = index;
          }
        });

        activeIndex = closestIndex;
        cards.forEach((card, index) => {
          card.classList.toggle("is-active", index === activeIndex);
        });
        setControls();
      };

      const getCurrentX = () => {
        const transform = gsap.getProperty(track, "x");
        const value = typeof transform === "number" ? transform : parseFloat(transform);

        return Math.abs(Number.isFinite(value) ? value : 0);
      };

      const setTrackX = (x) => {
        const safeX = Math.max(0, Math.min(x, maxX));
        gsap.set(track, { x: -safeX });
        setActiveByX(safeX);
      };

      const scrollToX = (x) => {
        if (!trigger || !maxX) {
          setTrackX(x);
          return;
        }

        const progress = Math.max(0, Math.min(x / maxX, 1));
        const targetY = trigger.start + progress * (trigger.end - trigger.start);

        if (smoother) {
          smoother.scrollTo(targetY, true);
          return;
        }

        if (window.gsap && window.ScrollToPlugin) {
          gsap.to(window, {
            scrollTo: { y: targetY, autoKill: false },
            duration: 0.7,
            ease: "power2.out",
            overwrite: "auto",
            onUpdate: () => ScrollTrigger.update(),
          });
          return;
        }

        window.scrollTo({ top: targetY, behavior: "smooth" });
      };

      const goToCard = (index) => {
        const safeIndex = Math.max(0, Math.min(index, cards.length - 1));
        scrollToX(cardStops[safeIndex] || 0);
      };

      prev?.addEventListener("click", () => goToCard(activeIndex - 1));
      next?.addEventListener("click", () => goToCard(activeIndex + 1));

      block.addEventListener("keydown", (event) => {
        if (event.key !== "ArrowLeft" && event.key !== "ArrowRight") return;

        event.preventDefault();
        goToCard(activeIndex + (event.key === "ArrowRight" ? 1 : -1));
      });

      measure();
      setTrackX(0);

      const createScrollTrigger = () => {
        if (trigger) {
          trigger.kill();
          trigger = null;
        }

        if (tween) {
          tween.kill();
          tween = null;
        }

        measure();
        setTrackX(Math.min(getCurrentX(), maxX));

        if (reduceMotion || maxX <= 1) return;

        tween = gsap.to(track, {
          x: () => -maxX,
          ease: "none",
          overwrite: "auto",
        });

        trigger = ScrollTrigger.create({
          trigger: pin,
          start: "top top",
          end: () => {
            measure();
            return `+=${Math.max(maxX, window.innerHeight * 0.75)}`;
          },
          animation: tween,
          scrub: 0.65,
          pin,
          pinSpacing: true,
          anticipatePin: 1,
          invalidateOnRefresh: true,
          onRefreshInit: () => {
            measure();
          },
          onRefresh: (self) => {
            measure();
            setActiveByX(self.progress * maxX);
          },
          onUpdate: (self) => {
            setActiveByX(self.progress * maxX);
          },
        });
      };

      createScrollTrigger();

      window.addEventListener(
        "resize",
        () => {
          createScrollTrigger();
          ScrollTrigger.refresh();
        },
        { passive: true },
      );

      window.addEventListener(
        "load",
        () => {
          createScrollTrigger();
          ScrollTrigger.refresh();
        },
        { once: true },
      );
    });
  }

  document.addEventListener("DOMContentLoaded", initCarouselHighlights);
})();
