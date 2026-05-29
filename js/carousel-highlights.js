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
    let refreshTimer = null;

    const scheduleScrollRefresh = (callback, delay = 80) => {
      window.clearTimeout(refreshTimer);
      refreshTimer = window.setTimeout(() => {
        window.requestAnimationFrame(() => {
          if (typeof callback === "function") callback();
          ScrollTrigger.sort();
          ScrollTrigger.refresh();
          ScrollTrigger.update();
        });
      }, delay);
    };

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
      let resizeFrame = null;
      let layoutSignature = "";
      let canBuildPinnedTrigger = document.readyState === "complete";

      const isMobileViewport = () =>
        window.matchMedia("(max-width: 767.98px)").matches;

      const canUsePin = () => cards.length >= 4 && !isMobileViewport();

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
        block.classList.toggle("is-pinned-scroll", canUsePin() && maxX > 1);
        block.classList.toggle("is-arrow-scroll", !canUsePin() && maxX > 1);
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

      const animateTrackToX = (x) => {
        const safeX = Math.max(0, Math.min(x, maxX));

        gsap.to(track, {
          x: -safeX,
          duration: 0.55,
          ease: "power2.out",
          overwrite: "auto",
          onUpdate: () => setActiveByX(getCurrentX()),
          onComplete: () => setActiveByX(safeX),
        });
      };

      const getEndHoldDistance = () =>
        Math.max(window.innerHeight * 0.35, viewport.clientWidth * 0.18);

      const getPinDistance = () => {
        measure();

        return Math.ceil(maxX + getEndHoldDistance());
      };

      const scrollToX = (x) => {
        if (!trigger || !maxX) {
          animateTrackToX(x);
          return;
        }

        const safeX = Math.max(0, Math.min(x, maxX));
        const targetY = trigger.start + safeX;

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

      const createScrollTrigger = (preserveProgress = false) => {
        if (!canBuildPinnedTrigger) return;

        const previousProgress =
          preserveProgress && trigger ? trigger.progress : null;

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

        if (!canUsePin() || reduceMotion || maxX <= 1) return;

        tween = gsap.timeline({ defaults: { ease: "none" } });
        tween.to(track, {
          x: () => -maxX,
          duration: Math.max(maxX, 1),
          overwrite: "auto",
        });
        tween.to({}, { duration: getEndHoldDistance() });

        trigger = ScrollTrigger.create({
          trigger: pin,
          start: "top top",
          end: () => `+=${getPinDistance()}`,
          animation: tween,
          scrub: true,
          pin,
          pinSpacing: true,
          anticipatePin: 1,
          invalidateOnRefresh: true,
          refreshPriority: 1,
          onRefreshInit: () => {
            measure();
          },
          onRefresh: (self) => {
            measure();
            setActiveByX(getCurrentX());
          },
          onUpdate: (self) => {
            setActiveByX(getCurrentX());
          },
          onLeave: () => setTrackX(maxX),
        });

        if (previousProgress !== null) {
          setTrackX(previousProgress * maxX);
        }
      };

      const createScrollTriggerWhenReady = () => {
        window.requestAnimationFrame(() => {
          window.requestAnimationFrame(() => {
            canBuildPinnedTrigger = true;
            createScrollTrigger();
            scheduleScrollRefresh(null, 80);
            window.setTimeout(() => scheduleScrollRefresh(null, 0), 360);
          });
        });
      };

      if (document.readyState === "complete") {
        createScrollTriggerWhenReady();
      } else {
        window.addEventListener("load", createScrollTriggerWhenReady, {
          once: true,
        });
      }

      const refreshCarousel = () => {
        const nextSignature = [
          Math.round(pin.offsetWidth),
          Math.round(pin.offsetHeight),
          Math.round(viewport.clientWidth),
          Math.round(track.scrollWidth),
        ].join(":");

        if (nextSignature === layoutSignature) return;

        layoutSignature = nextSignature;
        measure();
        setTrackX(Math.min(getCurrentX(), maxX));
        scheduleScrollRefresh(null, 60);
      };

      const scheduleCarouselRebuild = () => {
        if (resizeFrame) {
          window.cancelAnimationFrame(resizeFrame);
        }

        resizeFrame = window.requestAnimationFrame(() => {
          resizeFrame = null;
          createScrollTrigger(true);
          scheduleScrollRefresh(null, 40);
        });
      };

      const watchedImages = Array.from(block.querySelectorAll("img"));

      watchedImages.forEach((image) => {
        if (image.complete) return;
        image.addEventListener("load", refreshCarousel, { once: true });
        image.addEventListener("error", refreshCarousel, { once: true });
      });

      const layoutObserver =
        "ResizeObserver" in window
          ? new ResizeObserver(() => refreshCarousel())
          : null;

      if (layoutObserver) {
        layoutObserver.observe(pin);
        layoutObserver.observe(viewport);
        layoutObserver.observe(track);
      }

      window.addEventListener(
        "resize",
        () => {
          scheduleCarouselRebuild();
        },
        { passive: true },
      );

    });
  }

  document.addEventListener("DOMContentLoaded", initCarouselHighlights);
})();
