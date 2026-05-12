jQuery(document).ready(function () {
  function initHeroVideoSlider() {
    document.querySelectorAll(".js-hero-video-slider").forEach((slider) => {
      const slides = Array.from(
        slider.querySelectorAll(".hero-video-slider__slide"),
      );
      const tabs = Array.from(
        slider.querySelectorAll(".hero-video-slider__tab"),
      );

      if (
        !slides.length ||
        !tabs.length ||
        slider.dataset.heroVideoReady === "true"
      )
        return;

      slider.dataset.heroVideoReady = "true";

      let activeIndex = 0;

      function updateProgress() {
        const activeSlide = slides[activeIndex];
        const activeTab = tabs[activeIndex];
        const video = activeSlide ? activeSlide.querySelector("video") : null;
        const progress = activeTab
          ? activeTab.querySelector(".hero-video-slider__progress")
          : null;

        if (
          video &&
          progress &&
          Number.isFinite(video.duration) &&
          video.duration > 0
        ) {
          progress.style.transform =
            "scaleX(" + Math.min(video.currentTime / video.duration, 1) + ")";
        }

        window.requestAnimationFrame(updateProgress);
      }

      function setActiveSlide(index) {
        if (index < 0 || index >= slides.length) return;

        slides.forEach((slide, slideIndex) => {
          const isActive = slideIndex === index;
          const video = slide.querySelector("video");

          slide.classList.toggle("is-active", isActive);

          if (video) {
            if (isActive) {
              video.currentTime = 0;
              video.play().catch(() => {});
            } else {
              video.pause();
            }
          }
        });

        tabs.forEach((tab, tabIndex) => {
          const isActive = tabIndex === index;
          const progress = tab.querySelector(".hero-video-slider__progress");

          tab.classList.toggle("is-active", isActive);
          tab.setAttribute("aria-selected", isActive ? "true" : "false");

          if (progress) {
            progress.style.transform = "scaleX(0)";
          }
        });

        activeIndex = index;
      }

      tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => setActiveSlide(index));
      });

      let touchStartX = 0;
      let touchStartY = 0;

      slider.addEventListener(
        "touchstart",
        (event) => {
          if (event.touches.length !== 1) return;

          touchStartX = event.touches[0].clientX;
          touchStartY = event.touches[0].clientY;
        },
        { passive: true },
      );

      slider.addEventListener(
        "touchend",
        (event) => {
          if (!touchStartX || !touchStartY) return;

          const touch = event.changedTouches[0];
          const deltaX = touch.clientX - touchStartX;
          const deltaY = touch.clientY - touchStartY;

          touchStartX = 0;
          touchStartY = 0;

          if (Math.abs(deltaX) < 45 || Math.abs(deltaX) < Math.abs(deltaY)) {
            return;
          }

          if (deltaX < 0) {
            setActiveSlide((activeIndex + 1) % slides.length);
          } else {
            setActiveSlide((activeIndex - 1 + slides.length) % slides.length);
          }
        },
        { passive: true },
      );

      slides.forEach((slide, index) => {
        const video = slide.querySelector("video");

        if (!video) return;

        video.addEventListener("ended", () => {
          setActiveSlide((index + 1) % slides.length);
        });
      });

      setActiveSlide(0);
      window.requestAnimationFrame(updateProgress);

      document.addEventListener("visibilitychange", () => {
        const activeVideo = slides[activeIndex]
          ? slides[activeIndex].querySelector("video")
          : null;

        if (!activeVideo) return;

        if (document.hidden) {
          activeVideo.pause();
        } else {
          activeVideo.play().catch(() => {});
        }
      });
    });
  }

  initHeroVideoSlider();

  jQuery(".carousel-text-2").owlCarousel({
    loop: false,
    margin: 0,
    nav: true,
    items: 2,
    navText: [
      '<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><foreignObject x="-59.2095" y="-59.2095" width="168.419" height="168.418"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(29.6px);clip-path:url(#bgblur_0_3675_10911_clip_path);height:100%;width:100%"></div></foreignObject><rect data-figma-bg-blur-radius="59.2095" width="49.9992" height="49.9992" rx="7.8946" fill="#B2B4B7"/><path d="M28.5164 14.5074L19.3555 23.6682C18.8404 24.1833 18.8404 25.0202 19.3555 25.5352L28.5187 34.6984" stroke="white" stroke-width="1.31577" stroke-linecap="round" stroke-linejoin="round"/><defs><clipPath id="bgblur_0_3675_10911_clip_path" transform="translate(59.2095 59.2095)"><rect width="49.9992" height="49.9992" rx="7.8946"/></clipPath></defs></svg>',
      '<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><foreignObject x="-59.2095" y="-59.2095" width="168.419" height="168.418"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(29.6px);clip-path:url(#bgblur_0_3675_10916_clip_path);height:100%;width:100%"></div></foreignObject><rect data-figma-bg-blur-radius="59.2095" x="50" y="49.9992" width="49.9992" height="49.9992" rx="7.8946" transform="rotate(-180 50 49.9992)" fill="#B2B4B7"/><path d="M21.4836 35.4918L30.6445 26.331C31.1596 25.8159 31.1596 24.979 30.6445 24.4639L21.4813 15.3007" stroke="white" stroke-width="1.31577" stroke-linecap="round" stroke-linejoin="round"/><defs><clipPath id="bgblur_0_3675_10916_clip_path" transform="translate(59.2095 59.2095)"><rect x="50" y="49.9992" width="49.9992" height="49.9992" rx="7.8946" transform="rotate(-180 50 49.9992)"/></clipPath></defs></svg>',
    ],
    responsive: {
      0: { items: 1, margin: 25, stagePadding: 15 },
      767: { items: 1, margin: 25, stagePadding: 120 },
      992: { items: 2, margin: 25, stagePadding: 70 },
      1536: { items: 2, margin: 40, stagePadding: 100 },
      1920: { items: 2, margin: 55, stagePadding: 100 },
    },
  });

  jQuery(".single-slider-carousel-txt-ext").owlCarousel({
    loop: false,
    margin: 0,
    nav: true,
    items: 1,
    navText: [
      '<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><foreignObject x="-59.2095" y="-59.2095" width="168.419" height="168.418"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(29.6px);clip-path:url(#bgblur_0_3675_10911_clip_path);height:100%;width:100%"></div></foreignObject><rect data-figma-bg-blur-radius="59.2095" width="49.9992" height="49.9992" rx="7.8946" fill="#B2B4B7"/><path d="M28.5164 14.5074L19.3555 23.6682C18.8404 24.1833 18.8404 25.0202 19.3555 25.5352L28.5187 34.6984" stroke="white" stroke-width="1.31577" stroke-linecap="round" stroke-linejoin="round"/><defs><clipPath id="bgblur_0_3675_10911_clip_path" transform="translate(59.2095 59.2095)"><rect width="49.9992" height="49.9992" rx="7.8946"/></clipPath></defs></svg>',
      '<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><foreignObject x="-59.2095" y="-59.2095" width="168.419" height="168.418"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(29.6px);clip-path:url(#bgblur_0_3675_10916_clip_path);height:100%;width:100%"></div></foreignObject><rect data-figma-bg-blur-radius="59.2095" x="50" y="49.9992" width="49.9992" height="49.9992" rx="7.8946" transform="rotate(-180 50 49.9992)" fill="#B2B4B7"/><path d="M21.4836 35.4918L30.6445 26.331C31.1596 25.8159 31.1596 24.979 30.6445 24.4639L21.4813 15.3007" stroke="white" stroke-width="1.31577" stroke-linecap="round" stroke-linejoin="round"/><defs><clipPath id="bgblur_0_3675_10916_clip_path" transform="translate(59.2095 59.2095)"><rect x="50" y="49.9992" width="49.9992" height="49.9992" rx="7.8946" transform="rotate(-180 50 49.9992)"/></clipPath></defs></svg>',
    ],
  });

  jQuery(".single-slider-carousel-txt-ext").on(
    "initialized.owl.carousel changed.owl.carousel",
    function (e) {
      if (!e.namespace) return;

      var index = e.item.index;
      jQuery('[class^="text-slide-"]').removeClass("active");

      setTimeout(function () {
        jQuery(".text-slide-" + index).addClass("active");
      }, 500);
    },
  );
});

gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

const filcarLayoutRefreshCallbacks = [];
let filcarLayoutRefreshTimer = null;
const filcarStartAtTop = filcarShouldStartAtTop();

function filcarShouldStartAtTop() {
  if (window.location.hash) return false;

  const navigationEntry = performance.getEntriesByType
    ? performance.getEntriesByType("navigation")[0]
    : null;
  const navigationType = navigationEntry
    ? navigationEntry.type
    : performance.navigation && performance.navigation.type === 1
      ? "reload"
      : "navigate";

  return navigationType === "reload" || navigationType === "back_forward";
}

function filcarForceStartAtTop() {
  if (!filcarStartAtTop) return;

  if ("scrollRestoration" in history) {
    history.scrollRestoration = "manual";
  }

  const previousScrollBehavior = document.documentElement.style.scrollBehavior;

  document.documentElement.style.scrollBehavior = "auto";
  window.scrollTo(0, 0);
  document.documentElement.style.scrollBehavior = previousScrollBehavior;
}

filcarForceStartAtTop();

function filcarOnLayoutRefresh(callback) {
  if (typeof callback === "function") {
    filcarLayoutRefreshCallbacks.push(callback);
  }
}

function filcarRefreshOwlCarousels() {
  if (!window.jQuery) return;

  jQuery(".owl-carousel.owl-loaded").trigger("refresh.owl.carousel");
}

