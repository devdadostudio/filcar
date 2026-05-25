(function () {
  function initProgettazioneSequenceNav() {
    if (!window.gsap || !window.ScrollTrigger) return;

    const blocks = document.querySelectorAll(".js-progettazione-sequence-nav");
    if (!blocks.length) return;

    const reduceMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)",
    ).matches;

    blocks.forEach((block) => {
      if (block.dataset.sequenceNavReady === "true") return;

      const scroll = block.querySelector(".js-sequence-anchor-scroll");
      const media = block.querySelector(".js-sequence-anchor-media");
      const canvas = block.querySelector(".js-sequence-anchor-canvas");
      const points = Array.from(
        block.querySelectorAll(".js-sequence-anchor-point"),
      );
      const links = Array.from(block.querySelectorAll(".sequence-anchor-link"));
      const navWrap = block.querySelector(".js-sequence-anchor-nav-wrap");
      const floatingCard = block.querySelector(".js-sequence-anchor-floating-card");
      const sections = Array.from(
        block.querySelectorAll(".js-sequence-anchor-section"),
      );
      const ergonomiaCarousels = Array.from(
        block.querySelectorAll(".js-sequence-ergonomia-carousel"),
      );

      if (!scroll || !media || !canvas || !points.length || !links.length) {
        return;
      }

      block.dataset.sequenceNavReady = "true";

      const ctx = canvas.getContext("2d");
      const frameScript = block.querySelector(".js-sequence-anchor-frames");
      const smoother = window.ScrollSmoother ? window.ScrollSmoother.get() : null;
      let frameUrls = [];
      const frames = [];
      let loadedFrames = 0;
      let currentSequenceProgress = 0;
      let sequenceTrigger = null;
      let currentActiveId = "";
      let navLockUntil = 0;
      let lastCanvasWidth = 0;
      let lastCanvasHeight = 0;
      let resizeRefreshFrame = null;
      let sourceFrameWidth = 1200;
      let sourceFrameHeight = 675;
      let sourceFrameSizeReady = false;

      if (frameScript) {
        try {
          frameUrls = JSON.parse(frameScript.textContent);
        } catch (error) {
          frameUrls = [];
        }
      }

      const isMobileViewport = () =>
        window.matchMedia("(max-width: 1024px)").matches;

      const getHeaderHeight = () => {
        const header = document.querySelector(".flc-main-nav");
        return header && !header.classList.contains("is-hidden")
          ? header.offsetHeight
          : 0;
      };

      const getScrollTop = () => {
        if (smoother) return smoother.scrollTop();

        return window.pageYOffset || window.scrollY || 0;
      };

      const centerNavItem = (activeLink) => {
        if (!navWrap || !activeLink) return;

        const targetX =
          activeLink.offsetLeft - navWrap.clientWidth / 2 + activeLink.offsetWidth / 2;
        const maxX = navWrap.scrollWidth - navWrap.clientWidth;

        navWrap.scrollTo({
          left: Math.max(0, Math.min(targetX, maxX)),
          behavior: "smooth",
        });
      };

      const setActiveNav = (id) => {
        if (!id || currentActiveId === id) return;

        currentActiveId = id;

        links.forEach((link) => {
          const isActive = link.dataset.anchorId === id;

          link.classList.toggle("is-active", isActive);

          if (isActive) centerNavItem(link);
        });
      };

      const pointStops = points.map((point, index) => {
        const fallback = index / Math.max(points.length - 1, 1);
        const value = parseFloat(point.dataset.sequenceProgress);

        return Number.isFinite(value) ? gsap.utils.clamp(0, 1, value) : fallback;
      });
      const sequenceStartProgress = pointStops[0] ?? 0;
      const rawSequenceEndProgress = pointStops[pointStops.length - 1] ?? 1;
      const sequenceEndProgress =
        rawSequenceEndProgress > sequenceStartProgress
          ? rawSequenceEndProgress
          : 1;
      const sequenceProgressSpan = Math.max(
        sequenceEndProgress - sequenceStartProgress,
        0.0001,
      );
      const scrollProgressToFrameProgress = (progress) =>
        gsap.utils.clamp(
          0,
          1,
          sequenceStartProgress +
            gsap.utils.clamp(0, 1, progress) * sequenceProgressSpan,
        );
      const frameProgressToScrollProgress = (progress) =>
        gsap.utils.clamp(
          0,
          1,
          (gsap.utils.clamp(0, 1, progress) - sequenceStartProgress) /
            sequenceProgressSpan,
        );

      const resizeCanvas = () => {
        const width = Math.round(canvas.clientWidth || canvas.width);
        const height = Math.round(canvas.clientHeight || canvas.height);
        const ratio = Math.min(window.devicePixelRatio || 1, 2);

        if (width === lastCanvasWidth && height === lastCanvasHeight) {
          return false;
        }

        lastCanvasWidth = width;
        lastCanvasHeight = height;
        canvas.width = Math.round(width * ratio);
        canvas.height = Math.round(height * ratio);
        ctx.setTransform(ratio, 0, 0, ratio, 0, 0);

        return true;
      };

      const applySourceFrameSize = (image) => {
        if (
          sourceFrameSizeReady ||
          !image ||
          !image.naturalWidth ||
          !image.naturalHeight
        ) {
          return;
        }

        sourceFrameSizeReady = true;
        sourceFrameWidth = image.naturalWidth;
        sourceFrameHeight = image.naturalHeight;

        canvas.width = sourceFrameWidth;
        canvas.height = sourceFrameHeight;
        canvas.setAttribute("width", sourceFrameWidth);
        canvas.setAttribute("height", sourceFrameHeight);

        if (canvas.parentElement) {
          canvas.parentElement.style.aspectRatio = `${sourceFrameWidth} / ${sourceFrameHeight}`;
        }

        lastCanvasWidth = 0;
        lastCanvasHeight = 0;
        syncCanvasSize(true);
      };

      const syncCanvasSize = (refreshTriggers = false) => {
        const resized = resizeCanvas();
        renderSequence(currentSequenceProgress);

        if (!refreshTriggers || !resized) return;

        if (resizeRefreshFrame) {
          window.cancelAnimationFrame(resizeRefreshFrame);
        }

        resizeRefreshFrame = window.requestAnimationFrame(() => {
          resizeRefreshFrame = null;
          ScrollTrigger.refresh();
        });
      };

      const drawPolygon = (pointsList, fill, stroke) => {
        ctx.beginPath();
        pointsList.forEach((point, index) => {
          if (index === 0) {
            ctx.moveTo(point.x, point.y);
            return;
          }

          ctx.lineTo(point.x, point.y);
        });
        ctx.closePath();
        ctx.fillStyle = fill;
        ctx.fill();
        ctx.strokeStyle = stroke;
        ctx.lineWidth = 1;
        ctx.stroke();
      };

      const drawCube = (progress) => {
        const width = canvas.clientWidth || canvas.width;
        const height = canvas.clientHeight || canvas.height;
        const centerX = width / 2;
        const centerY = height / 2 + height * 0.03;
        const size = Math.min(width, height) * 0.34;
        const rotation = progress * Math.PI * 2.15 + Math.PI * 0.16;
        const pitch = Math.PI * (0.18 + progress * 0.12);
        const vertices = [
          [-1, -1, -1],
          [1, -1, -1],
          [1, 1, -1],
          [-1, 1, -1],
          [-1, -1, 1],
          [1, -1, 1],
          [1, 1, 1],
          [-1, 1, 1],
        ].map(([x, y, z]) => {
          const rotatedX = x * Math.cos(rotation) - z * Math.sin(rotation);
          const rotatedZ = x * Math.sin(rotation) + z * Math.cos(rotation);
          const pitchedY = y * Math.cos(pitch) - rotatedZ * Math.sin(pitch);
          const pitchedZ = y * Math.sin(pitch) + rotatedZ * Math.cos(pitch);
          const perspective = 2.8 / (2.8 + pitchedZ);

          return {
            x: centerX + rotatedX * size * perspective,
            y: centerY + pitchedY * size * perspective,
            z: pitchedZ,
          };
        });
        const faces = [
          { indexes: [0, 1, 2, 3], color: "rgba(0, 133, 221, 0.34)" },
          { indexes: [4, 7, 6, 5], color: "rgba(255, 255, 255, 0.13)" },
          { indexes: [0, 4, 5, 1], color: "rgba(0, 133, 221, 0.52)" },
          { indexes: [1, 5, 6, 2], color: "rgba(255, 255, 255, 0.22)" },
          { indexes: [2, 6, 7, 3], color: "rgba(0, 133, 221, 0.22)" },
          { indexes: [3, 7, 4, 0], color: "rgba(255, 255, 255, 0.08)" },
        ];

        ctx.clearRect(0, 0, width, height);
        ctx.save();
        ctx.shadowColor = "rgba(0, 0, 0, 0.36)";
        ctx.shadowBlur = 42;
        ctx.shadowOffsetY = 28;

        faces
          .map((face) => ({
            ...face,
            z:
              face.indexes.reduce((sum, index) => sum + vertices[index].z, 0) /
              face.indexes.length,
          }))
          .sort((a, b) => a.z - b.z)
          .forEach((face) => {
            drawPolygon(
              face.indexes.map((index) => vertices[index]),
              face.color,
              "rgba(255, 255, 255, 0.42)",
            );
          });

        ctx.restore();
      };

      const drawImageFrame = (progress) => {
        const width = canvas.clientWidth || canvas.width;
        const height = canvas.clientHeight || canvas.height;
        const frameIndex = Math.round(progress * Math.max(frames.length - 1, 0));
        const image = frames[frameIndex];

        if (!image || !image.complete) {
          drawCube(progress);
          return;
        }

        const scale = Math.min(
          width / image.naturalWidth,
          height / image.naturalHeight,
        );
        const drawWidth = image.naturalWidth * scale;
        const drawHeight = image.naturalHeight * scale;

        ctx.clearRect(0, 0, width, height);
        ctx.drawImage(
          image,
          (width - drawWidth) / 2,
          (height - drawHeight) / 2,
          drawWidth,
          drawHeight,
        );
      };

      const renderSequence = (progress) => {
        currentSequenceProgress = progress;

        if (frames.length && loadedFrames === frames.length) {
          drawImageFrame(progress);
          return;
        }

        drawCube(progress);
      };

      const setActivePoint = (progress) => {
        let activeIndex = 0;
        let activeDistance = Number.POSITIVE_INFINITY;

        pointStops.forEach((stop, index) => {
          const distance = Math.abs(progress - stop);

          if (distance < activeDistance) {
            activeDistance = distance;
            activeIndex = index;
          }
        });

        points.forEach((point, index) => {
          const isActive = index === activeIndex;
          point.classList.toggle("is-active", isActive);
          point.classList.toggle("is-before", index < activeIndex);

          if (isActive) setActiveNav(point.dataset.anchorId);
        });
      };

      const scrollToY = (y, onComplete, immediate = false) => {
        if (smoother) {
          smoother.scrollTo(y, !immediate);

          if (onComplete) {
            window.setTimeout(() => {
              ScrollTrigger.update();
              onComplete();
            }, immediate ? 0 : 800);
          }

          return;
        }

        if (window.gsap && window.ScrollToPlugin) {
          if (immediate) {
            gsap.set(window, {
              scrollTo: { y, autoKill: false },
            });
            ScrollTrigger.update();
            if (onComplete) onComplete();
            return;
          }

          gsap.to(window, {
            scrollTo: { y, autoKill: false },
            duration: 0.75,
            ease: "power2.out",
            overwrite: "auto",
            onUpdate: () => ScrollTrigger.update(),
            onComplete,
          });
          return;
        }

        window.scrollTo({
          top: y,
          behavior: immediate ? "auto" : "smooth",
        });

        if (onComplete) {
          window.setTimeout(onComplete, immediate ? 0 : 800);
        }
      };

      const scrollToSection = (target) => {
        const offset = getHeaderHeight() + 8;

        if (smoother) {
          smoother.scrollTo(target, true, `top top+=${offset}`);
          return;
        }

        const y = target.getBoundingClientRect().top + getScrollTop() - offset;
        scrollToY(y);
      };

      const getSequenceScrollY = (progress) => {
        if (!sequenceTrigger) return getScrollTop();

        ScrollTrigger.update();

        return (
          sequenceTrigger.start +
          frameProgressToScrollProgress(progress) *
            (sequenceTrigger.end - sequenceTrigger.start)
        );
      };

      const forceSequenceState = (progress, anchorId) => {
        const safeProgress = gsap.utils.clamp(0, 1, progress);

        navLockUntil = Date.now() + 950;
        renderSequence(safeProgress);
        setActivePoint(safeProgress);
        setActiveNav(anchorId);
      };

      resizeCanvas();
      renderSequence(sequenceStartProgress);
      setActivePoint(sequenceStartProgress);

      const canvasResizeObserver =
        "ResizeObserver" in window
          ? new ResizeObserver(() => syncCanvasSize(false))
          : null;

      if (canvasResizeObserver) {
        canvasResizeObserver.observe(canvas);
        canvasResizeObserver.observe(canvas.parentElement);
      }

      frameUrls.forEach((url, index) => {
        const image = new Image();
        image.onload = () => {
          if (index === 0) {
            applySourceFrameSize(image);
          }

          loadedFrames += 1;
          renderSequence(currentSequenceProgress);
        };
        frames.push(image);
        image.src = url;
      });

      if (!reduceMotion) {
        if (isMobileViewport()) {
          sequenceTrigger = ScrollTrigger.create({
            trigger: scroll,
            start: "top top",
            end: () => `+=${Math.max(points.length * 75, 260)}%`,
            scrub: 0.65,
            pin: scroll,
            anticipatePin: 1,
            invalidateOnRefresh: true,
            onRefreshInit: () => {
              resizeCanvas();
              renderSequence(currentSequenceProgress);
            },
            onUpdate: (self) => {
              const progress = scrollProgressToFrameProgress(self.progress);
              renderSequence(progress);
              setActivePoint(progress);
            },
          });
        } else {
          sequenceTrigger = ScrollTrigger.create({
            trigger: media,
            start: "center center",
            endTrigger: points[points.length - 1],
            end: "center center",
            scrub: 0.65,
            pin: media,
            pinSpacing: true,
            anticipatePin: 1,
            invalidateOnRefresh: true,
            onRefreshInit: () => {
              resizeCanvas();
              renderSequence(currentSequenceProgress);
            },
            onUpdate: (self) => {
              const progress = scrollProgressToFrameProgress(self.progress);
              renderSequence(progress);
              setActivePoint(progress);
            },
          });
        }

        if (floatingCard && !isMobileViewport()) {
          const ergonomiaSection =
            sections.find((section) => section.dataset.anchorId === "ergonomia") ||
            sections[0] ||
            scroll;

          ScrollTrigger.create({
            trigger: floatingCard,
            start: "bottom bottom-=24",
            endTrigger: ergonomiaSection,
            end: "top top-=120",
            pin: floatingCard,
            pinSpacing: false,
            pinReparent: true,
            anticipatePin: 1,
            invalidateOnRefresh: true,
          });
        }
      }

      sections.forEach((section) => {
        ScrollTrigger.create({
          trigger: section,
          start: "top center",
          end: "bottom center",
          onEnter: () => {
            if (Date.now() > navLockUntil) setActiveNav(section.dataset.anchorId);
          },
          onEnterBack: () => {
            if (Date.now() > navLockUntil) setActiveNav(section.dataset.anchorId);
          },
        });
      });

      links.forEach((link) => {
        link.addEventListener("click", (event) => {
          event.preventDefault();

          const type = link.dataset.type;

          if (type === "sequence") {
            const progress = parseFloat(link.dataset.sequenceProgress || "0");
            const safeProgress = Number.isFinite(progress) ? progress : 0;
            const anchorId = link.dataset.anchorId;

            forceSequenceState(safeProgress, anchorId);

            if (!sequenceTrigger) return;

            const targetY = getSequenceScrollY(safeProgress);

            scrollToY(
              targetY,
              () => {
                forceSequenceState(safeProgress, anchorId);
                ScrollTrigger.update();
              },
              true,
            );
            return;
          }

          const target = document.querySelector(link.dataset.target);
          if (!target) return;

          setActiveNav(target.dataset.anchorId);
          scrollToSection(target);
        });
      });

      ergonomiaCarousels.forEach((carousel) => {
        const slides = Array.from(
          carousel.querySelectorAll(".progettazione-sequence-nav__ergonomia-slide"),
        );
        const prev = carousel.querySelector(".js-sequence-ergonomia-prev");
        const next = carousel.querySelector(".js-sequence-ergonomia-next");
        let currentIndex = Math.max(
          0,
          slides.findIndex((slide) => slide.classList.contains("is-active")),
        );

        if (!slides.length) return;

        const setSlide = (index) => {
          currentIndex = gsap.utils.wrap(0, slides.length, index);

          slides.forEach((slide, slideIndex) => {
            slide.classList.toggle("is-active", slideIndex === currentIndex);
          });
        };

        prev?.addEventListener("click", () => setSlide(currentIndex - 1));
        next?.addEventListener("click", () => setSlide(currentIndex + 1));
        setSlide(currentIndex);
      });

      window.addEventListener(
        "resize",
        () => syncCanvasSize(true),
        { passive: true },
      );
    });
  }

  document.addEventListener("DOMContentLoaded", initProgettazioneSequenceNav);
})();
