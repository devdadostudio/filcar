jQuery(document).ready(function() {
    jQuery('.carousel-text-2').owlCarousel({
        loop:false,
        margin:0,
        nav:true,
        items: 2,
        navText: [
          '<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><foreignObject x="-59.2095" y="-59.2095" width="168.419" height="168.418"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(29.6px);clip-path:url(#bgblur_0_3675_10911_clip_path);height:100%;width:100%"></div></foreignObject><rect data-figma-bg-blur-radius="59.2095" width="49.9992" height="49.9992" rx="7.8946" fill="#B2B4B7"/><path d="M28.5164 14.5074L19.3555 23.6682C18.8404 24.1833 18.8404 25.0202 19.3555 25.5352L28.5187 34.6984" stroke="white" stroke-width="1.31577" stroke-linecap="round" stroke-linejoin="round"/><defs><clipPath id="bgblur_0_3675_10911_clip_path" transform="translate(59.2095 59.2095)"><rect width="49.9992" height="49.9992" rx="7.8946"/></clipPath></defs></svg>',
          '<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><foreignObject x="-59.2095" y="-59.2095" width="168.419" height="168.418"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(29.6px);clip-path:url(#bgblur_0_3675_10916_clip_path);height:100%;width:100%"></div></foreignObject><rect data-figma-bg-blur-radius="59.2095" x="50" y="49.9992" width="49.9992" height="49.9992" rx="7.8946" transform="rotate(-180 50 49.9992)" fill="#B2B4B7"/><path d="M21.4836 35.4918L30.6445 26.331C31.1596 25.8159 31.1596 24.979 30.6445 24.4639L21.4813 15.3007" stroke="white" stroke-width="1.31577" stroke-linecap="round" stroke-linejoin="round"/><defs><clipPath id="bgblur_0_3675_10916_clip_path" transform="translate(59.2095 59.2095)"><rect x="50" y="49.9992" width="49.9992" height="49.9992" rx="7.8946" transform="rotate(-180 50 49.9992)"/></clipPath></defs></svg>'
        ],
        responsive:{
            0:{
              items:1,
              margin:25,
              stagePadding: 15
            },
            767:{
              items:1,
              margin:25,
              stagePadding: 120
            },
            992:{
              items:2,
              margin:25,
              stagePadding: 70
            },
            1536:{
              items:2,
              margin:40,
              stagePadding: 100
            },
            1920:{
              items:2,
              margin:55,
              stagePadding: 100
            }
        }
    });
    jQuery('.single-slider-carousel-txt-ext').owlCarousel({
      loop:false,
      margin:0,
      nav:true,
      items: 1,
      navText: [
        '<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><foreignObject x="-59.2095" y="-59.2095" width="168.419" height="168.418"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(29.6px);clip-path:url(#bgblur_0_3675_10911_clip_path);height:100%;width:100%"></div></foreignObject><rect data-figma-bg-blur-radius="59.2095" width="49.9992" height="49.9992" rx="7.8946" fill="#B2B4B7"/><path d="M28.5164 14.5074L19.3555 23.6682C18.8404 24.1833 18.8404 25.0202 19.3555 25.5352L28.5187 34.6984" stroke="white" stroke-width="1.31577" stroke-linecap="round" stroke-linejoin="round"/><defs><clipPath id="bgblur_0_3675_10911_clip_path" transform="translate(59.2095 59.2095)"><rect width="49.9992" height="49.9992" rx="7.8946"/></clipPath></defs></svg>',
        '<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><foreignObject x="-59.2095" y="-59.2095" width="168.419" height="168.418"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(29.6px);clip-path:url(#bgblur_0_3675_10916_clip_path);height:100%;width:100%"></div></foreignObject><rect data-figma-bg-blur-radius="59.2095" x="50" y="49.9992" width="49.9992" height="49.9992" rx="7.8946" transform="rotate(-180 50 49.9992)" fill="#B2B4B7"/><path d="M21.4836 35.4918L30.6445 26.331C31.1596 25.8159 31.1596 24.979 30.6445 24.4639L21.4813 15.3007" stroke="white" stroke-width="1.31577" stroke-linecap="round" stroke-linejoin="round"/><defs><clipPath id="bgblur_0_3675_10916_clip_path" transform="translate(59.2095 59.2095)"><rect x="50" y="49.9992" width="49.9992" height="49.9992" rx="7.8946" transform="rotate(-180 50 49.9992)"/></clipPath></defs></svg>'
      ]
    });
    jQuery('.single-slider-carousel-txt-ext').on('initialized.owl.carousel changed.owl.carousel', function(e) {
      if (!e.namespace) return;

      var index = e.item.index;

      jQuery('[class^="text-slide-"]').removeClass('active');
      setTimeout(function() {
        jQuery('.text-slide-' + index).addClass('active');
      }, 500);
    });
});

gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

  const header = document.querySelector(".product-header");
  const navWrap = document.querySelector(".js-anchor-nav-wrap");
  const navLinks = gsap.utils.toArray(".anchor-link");
  const sections = gsap.utils.toArray(".js-section");

  const smoother = window.ScrollSmoother ? ScrollSmoother.get() : null;

  let currentActiveId = null;

  function getHeaderHeight() {
    return header ? header.offsetHeight : 0;
  }

  function getScrollTop() {
    if (smoother) {
      return smoother.scrollTop();
    }
    return window.pageYOffset || window.scrollY || 0;
  }

  function getActivationY() {
    return getScrollTop() + getHeaderHeight() + 12;
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

        const top =
            target.getBoundingClientRect().top +
            window.pageYOffset -
            offset;

        window.scrollTo({
            top,
            behavior: "smooth",
        });
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

  window.addEventListener("resize", updateActiveSection);