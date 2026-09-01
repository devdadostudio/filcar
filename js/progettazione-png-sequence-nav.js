(function () {
  function initProgettazioneSequenceNav() {
    if (!window.gsap || !window.ScrollTrigger) return;

    const blocks = document.querySelectorAll(".js-progettazione-sequence-nav");
    if (!blocks.length) return;

    blocks.forEach((block) => {
      if (block.dataset.sequenceNavReady === "true") return;

      const media = block.querySelector(".js-sequence-anchor-media");
      const points = Array.from(
        block.querySelectorAll(".js-sequence-anchor-point"),
      );
      const switchImages = Array.from(
        block.querySelectorAll(".js-sequence-anchor-switch-image"),
      );
      const links = Array.from(block.querySelectorAll(".sequence-anchor-link"));
      const navWrap = block.querySelector(".js-sequence-anchor-nav-wrap");
      const sections = Array.from(
        block.querySelectorAll(".js-sequence-anchor-section"),
      );
      const imageSwitch = block.querySelector(".js-sequence-anchor-image-switch");
      const pinnedStage = block.querySelector(".js-sequence-pinned-stage");
      const pinnedPoints = Array.from(
        block.querySelectorAll(".js-sequence-pinned-point"),
      );
      const compositionItems = Array.from(
        block.querySelectorAll(".js-sequence-composition-item"),
      );
      const compositionTrack = block.querySelector(".js-sequence-composition-track");
      const pinnedInner = block.querySelector(".progettazione-sequence-nav__pinned-inner");
      const ergonomiaCarousels = Array.from(
        block.querySelectorAll(".js-sequence-ergonomia-carousel"),
      );

      if (!points.length || !links.length) return;

      block.dataset.sequenceNavReady = "true";

      const smoother = window.ScrollSmoother ? window.ScrollSmoother.get() : null;
      const isPinnedComposition = block.classList.contains(
        "progettazione-sequence-nav--pinned_composition",
      );
      let currentActiveId = "";
      let navLockUntil = 0;
      let pinnedTrigger = null;
      let pinnedStepPositions = [];
      let pinnedAnchorPositions = [];
      let pinnedTimelineDuration = 1;
      let pinnedTimeline = null;
      let scrollToPinnedIndex = null;

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

      const setActivePoint = (index) => {
        points.forEach((point, pointIndex) => {
          const isActive = pointIndex === index;
          point.classList.toggle("is-active", isActive);
          point.classList.toggle("is-before", pointIndex < index);

          if (isActive) setActiveNav(point.dataset.anchorId);
        });

        switchImages.forEach((image) => {
          const isActive =
            parseInt(image.dataset.imageIndex || "-1", 10) === index;

          image.classList.toggle("is-active", isActive);
          image.style.opacity = isActive ? "1" : "0";
          image.setAttribute("aria-hidden", isActive ? "false" : "true");
        });
      };

      const getPinnedScrollY = (index) => {
        if (!pinnedTrigger || pinnedPoints.length < 2) return null;
        const position =
          pinnedAnchorPositions[index] ?? pinnedStepPositions[index] ?? index;

        return (
          pinnedTrigger.start +
          (pinnedTrigger.end - pinnedTrigger.start) *
            (position / Math.max(pinnedTimelineDuration, 0.001))
        );
      };

      switchImages.forEach((image) => {
        image.style.position = "absolute";
        image.style.inset = "0";
        image.style.margin = "0";
        image.style.pointerEvents = "none";
      });

      const scrollToY = (y, immediate = true) => {
        if (smoother) {
          smoother.scrollTo(y, !immediate);
          window.setTimeout(() => ScrollTrigger.update(), immediate ? 0 : 800);
          return;
        }

        if (window.gsap && window.ScrollToPlugin) {
          if (immediate) {
            gsap.set(window, {
              scrollTo: { y, autoKill: false },
            });
            ScrollTrigger.update();
            return;
          }

          gsap.to(window, {
            scrollTo: { y, autoKill: false },
            duration: 0.75,
            ease: "power2.out",
            overwrite: "auto",
            onUpdate: () => ScrollTrigger.update(),
          });
          return;
        }

        window.scrollTo({
          top: y,
          behavior: immediate ? "auto" : "smooth",
        });
      };

      const scrollToSection = (target, immediate = true, align = "top") => {
        if (!target) return;

        const rect = target.getBoundingClientRect();
        const scrollTop = getScrollTop();
        const offset = getHeaderHeight() + 8;
        const y =
          align === "center"
            ? rect.top + scrollTop - (window.innerHeight - rect.height) / 2
            : rect.top + scrollTop - offset;

        scrollToY(y, immediate);
      };

      if (imageSwitch) {
        imageSwitch.style.position = "relative";
        imageSwitch.style.width = "100%";
        imageSwitch.style.aspectRatio = "1800 / 1956";
        imageSwitch.style.overflow = "hidden";
      }

      if (isPinnedComposition && pinnedStage && compositionTrack) {
        const setPinnedActivePoint = (index) => {
          setActivePoint(index);

          pinnedPoints.forEach((point, pointIndex) => {
            point.classList.toggle("is-active", pointIndex === index);
          });

          compositionItems.forEach((item, itemIndex) => {
            item.classList.toggle("is-active", itemIndex <= index);
          });
        };
        const getPinnedIndexFromTime = (time) => {
          let index = 0;

          pinnedAnchorPositions.forEach((position, positionIndex) => {
            if (time >= position - 0.55) {
              index = positionIndex;
            }
          });

          return index;
        };
        const getCompositionTrackShift = (index) => {
          const item = compositionItems[index];
          const mediaRect = compositionTrack.parentElement?.getBoundingClientRect();
          const itemRect = item?.getBoundingClientRect();

          if (!item || !mediaRect || !itemRect) return 0;

          return mediaRect.width / 2 - (item.offsetLeft + itemRect.width / 2);
        };
        pinnedStepPositions = pinnedPoints.map((_, index) => index);
        pinnedAnchorPositions = pinnedPoints.map((_, index) => (index === 0 ? 0 : index + 0.22));

        const createPinnedTimeline = ({
          scrub,
          trackStart,
          collapseItems = true,
          itemDuration = 0.85,
          itemStart = 0.08,
          revealDuration = null,
          revealStart = null,
          recenterOnRefresh = false,
          pinInner = false,
        }) => {
          if (pinInner && pinnedInner) {
            pinnedStage.style.minHeight = "100vh";
            pinnedStage.style.minHeight = "100svh";
            pinnedInner.style.position = "relative";
            pinnedInner.style.top = "auto";
          }

          gsap.set(pinnedPoints, { autoAlpha: 0, x: 56 });
          gsap.set(pinnedPoints[0], { autoAlpha: 1, x: 0 });
          gsap.set(compositionItems, collapseItems ? { autoAlpha: 0, width: 0, x: 56 } : { autoAlpha: 0, width: "auto", x: 56 });
          gsap.set(compositionItems[0], { autoAlpha: 1, width: "auto", x: 0 });

          if (!collapseItems) {
            gsap.set(compositionTrack, { x: 0 });
            gsap.set(compositionTrack, { x: () => getCompositionTrackShift(0) });
          }

          const timeline = gsap.timeline({
            defaults: { ease: "power2.out" },
            scrollTrigger: {
              trigger: pinnedStage,
              start: "top top",
              end: () =>
                pinInner
                  ? `+=${Math.max(window.innerHeight * (pinnedPoints.length + 0.8), 1600)}`
                  : "bottom bottom",
              pin: pinInner && pinnedInner ? pinnedInner : false,
              pinSpacing: pinInner,
              anticipatePin: pinInner ? 1 : 0,
              scrub,
              invalidateOnRefresh: true,
              onRefresh: () => {
                if (!recenterOnRefresh) return;

                const timelineTime = pinnedTimeline?.time() ?? 0;
                const index = getPinnedIndexFromTime(timelineTime);

                gsap.set(compositionTrack, { x: () => getCompositionTrackShift(index) });
              },
              onUpdate: (self) => {
                const timelineTime = self.progress * pinnedTimelineDuration;
                const index = getPinnedIndexFromTime(timelineTime);

                if (Date.now() > navLockUntil) setPinnedActivePoint(index);
              },
            },
          });

          pinnedTimeline = timeline;
          pinnedTrigger = timeline.scrollTrigger;

          pinnedPoints.forEach((point, index) => {
            const position = index;

            if (index > 0) {
              const itemTweenVars = {
                width: "auto",
                x: 0,
                duration: itemDuration,
              };

              if (revealDuration === null) {
                itemTweenVars.autoAlpha = 1;
              }

              timeline
                .to(pinnedPoints[index - 1], { autoAlpha: 0, x: -42, duration: 0.48 }, position - 0.42)
                .fromTo(
                  pinnedPoints[index],
                  { autoAlpha: 0, x: 64 },
                  { autoAlpha: 1, x: 0, duration: 0.78 },
                  position,
                )
                .fromTo(
                  compositionItems[index],
                  collapseItems ? { autoAlpha: 0, width: 0, x: 64 } : { autoAlpha: 0, width: "auto", x: 64 },
                  itemTweenVars,
                  position + itemStart,
                );

              if (revealDuration !== null) {
                timeline.to(
                  compositionItems[index],
                  { autoAlpha: 1, duration: revealDuration, ease: "power1.out" },
                  position + (revealStart ?? itemStart),
                );
              }

              if (trackStart !== null) {
                timeline.to(
                  compositionTrack,
                  { x: () => getCompositionTrackShift(index), duration: 0.95, ease: "power2.inOut" },
                  position + trackStart,
                );
              }
            }
          });

          timeline.to({ hold: 0 }, { hold: 1, duration: 1.1 }, pinnedPoints.length - 0.15);
          pinnedTimelineDuration = timeline.duration();
          setPinnedActivePoint(getPinnedIndexFromTime(timeline.time()));

          return () => {
            if (pinnedTimeline === timeline) {
              pinnedTimeline = null;
              pinnedTrigger = null;
            }

            timeline.scrollTrigger?.kill();
            timeline.kill();

            if (pinInner && pinnedInner) {
              pinnedStage.style.minHeight = "";
              pinnedInner.style.position = "";
              pinnedInner.style.top = "";
            }
          };
        };

        const pinnedMatchMedia = gsap.matchMedia();
        pinnedMatchMedia.add("(min-width: 992px)", () =>
          createPinnedTimeline({
            scrub: 0.5,
            trackStart: null,
            collapseItems: true,
            itemDuration: 0.85,
            itemStart: 0.08,
            pinInner: true,
          }),
        );
        pinnedMatchMedia.add("(max-width: 991px)", () =>
          createPinnedTimeline({
            scrub: 0.2,
            trackStart: -0.42,
            collapseItems: false,
            itemDuration: 0.9,
            itemStart: -0.48,
            revealDuration: 0.28,
            revealStart: -0.52,
            recenterOnRefresh: true,
          }),
        );

        compositionItems.forEach((item) => {
          const image = item.querySelector("img");

          if (!image || image.complete) return;

          image.addEventListener(
            "load",
            () => ScrollTrigger.refresh(),
            { once: true },
          );
        });

        scrollToPinnedIndex = (index) => {
          const targetY = getPinnedScrollY(index);
          const position =
            pinnedAnchorPositions[index] ?? pinnedStepPositions[index] ?? index;
          const progress = gsap.utils.clamp(
            0,
            1,
            position / Math.max(pinnedTimelineDuration, 0.001),
          );

          navLockUntil = Date.now() + 250;
          setPinnedActivePoint(index);
          pinnedTimeline?.progress(progress);

          if (targetY === null) return;
          scrollToY(targetY, true);
          window.requestAnimationFrame(() => {
            pinnedTimeline?.progress(progress);
            ScrollTrigger.update();
            setPinnedActivePoint(index);
          });
        };

        points.forEach((point, index) => {
          point.addEventListener("click", () => scrollToPinnedIndex(index));
        });
      } else {
        points.forEach((point, index) => {
          point.addEventListener("click", () => {
            navLockUntil = Date.now() + 500;
            setActivePoint(index);
            scrollToSection(point, true, "center");
          });

          ScrollTrigger.create({
            trigger: point,
            start: "center center",
            end: "+=1",
            onEnter: () => {
              if (Date.now() > navLockUntil) setActivePoint(index);
            },
            onEnterBack: () => {
              if (Date.now() > navLockUntil) setActivePoint(index);
            },
          });
        });
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

          if (link.dataset.type === "sequence") {
            const point = points.find(
              (item) => item.dataset.anchorId === link.dataset.anchorId,
            );
            const index = point ? points.indexOf(point) : 0;

            navLockUntil = Date.now() + (isPinnedComposition ? 700 : 500);
            setActivePoint(index);

            if (isPinnedComposition) {
              scrollToPinnedIndex?.(index);
              return;
            }

            scrollToSection(point, true, "center");
            return;
          }

          const target = document.querySelector(link.dataset.target);
          if (!target) return;

          navLockUntil = Date.now() + 500;
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

      setActivePoint(0);
    });
  }

  document.addEventListener("DOMContentLoaded", initProgettazioneSequenceNav);
})();