function filcarRunLayoutRefresh(preserveScroll = false) {
  const scrollY = preserveScroll
    ? window.pageYOffset || window.scrollY || 0
    : null;

  filcarRefreshOwlCarousels();

  if (window.ScrollTrigger) {
    ScrollTrigger.sort();
    ScrollTrigger.refresh(true);

    if (preserveScroll && scrollY !== null) {
      window.requestAnimationFrame(() => {
        window.scrollTo(0, scrollY);
        ScrollTrigger.update();
      });
    }

    ScrollTrigger.update();
  }

  filcarLayoutRefreshCallbacks.forEach((callback) => callback());
}

function filcarScheduleLayoutRefresh(delay = 140, preserveScroll = false) {
  window.clearTimeout(filcarLayoutRefreshTimer);

  filcarLayoutRefreshTimer = window.setTimeout(() => {
    window.requestAnimationFrame(() => filcarRunLayoutRefresh(preserveScroll));
  }, delay);
}

window.addEventListener("resize", () => filcarScheduleLayoutRefresh(180));
window.addEventListener("orientationchange", () =>
  filcarScheduleLayoutRefresh(260),
);
window.addEventListener("pageshow", () => {
  filcarForceStartAtTop();
  filcarScheduleLayoutRefresh(80);
});

if (document.fonts && document.fonts.ready) {
  document.fonts.ready
    .then(() => filcarScheduleLayoutRefresh(40))
    .catch(() => {});
}

window.addEventListener("load", () => {
  filcarForceStartAtTop();
  window.requestAnimationFrame(() => filcarRunLayoutRefresh(false));
  window.setTimeout(() => {
    filcarForceStartAtTop();
    window.requestAnimationFrame(() => filcarRunLayoutRefresh(false));
  }, 320);
});

document.addEventListener("DOMContentLoaded", () => {
  const siteHeader = document.querySelector(".flc-main-nav");
  const navWrap = document.querySelector(".js-anchor-nav-wrap");
  const navLinks = gsap.utils.toArray(".anchor-link");
  const sections = gsap.utils.toArray(".js-section");
  const stickyButton = document.querySelector(".button-sticky-container");
  const panoramica = document.querySelector("#panoramica");
  const correlati = document.querySelector("#correlati");

  const smoother = window.ScrollSmoother ? ScrollSmoother.get() : null;

  let currentActiveId = null;
  let siteHeaderVisible = true;

  if (siteHeader) {
    document.body.classList.add("site-header-visible");
    document.body.classList.remove("site-header-hidden");
  }

  function getScrollTop() {
    if (smoother) return smoother.scrollTop();
    return window.pageYOffset || window.scrollY || 0;
  }

  function getHeaderHeight() {
    if (!siteHeader) return 0;
    return siteHeaderVisible ? siteHeader.offsetHeight : 0;
  }

  function getActivationY() {
    return getScrollTop() + getHeaderHeight() + 12;
  }

  function showSiteHeader() {
    if (!siteHeader || siteHeaderVisible) return;

    siteHeaderVisible = true;
    siteHeader.classList.remove("is-hidden");
    document.body.classList.remove("site-header-hidden");
    document.body.classList.add("site-header-visible");
  }

  function hideSiteHeader() {
    if (!siteHeader || !siteHeaderVisible) return;

    siteHeaderVisible = false;
    siteHeader.classList.add("is-hidden");
    document.body.classList.remove("site-header-visible");
    document.body.classList.add("site-header-hidden");
  }

  function centerNavItem(activeLink) {
    if (!navWrap || !activeLink) return;

    const wrapWidth = navWrap.clientWidth;
    const itemLeft = activeLink.offsetLeft;
    const itemWidth = activeLink.offsetWidth;

    const targetX = itemLeft - wrapWidth / 2 + itemWidth / 2;
    const maxX = navWrap.scrollWidth - wrapWidth;
    const finalX = Math.max(0, Math.min(targetX, maxX));

    navWrap.scrollTo({
      left: finalX,
      behavior: "smooth",
    });
  }

  function setActiveLink(targetId) {
    if (!targetId || currentActiveId === targetId) return;

    currentActiveId = targetId;

    navLinks.forEach((link) => {
      const isActive = link.dataset.target === `#${targetId}`;
      link.classList.toggle("is-active", isActive);

      if (isActive) {
        centerNavItem(link);
      }
    });
  }

  function updateActiveSection() {
    if (!sections.length) return;

    const activationY = getActivationY();
    let activeSection = sections[0];

    sections.forEach((section) => {
      if (section.offsetTop <= activationY) {
        activeSection = section;
      }
    });

    if (activeSection) {
      setActiveLink(activeSection.id);
    }
  }

  function scrollToSection(targetSelector) {
    const target = document.querySelector(targetSelector);
    if (!target) return;

    const offset = getHeaderHeight() + 8;

    if (smoother) {
      smoother.scrollTo(target, true, `top top+=${offset}`);
    } else {
      const top =
        target.getBoundingClientRect().top + window.pageYOffset - offset;

      window.scrollTo({
        top,
        behavior: "smooth",
      });
    }
  }

  navLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();

      const targetSelector = link.dataset.target;
      if (!targetSelector) return;

      const targetId = targetSelector.replace("#", "");
      setActiveLink(targetId);
      scrollToSection(targetSelector);
    });
  });

  ScrollTrigger.create({
    start: 0,
    end: "max",
    onUpdate: updateActiveSection,
  });

  // scroll down -> hide
  // scroll up   -> show
  ScrollTrigger.create({
    start: 0,
    end: "max",
    onUpdate: (self) => {
      const currentY = getScrollTop();

      if (currentY <= 10) {
        showSiteHeader();
        return;
      }

      if (self.direction === 1) {
        hideSiteHeader();
      } else if (self.direction === -1) {
        showSiteHeader();
      }
    },
  });

  if (stickyButton) {
    stickyButton.classList.remove("is-visible");
  }

  if (stickyButton && panoramica && correlati) {
    const showButton = () => stickyButton.classList.add("is-visible");
    const hideButton = () => stickyButton.classList.remove("is-visible");

    ScrollTrigger.create({
      trigger: panoramica,
      start: "top 20%",
      onEnter: showButton,
      onLeaveBack: hideButton,
    });

    ScrollTrigger.create({
      trigger: correlati,
      start: "bottom bottom",
      onEnter: hideButton,
      onLeaveBack: showButton,
    });
  }

  window.addEventListener("load", () => {
    const hash = window.location.hash;
    const offset = getHeaderHeight() + 8;

    if (hash && document.querySelector(hash)) {
      if (smoother) {
        smoother.scrollTo(hash, false, `top top+=${offset}`);
      } else {
        gsap.set(window, {
          scrollTo: {
            y: hash,
            offsetY: offset,
          },
        });
      }
    }

    updateActiveSection();
    filcarScheduleLayoutRefresh(60);
  });

  filcarOnLayoutRefresh(() => {
    updateActiveSection();
  });
});

