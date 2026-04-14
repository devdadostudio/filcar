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
        <section class="product-anchors-section js-anchors-layout">

            <div class="product-anchors-section__inner">

                <!-- NAV ANCORE -->
                <aside class="page-header js-page-header">
                    <div class="anchor-nav-wrap js-anchor-nav-wrap">
                        <nav class="anchor-nav" aria-label="Navigazione sezioni">
                            <a
                                href="#panoramica"
                                class="anchor-link is-active"
                                data-target="#panoramica"
                                >Overview</a
                            >
                            <a href="#caratteristiche" class="anchor-link" data-target="#caratteristiche"
                                >Caratteristiche</a
                            >
                            <a href="#dimensioni" class="anchor-link" data-target="#dimensioni"
                                >Dimensioni</a
                            >
                            <a href="#dettagli" class="anchor-link" data-target="#dettagli"
                                >Dettagli</a
                            >
                            <a href="#accessori" class="anchor-link" data-target="#accessori"
                                >Optional</a
                            >
                            <a href="#correlati" class="anchor-link" data-target="#correlati"
                                >Correlati</a
                            >
                        </nav>
                    </div>
                </aside>

                <!-- CONTENUTO -->
                <div class="product-anchor-content">

                    <!-- PANORAMICA -->
                    <section id="panoramica" class="section js-section" data-anchor="panoramica">
                        <div class="section-inner">
                            <div class="product-overview">
                                <div class="product-overview__grid">

                                <div class="product-overview__content">
                                    <h1>ARMTEL</h1>
                                    <p>
                                    Braccio telescopico per l’aspirazione dei gas di scarico.
                                    Efficienza, design e massima flessibilità per ambienti professionali.
                                    </p>
                                </div>

                                <div class="product-overview__media">
                                    <img src="" alt="Prodotto">
                                </div>

                                </div>
                            </div>

                            <div class="product-dark-showcase">

                                <h2>Efficienza totale senza sacrificare il design</h2>
                                <p>
                                Progettato per garantire prestazioni elevate e durata nel tempo,
                                con una struttura robusta e altamente modulare.
                                </p>

                                <img src="" alt="Hero prodotto">

                                <div class="product-gallery-slider">

                                <div class="product-gallery-card">
                                    <img src="" alt="">
                                    <p>Configurazione 1</p>
                                </div>

                                <div class="product-gallery-card">
                                    <img src="" alt="">
                                    <p>Configurazione 2</p>
                                </div>

                                <div class="product-gallery-card">
                                    <img src="" alt="">
                                    <p>Configurazione 3</p>
                                </div>

                                </div>

                            </div>
                        </div>

                    </section>

                    <!-- CARATTERISTICHE -->
                    <section id="caratteristiche" class="section js-section" data-anchor="caratteristiche">
                        <div class="section-inner">
                            <h2>Caratteristiche</h2>

                            <p>
                                Sistema progettato per garantire massima efficienza e adattabilità.
                            </p>

                            <div class="table-scroll">
                                <div class="fake-table" style="grid-template-columns: 220px repeat(6, 180px);">
                                
                                <div class="cell corner">Modello</div>
                                <div class="cell head">Diametro</div>
                                <div class="cell head">Lunghezza</div>
                                <div class="cell head">Portata</div>
                                <div class="cell head">Temperatura</div>
                                <div class="cell head">Pressione</div>
                                <div class="cell head">Note</div>

                                <div class="cell first-col">ARMTEL 01</div>
                                <div class="cell">100 mm</div>
                                <div class="cell">2 m</div>
                                <div class="cell">1200 m³/h</div>
                                <div class="cell">150°C</div>
                                <div class="cell">Standard</div>
                                <div class="cell">Base</div>

                                <div class="cell first-col">ARMTEL 02</div>
                                <div class="cell">125 mm</div>
                                <div class="cell">3 m</div>
                                <div class="cell">1400 m³/h</div>
                                <div class="cell">180°C</div>
                                <div class="cell">Alta</div>
                                <div class="cell">Plus</div>

                                </div>
                            </div>
                        </div>

                    </section>

                    <!-- DIMENSIONI -->
                    <section id="dimensioni" class="section js-section" data-anchor="dimensioni">
                        <div class="section-inner">
                            <h2>Dimensioni</h2>

                            <div class="product-dimensions__grid">
                                <img src="" alt="">
                                <img src="" alt="">
                                <img src="" alt="">
                                <img src="" alt="">
                            </div>

                            <div class="table-scroll">
                                <div class="fake-table" style="grid-template-columns: 220px repeat(10, 160px);">

                                <div class="cell corner">Modello</div>
                                <div class="cell head">A</div>
                                <div class="cell head">B</div>
                                <div class="cell head">C</div>
                                <div class="cell head">D</div>
                                <div class="cell head">E</div>
                                <div class="cell head">F</div>
                                <div class="cell head">G</div>
                                <div class="cell head">H</div>
                                <div class="cell head">I</div>
                                <div class="cell head">L</div>

                                <div class="cell first-col">ARMTEL 01</div>
                                <div class="cell">100</div>
                                <div class="cell">220</div>
                                <div class="cell">340</div>
                                <div class="cell">410</div>
                                <div class="cell">560</div>
                                <div class="cell">670</div>
                                <div class="cell">720</div>
                                <div class="cell">810</div>
                                <div class="cell">900</div>
                                <div class="cell">1000</div>

                                <div class="cell first-col">ARMTEL 02</div>
                                <div class="cell">120</div>
                                <div class="cell">240</div>
                                <div class="cell">360</div>
                                <div class="cell">430</div>
                                <div class="cell">580</div>
                                <div class="cell">690</div>
                                <div class="cell">740</div>
                                <div class="cell">830</div>
                                <div class="cell">920</div>
                                <div class="cell">1020</div>

                                </div>
                            </div>
                        </div>

                    </section>

                    <!-- DETTAGLI -->
                    <section id="dettagli" class="section js-section" data-anchor="dettagli">
                        <div class="section-inner">
                            <h2>Dettagli</h2>

                            <div class="product-details-slider">

                                <div class="product-details-slide">
                                <img src="" alt="">
                                <div>
                                    <h3>Dettaglio 1</h3>
                                    <p>Descrizione componente</p>
                                </div>
                                </div>

                                <div class="product-details-slide">
                                <img src="" alt="">
                                <div>
                                    <h3>Dettaglio 2</h3>
                                    <p>Descrizione componente</p>
                                </div>
                                </div>

                            </div>
                        </div>

                    </section>

                    <!-- ACCESSORI -->
                    <section id="accessori" class="section js-section" data-anchor="accessori">
                        <div class="section-inner">
                            <h2>Accessori</h2>

                            <table class="product-accessories-table">
                                <thead>
                                <tr>
                                    <th>Codice</th>
                                    <th>Immagine</th>
                                    <th>Nome</th>
                                    <th>Descrizione</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>0001</td>
                                    <td><img src="" alt=""></td>
                                    <td>Accessorio 1</td>
                                    <td>Descrizione accessorio</td>
                                </tr>
                                <tr>
                                    <td>0002</td>
                                    <td><img src="" alt=""></td>
                                    <td>Accessorio 2</td>
                                    <td>Descrizione accessorio</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </section>

                    <!-- CORRELATI -->
                    <section id="correlati" class="section js-section" data-anchor="correlati">
                        <div class="section-inner">
                            <h2>Correlati</h2>

                            <div class="product-related-grid">

                                <div class="product-related-card">
                                <img src="" alt="">
                                <h3>Prodotto correlato 1</h3>
                                </div>

                                <div class="product-related-card">
                                <img src="" alt="">
                                <h3>Prodotto correlato 2</h3>
                                </div>

                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </section>

    </main>
    
    <?php
        endwhile;
    }
get_footer('no-prefooter');
?>

<script>
      gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

      const header = document.querySelector(".js-page-header");
      const navWrap = document.querySelector(".js-anchor-nav-wrap");
      const navLinks = gsap.utils.toArray(".anchor-link");
      const sections = gsap.utils.toArray(".js-section");

      let currentActiveId = null;

      function getHeaderHeight() {
        return header ? header.offsetHeight : 0;
      }

      function getActivationY() {
        return window.scrollY + getHeaderHeight() + 12;
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

        gsap.to(window, {
          duration: 0.8,
          ease: "power2.out",
          scrollTo: {
            y: target,
            offsetY: getHeaderHeight() + 8,
            autoKill: true,
          },
          onUpdate: updateActiveSection,
          onComplete: updateActiveSection,
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

        if (hash && document.querySelector(hash)) {
          gsap.set(window, {
            scrollTo: {
              y: hash,
              offsetY: getHeaderHeight() + 8,
            },
          });
        }

        updateActiveSection();
        ScrollTrigger.refresh();
      });

      window.addEventListener("resize", () => {
        updateActiveSection();
      });
    </script>