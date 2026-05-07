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
    ScrollTrigger.refresh();
  });

  window.addEventListener("resize", () => {
    updateActiveSection();
    ScrollTrigger.refresh();
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
      const isMobile = isMobileViewport();
      const endDistance = () => (isMobileViewport() ? "+=180%" : "+=220%");
      const shrinkDuration = 0.72;
      const introDuration = 0.22;
      const getMediaWidth = () =>
        isMobileViewport() ? "calc(100% - 48px)" : "71.5vw";
      const getMediaHeight = () =>
        isMobileViewport()
          ? 193
          : Math.min(window.innerHeight * 0.58, 540);
      const getMediaY = () =>
        isMobileViewport()
          ? 166
          : Math.max(40, Math.min(72, window.innerHeight * 0.06));

      gsap.set(content, { autoAlpha: 0, y: isMobile ? 28 : 42 });
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
            y: isMobile ? -30 : -50,
            duration: introDuration,
          },
          0.06,
        )
        .fromTo(
          content,
          { autoAlpha: 0, y: isMobile ? 28 : 42 },
          { autoAlpha: 1, y: 0, duration: 0.24 },
          0.58,
        )
        .to(bar, { scaleX: isMobile ? 0.9 : 0.86, duration: 0.16 }, 0.68)
        .to({}, { duration: 0.28 });
    });
  }

  initInnovationScroll();
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
});