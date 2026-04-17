<?php
/*
 * Template Name: Pagina Statica Prodotto
 * Template Post Type: page
 */

?>
<?php
get_header();
if (have_posts()) {
        while (have_posts()): ?>

        <?php the_post();
            echo the_content(); 
        ?>

    <main class="product-main">

        <!-- HERO PRODOTTO -->
        <?php get_template_part('parts/products/hero-products', 'static'); ?>

        <!-- SEZIONE CON NAV + CONTENUTI -->
        <?php get_template_part('parts/products/product-anchors', 'section-statico'); ?>

    </main>
    
    <?php
        endwhile;
    }
get_footer('no-prefooter');
?>

<script>
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
</script>