jQuery(document).on("click", ".video-overlay", function () {
  const $overlay = jQuery(this);
  const $video = $overlay.siblings("video");
  const videoElement = $video[0];

  $video.off("pause ended");

  $overlay.fadeOut(400, function () {
    $overlay.attr(
      "style",
      ($overlay.attr("style") || "") + "; display: none !important;",
    );

    const playPromise = videoElement.play();

    if (playPromise !== undefined) {
      playPromise
        .then(() => {
          videoElement.controls = true;

          setTimeout(() => {
            $video.on("pause ended", function () {
              if (videoElement.paused || videoElement.ended) {
                videoElement.controls = false;
                $overlay.css("display", "flex");
                $overlay.hide().fadeIn(400);
              }
            });
          }, 500);
        })
        .catch(() => {
          $overlay.attr(
            "style",
            ($overlay.attr("style") || "").replace(
              "display: none !important;",
              "",
            ),
          );
          $overlay.show();
        });
    }
  });
});

const firstVideo = document.querySelector("video");

if (firstVideo) {
  firstVideo.addEventListener("pause", (e) => {
    console.log("Pausa triggerata da:", e.target);
    console.log("Tempo attuale video:", e.target.currentTime);
  });
}

/**
 * Funzione per calcolare l'altezza dinamica del megamenu
 */

document.addEventListener("DOMContentLoaded", function () {
  /**
   * 1. GESTIONE CLICK ATTREZZATURE OPERATIVE
   * Cambia i pannelli a destra al click sulla sidebar a sinistra
   */
  const attrWrapper = document.querySelector(".attrezzature-wrapper");
  if (attrWrapper) {
    attrWrapper.addEventListener("click", function (e) {
      const trigger = e.target.closest(".attrezzature-trigger");
      if (trigger) {
        // Impediamo la chiusura del menu e la navigazione del '#'
        e.preventDefault();
        e.stopPropagation();

        const targetId = trigger.getAttribute("data-bs-target");

        // Reset classi Attivo sui trigger
        attrWrapper
          .querySelectorAll(".attrezzature-trigger")
          .forEach((t) => t.classList.remove("is-active"));
        // Nascondi tutti i pannelli
        attrWrapper.querySelectorAll(".attrezzature-panel").forEach((p) => {
          p.classList.remove("d-block");
          p.classList.add("d-none");
        });

        // Attiva quello cliccato
        trigger.classList.add("is-active");
        const panel = attrWrapper.querySelector(targetId);
        if (panel) {
          panel.classList.remove("d-none");
          panel.classList.add("d-block");
        }
      }
    });
  }

  /**
   * 2. PREVENZIONE CHIUSURA DROPDOWN (BOOTSTRAP)
   * Impedisce a Bootstrap di chiudere il menu se clicchiamo su elementi non-link
   */
  const specialMenus = document.querySelectorAll(
    ".arredo-tecnico-megamenu, .attrezzature-megamenu",
  );
  specialMenus.forEach((menu) => {
    menu.addEventListener("click", function (e) {
      const isRealLink =
        e.target.closest("a") &&
        e.target.closest("a").getAttribute("href") !== "#" &&
        e.target.closest("a").getAttribute("href") !== "";

      // Se NON è un link vero, ferma la propagazione così Bootstrap non sente il click
      if (!isRealLink) {
        e.stopPropagation();
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.querySelector(".js-toggle-menu");
  const rightNav = document.querySelector(".flc-right-nav");

  // 1. Apertura Menu Mobile
  if (toggleBtn && rightNav) {
    toggleBtn.addEventListener("click", function (e) {
      e.preventDefault();
      this.classList.toggle("is-active");
      rightNav.classList.toggle("is-active");
      document.body.classList.toggle("menu-open");
    });
  }

  // 2. Gestione Accordion Livello 0
  if (rightNav) {
    rightNav.addEventListener(
      "click",
      function (e) {
        const trigger = e.target.closest(".js-accordion-trigger");
        const isInside = e.target.closest(".accordion-collapse");

        if (trigger || isInside) {
          // Se non è un link di navigazione reale, blocchiamo la chiusura automatica del menu
          const isLink =
            e.target.closest("a") &&
            e.target.closest("a").getAttribute("href") !== "#";

          if (!isLink) {
            e.stopPropagation();
            e.stopImmediatePropagation();

            if (trigger) {
              const targetId = trigger.getAttribute("data-bs-target");
              const targetEl = document.querySelector(targetId);
              if (targetEl) {
                trigger.classList.toggle("is-active");
                // Se Bootstrap è caricato, lo usiamo, altrimenti toggle manuale
                if (window.bootstrap) {
                  let bsCol =
                    bootstrap.Collapse.getInstance(targetEl) ||
                    new bootstrap.Collapse(targetEl);
                  bsCol.toggle();
                } else {
                  targetEl.classList.toggle("show");
                }
              }
            }
          }
        }
      },
      true,
    );
  }
});

document.addEventListener("DOMContentLoaded", () => {
  function initInnovationScroll() {
    const sections = gsap.utils.toArray(".js-innovation-scroll");

    if (!sections.length || !window.ScrollTrigger) return;

    sections.forEach((section) => {
      if (section.dataset.innovationReady === "true") return;

      const pin = section.querySelector(".innovation-scroll__pin");
      const media = section.querySelector(".innovation-scroll__media");
      const intro = section.querySelector(".innovation-scroll__intro");
      const content = section.querySelector(".innovation-scroll__content");
      const bar = section.querySelector(".innovation-scroll__bar");

      if (!pin || !media || !intro || !content) return;

      section.dataset.innovationReady = "true";

      const isMobileViewport = () =>
        window.matchMedia("(max-width: 1024px)").matches;
      const endDistance = () => (isMobileViewport() ? "+=180%" : "+=220%");
      const shrinkDuration = 0.72;
      const introDuration = 0.22;
      const getMediaWidth = () =>
        isMobileViewport() ? "calc(100% - 48px)" : "73.2vw";
      const getMediaHeight = () =>
        isMobileViewport() ? 193 : Math.min(window.innerHeight * 0.64, 620);
      const getMediaY = () =>
        isMobileViewport()
          ? 166
          : Math.max(38, Math.min(58, window.innerHeight * 0.055));
      const getIntroY = () => (isMobileViewport() ? -30 : -50);
      const getContentY = () => (isMobileViewport() ? 28 : 42);
      const getBarScale = () => (isMobileViewport() ? 0.9 : 0.86);

      gsap.set(content, { autoAlpha: 0, y: getContentY });
      gsap.set(bar, { scaleX: 1 });

      const timeline = gsap.timeline({
        defaults: { ease: "none" },
        scrollTrigger: {
          trigger: section,
          start: "top top",
          end: endDistance,
          scrub: 0.85,
          pin,
          anticipatePin: 1,
          invalidateOnRefresh: true,
          onRefreshInit: () => {
            gsap.set(content, { y: getContentY });
            gsap.set(bar, { scaleX: 1 });
          },
        },
      });

      timeline
        .to(
          media,
          {
            width: getMediaWidth,
            height: getMediaHeight,
            y: getMediaY,
            borderRadius: () => (isMobileViewport() ? 5 : 4),
            duration: shrinkDuration,
          },
          0,
        )
        .to(
          intro,
          {
            autoAlpha: 0,
            y: getIntroY,
            duration: introDuration,
          },
          0.06,
        )
        .fromTo(
          content,
          { autoAlpha: 0, y: getContentY },
          { autoAlpha: 1, y: 0, duration: 0.24 },
          0.58,
        )
        .to(bar, { scaleX: getBarScale, duration: 0.16 }, 0.68)
        .to({}, { duration: 0.28 });
    });
  }

  initInnovationScroll();
  filcarForceStartAtTop();
  filcarScheduleLayoutRefresh(80);
});

document.addEventListener("DOMContentLoaded", () => {
  function initTechnicalTextScroll() {
    const sections = document.querySelectorAll(".js-technical-text-scroll");

    if (!sections.length) return;

    sections.forEach((section) => {
      if (section.dataset.technicalTextReady === "true") return;

      const textElement = section.querySelector(
        ".js-technical-text-scroll-text",
      );

      if (!textElement) return;

      section.dataset.technicalTextReady = "true";

      const textNodes = [];
      const walker = document.createTreeWalker(
        textElement,
        NodeFilter.SHOW_TEXT,
        {
          acceptNode(node) {
            return node.nodeValue.trim()
              ? NodeFilter.FILTER_ACCEPT
              : NodeFilter.FILTER_REJECT;
          },
        },
      );

      while (walker.nextNode()) {
        textNodes.push(walker.currentNode);
      }

      textNodes.forEach((node) => {
        const fragment = document.createDocumentFragment();
        const parts = node.nodeValue.split(/(\s+)/);

        parts.forEach((part) => {
          if (!part) return;

          if (/^\s+$/.test(part)) {
            fragment.appendChild(document.createTextNode(part));
            return;
          }

          const word = document.createElement("span");
          word.className = "technical-text-scroll__word";
          word.textContent = part;
          fragment.appendChild(word);
        });

        node.parentNode.replaceChild(fragment, node);
      });

      const words = Array.from(
        textElement.querySelectorAll(".technical-text-scroll__word"),
      );

      if (!words.length) return;

      const setProgress = (progress) => {
        const easedProgress = window.gsap
          ? window.gsap.parseEase("power1.out")(progress)
          : progress;
        const activeWords = Math.ceil(easedProgress * words.length);

        words.forEach((word, index) => {
          word.classList.toggle("is-active", index < activeWords);
        });
      };

      if (
        window.matchMedia("(prefers-reduced-motion: reduce)").matches ||
        !window.ScrollTrigger
      ) {
        setProgress(1);
        return;
      }

      setProgress(0);

      ScrollTrigger.create({
        trigger: section,
        start: "center bottom-=10%",
        end: "bottom 52%",
        scrub: true,
        invalidateOnRefresh: true,
        markers: true,
        onUpdate: (self) => setProgress(self.progress),
        onRefresh: (self) => setProgress(self.progress),
      });
    });
  }

  initTechnicalTextScroll();
});

document.addEventListener("DOMContentLoaded", () => {
  function initExpandableCards() {
    const sections = document.querySelectorAll(".js-expandable-cards");

    if (!sections.length) return;

    sections.forEach((section) => {
      if (section.dataset.expandableCardsReady === "true") return;

      const cards = Array.from(
        section.querySelectorAll(".expandable-cards__card"),
      );
      const list = section.querySelector(".expandable-cards__list");
      const prevButton = section.querySelector(
        ".expandable-cards__control--prev",
      );
      const nextButton = section.querySelector(
        ".expandable-cards__control--next",
      );

      if (!cards.length || !list) return;

      section.dataset.expandableCardsReady = "true";

      const setActiveCard = (index) => {
        cards.forEach((card, cardIndex) => {
          const isActive = cardIndex === index;
          const value = card.querySelector(".expandable-cards__value");

          card.classList.toggle("is-active", isActive);
          card.setAttribute("aria-expanded", isActive ? "true" : "false");

          if (value) {
            value.classList.toggle("number-1", isActive);
            value.classList.toggle("number-2", !isActive);
          }
        });
      };

      cards.forEach((card, index) => {
        card.addEventListener("click", () => setActiveCard(index));
        card.addEventListener("keydown", (event) => {
          if (event.key !== "Enter" && event.key !== " ") return;

          event.preventDefault();
          setActiveCard(index);
        });
      });

      const scrollCards = (direction) => {
        const firstCard = cards[0];
        if (!firstCard) return;

        const gap = parseFloat(window.getComputedStyle(list).columnGap || 0);
        const step = firstCard.getBoundingClientRect().width + gap;

        list.scrollBy({
          left: direction * step,
          behavior: "smooth",
        });
      };

      if (prevButton) {
        prevButton.addEventListener("click", () => scrollCards(-1));
      }

      if (nextButton) {
        nextButton.addEventListener("click", () => scrollCards(1));
      }

      filcarOnLayoutRefresh(() => {
        const activeCard = section.querySelector(
          ".expandable-cards__card.is-active",
        );

        if (activeCard && window.matchMedia("(max-width: 991px)").matches) {
          list.scrollTo({
            left: activeCard.offsetLeft,
            behavior: "auto",
          });
        }
      });
    });
  }

  initExpandableCards();
});

document.addEventListener("DOMContentLoaded", function () {
  // 3. Gestione Accordion Livello 1
  const searchToggle = document.querySelector(".search-toggle");
  const searchContainer = document.querySelector(".flc-search-container");
  if (searchToggle) {
    searchToggle.addEventListener("click", function (e) {
      e.preventDefault();
      searchContainer.classList.toggle("show");
    });
  }
  const searchClose = document.querySelector(".search-close");
  if (searchClose) {
    searchClose.addEventListener("click", function (e) {
      e.preventDefault();
      searchContainer.classList.remove("show");
    });
  }
  const searchSubmit = document.querySelector(".search-submit");
  const form = document.getElementById("searchform");
  if (searchSubmit) {
    searchSubmit.addEventListener("click", function (e) {
      e.preventDefault();
      form.submit();
    });
  }
});
jQuery(document).ready(function () {
  jQuery(".carousel-sectors").owlCarousel({
    loop: false,
    margin: 24,
    nav: true,
    navText: [
      '<span class="icon-filcar-icon-chevron-forward"></span>',
      '<span class="icon-filcar-icon-chevron-forward"></span>',
    ],
    items: 1,
    dots: false,
    responsive: {
      0: {
        items: 1,
        stagePadding: 30,
      },
      767: {
        items: 2,
        stagePadding: 50,
      },
      992: {
        items: 2,
        stagePadding: 50,
      },
      1350: {
        items: 2,
        stagePadding: 100,
      },
      2250: {
        items: 2,
        stagePadding: 150,
      },
    },
  });

  jQuery(".js-case-studies-carousel").each(function () {
    const $carousel = jQuery(this);
    const itemsCount = $carousel.children().length;

    if (itemsCount <= 1) {
      $carousel.addClass("is-single");
    }

    $carousel.owlCarousel({
      loop: false,
      center: itemsCount > 1,
      startPosition: itemsCount > 1 ? 1 : 0,
      autoWidth: true,
      margin: 24,
      nav: true,
      dots: true,
      navText: [
        '<span class="icon-filcar-icon-chevron-forward"></span>',
        '<span class="icon-filcar-icon-chevron-forward"></span>',
      ],
      responsive: {
        0: {
          margin: 18,
          stagePadding: 24,
        },
        768: {
          margin: 24,
          stagePadding: 70,
        },
        992: {
          margin: 24,
          stagePadding: 120,
        },
        1535: {
          margin: 32,
          stagePadding: 170,
        },
      },
    });
  });
});










gsap.utils.toArray(".stb_line_single_1").forEach((line, i) => {
  const links = line.querySelectorAll(".stb-item"),
  tl = horizontalLoop(links, {
    repeat: -1,
    speed: 1 + i * 0.5,
    reversed: true,
    paddingRight: parseFloat(gsap.getProperty(links[0], "marginRight", "px")), // otherwise first element would be right up against the last when it loops. In this layout, the spacing is done with marginRight.
  });
  links.forEach((link) => {
    link.addEventListener("mouseenter", () =>
      gsap.to(tl, { timeScale: 0, overwrite: true }),
    );
    link.addEventListener("mouseleave", () =>
      gsap.to(tl, { timeScale: -1, overwrite: true }),
    );
  });
});

// Aspetta che tutto sia renderizzato
gsap.utils.toArray(".stb_line_single_2").forEach((line, i) => {
  const links = line.querySelectorAll(".stb-item"),
  tl = horizontalLoop(links, {
    repeat: -1,
    speed: 1,
    reversed: false, // sempre false, niente reversed
    paddingRight: parseFloat(gsap.getProperty(links[0], "marginRight", "px")),
  });
  links.forEach((link) => {
    link.addEventListener("mouseenter", () =>
      gsap.to(tl, { timeScale: 0, overwrite: true }),
    );
    link.addEventListener("mouseleave", () =>
      gsap.to(tl, { timeScale: 1, overwrite: true }),
    );
  });
});

/*
This helper function makes a group of elements animate along the x-axis in a seamless, responsive loop.

Features:
 - Uses xPercent so that even if the widths change (like if the window gets resized), it should still work in most cases.
 - When each item animates to the left or right enough, it will loop back to the other side
 - Optionally pass in a config object with values like "speed" (default: 1, which travels at roughly 100 pixels per second), paused (boolean),  repeat, reversed, and paddingRight.
 - The returned timeline will have the following methods added to it:
   - next() - animates to the next element using a timeline.tweenTo() which it returns. You can pass in a vars object to control duration, easing, etc.
   - previous() - animates to the previous element using a timeline.tweenTo() which it returns. You can pass in a vars object to control duration, easing, etc.
   - toIndex() - pass in a zero-based index value of the element that it should animate to, and optionally pass in a vars object to control duration, easing, etc. Always goes in the shortest direction
   - current() - returns the current index (if an animation is in-progress, it reflects the final index)
   - times - an Array of the times on the timeline where each element hits the "starting" spot. There's also a label added accordingly, so "label1" is when the 2nd element reaches the start.
 */
function horizontalLoop(items, config) {
  items = gsap.utils.toArray(items);
  config = config || {};
  let tl = gsap.timeline({
    repeat: config.repeat,
    paused: config.paused,
    defaults: { ease: "none" },
    onReverseComplete: () => tl.totalTime(tl.rawTime() + tl.duration() * 100),
  }),
  length = items.length,
  startX = items[0].offsetLeft,
  times = [],
  widths = [],
  xPercents = [],
  curIndex = 0,
  pixelsPerSecond = (config.speed || 1) * 100,
  snap = config.snap === false ? (v) => v : gsap.utils.snap(config.snap || 1), // some browsers shift by a pixel to accommodate flex layouts, so for example if width is 20% the first element's width might be 242px, and the next 243px, alternating back and forth. So we snap to 5 percentage points to make things look more natural
  totalWidth,
  curX,
  distanceToStart,
  distanceToLoop,
  item,
  i;
  gsap.set(items, {
    // convert "x" to "xPercent" to make things responsive, and populate the widths/xPercents Arrays to make lookups faster.
    xPercent: (i, el) => {
      let w = (widths[i] = parseFloat(gsap.getProperty(el, "width", "px")));
      xPercents[i] = snap(
        (parseFloat(gsap.getProperty(el, "x", "px")) / w) * 100 +
          gsap.getProperty(el, "xPercent"),
      );
      return xPercents[i];
    },
  });
  gsap.set(items, { x: 0 });
  totalWidth =
    items[length - 1].offsetLeft +
    (xPercents[length - 1] / 100) * widths[length - 1] -
    startX +
    items[length - 1].offsetWidth *
      gsap.getProperty(items[length - 1], "scaleX") +
    (parseFloat(config.paddingRight) || 0);
  for (i = 0; i < length; i++) {
    item = items[i];
    curX = (xPercents[i] / 100) * widths[i];
    distanceToStart = item.offsetLeft + curX - startX;
    distanceToLoop = distanceToStart + widths[i] * gsap.getProperty(item, "scaleX");
    tl.to(
      item,
      {
        xPercent: snap(((curX - distanceToLoop) / widths[i]) * 100),
        duration: distanceToLoop / pixelsPerSecond,
      },
      0,
    ).fromTo(
      item,
      {
        xPercent: snap(
          ((curX - distanceToLoop + totalWidth) / widths[i]) * 100,
        ),
      },
      {
        xPercent: xPercents[i],
        duration:
          (curX - distanceToLoop + totalWidth - curX) / pixelsPerSecond,
        immediateRender: false,
      },
      distanceToLoop / pixelsPerSecond,
    ).add("label" + i, distanceToStart / pixelsPerSecond);
    times[i] = distanceToStart / pixelsPerSecond;
  }
  function toIndex(index, vars) {
    vars = vars || {};
    Math.abs(index - curIndex) > length / 2 &&
      (index += index > curIndex ? -length : length); // always go in the shortest direction
    let newIndex = gsap.utils.wrap(0, length, index),
      time = times[newIndex];
    if (time > tl.time() !== index > curIndex) {
      // if we're wrapping the timeline's playhead, make the proper adjustments
      vars.modifiers = { time: gsap.utils.wrap(0, tl.duration()) };
      time += tl.duration() * (index > curIndex ? 1 : -1);
    }
    curIndex = newIndex;
    vars.overwrite = true;
    return tl.tweenTo(time, vars);
  }
  tl.next = (vars) => toIndex(curIndex + 1, vars);
  tl.previous = (vars) => toIndex(curIndex - 1, vars);
  tl.current = () => curIndex;
  tl.toIndex = (index, vars) => toIndex(index, vars);
  tl.times = times;
  if (config.reversed) {
    tl.vars.onReverseComplete();
    tl.reverse();
  }
  return tl;
}

const searchInPage = document.querySelector('.search-in-page');

const sentinel = document.createElement('div');
sentinel.style.cssText = 'position:absolute;top:50px;height:1px;width:1px;pointer-events:none;';
searchInPage.parentElement.insertBefore(sentinel, searchInPage);

const observer = new IntersectionObserver(([entry]) => {
    searchInPage.classList.toggle('is-sticky', !entry.isIntersecting);
}, { threshold: 0 });

observer.observe(sentinel);