<?php
get_header();

$term = get_queried_object();

if (!$term || is_wp_error($term) || !($term instanceof WP_Term)) {
    get_footer();
    return;
}

$term_key = $term->taxonomy . '_' . $term->term_id;
$parent_term = !empty($term->parent) ? get_term($term->parent, $term->taxonomy) : null;
$anchor_items = [
    [
        'url' => '#prodotti',
        'label' => __('Prodotti', 'filcar'),
    ],
    [
        'url' => '#caratteristiche',
        'label' => __('Caratteristiche e funzionamento', 'filcar'),
    ],
    [
        'url' => '#criteri-di-scelta',
        'label' => __('Criteri di scelta', 'filcar'),
    ],
    [
        'url' => '#manutenzione-sicurezza',
        'label' => __('Manutenzione e sicurezza', 'filcar'),
    ],
    [
        'url' => '#applicazioni',
        'label' => __('Applicazioni', 'filcar'),
    ],
    [
        'url' => '#faq',
        'label' => __('FAQ', 'filcar'),
    ],
];

$hero_image = function_exists('get_field') ? get_field('img_cat', $term_key) : null;
$hero_image_id = is_array($hero_image) && !empty($hero_image['ID']) ? (int) $hero_image['ID'] : 0;
$hero_image_alt = is_array($hero_image) && !empty($hero_image['alt']) ? $hero_image['alt'] : $term->name;
?>

<main id="main-content-category" class="bg-grey-200">
    <section class="position-relative section-hero-product section-hero-cat-prod-second d-flex align-items-center">
        <?php
        get_template_part('parts/breadcrumbs', null, [
            'variant' => 'light',
            'layout' => 'overlay',
            'class' => 'product-hero__breadcrumb category-second-hero__breadcrumb',
            'mobile_bg' => true,
        ]);
        ?>

        <div class="container-fluid-left-llg position-relative text-container category-second-hero__inner">
            <div class="row align-items-center">
                <div class="col-12 col-lg-4 order-2 order-lg-1">
                    <div class="product-hero__content category-second-hero__content text-grey-500">
                        <?php if ($parent_term && !is_wp_error($parent_term)) : ?>
                            <div class="product-3 fw-normal text-uppercase sp-mb-3">
                                <?php echo esc_html($parent_term->name); ?>
                            </div>
                        <?php endif; ?>
                        <h1 class="h1 extralight sp-mb-3 sp-sxl-mb-4 sp-uxl-mb-5">
                            <?php echo esc_html($term->name); ?>
                        </h1>
                        <?php if (!empty($term->description)) : ?>
                            <div class="p-big regular">
                                <?php echo wp_kses_post(wpautop($term->description)); ?>
                            </div>
                        <?php endif; ?>
                        <div class="cta-content">
                            <a href="#prodotti" class="btn btn-outline-primary">Prodotti <i class="icon icon-filcar-icon-arrow-downr"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7 offset-lg-1 order-1 order-lg-2 sp-mb-8 sp-lg-mb-0 category-second-hero__visual-col">
                    <div class="category-second-hero__visual">
                        <figure class="category-second-hero__image respimg sp-mb-0">
                            <?php
                            if ($hero_image_id) {
                                echo wp_get_attachment_image($hero_image_id, 'full', false, [
                                    'alt' => esc_attr($hero_image_alt),
                                ]);
                            } else {
                                echo '<img src="https://placehold.co/900x900" alt="' . esc_attr($term->name) . '">';
                            }
                            ?>
                        </figure>

                        <?php
                        get_template_part('parts/category/anchor-nav', null, [
                            'items' => $anchor_items,
                            'classes' => 'category-anchor-nav--hero d-none d-lg-flex',
                            'aria_label' => __('Categorie prodotto', 'filcar'),
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="prodotti" class="category-products-placeholder js-category-anchor-panel" data-anchor-target="#prodotti">
        <div class="container-fluid">
            <h2 class="h1 fw-normal text-grey-500">Prodotti</h2>
        </div>
    </section>

    <section class="category-anchor-sections js-category-anchor-sections">
        <div class="container-fluid">
            <div class="row">
                <aside class="col-12 col-lg-4 category-anchor-sections__aside">
                    <div class="category-anchor-sections__aside-inner">
                        <?php
                        get_template_part('parts/category/anchor-nav', null, [
                            'items' => $anchor_items,
                            'classes' => 'category-anchor-nav--content',
                            'aria_label' => __('Navigazione contenuti categoria', 'filcar'),
                        ]);
                        ?>

                        <?php if ($hero_image_id) : ?>
                            <figure class="category-anchor-sections__image respimg sp-mb-0 d-none d-lg-flex">
                                <?php
                                echo wp_get_attachment_image($hero_image_id, 'full', false, [
                                    'alt' => esc_attr($hero_image_alt),
                                ]);
                                ?>
                            </figure>
                        <?php endif; ?>
                    </div>
                </aside>

                <div class="col-12 col-lg-6 offset-lg-1 category-anchor-sections__content">
                    <article id="caratteristiche" class="category-anchor-panel js-category-anchor-panel" data-anchor-target="#caratteristiche">
                        <div class="category-anchor-panel__number number-3">02</div>
                        <h2 class="category-anchor-panel__title h2 light">Caratteristiche e funzionamento degli arrotolatori gas di scarico</h2>
                        <div class="category-anchor-panel__body p-big">
                            <p>L’arrotolatore gas di scarico a riavvolgimento meccanico è costituito da un tamburo su cui viene avvolto il tubo di aspirazione, azionato da un sistema a molla che permette il recupero automatico del tubo dopo l’utilizzo. Questo sistema garantisce semplicità costruttiva, affidabilità nel tempo e ridotta manutenzione.</p>
                            <p>Gli arrotolatori per officina sono progettati per essere installati a parete o a soffitto, consentendo una gestione ergonomica delle postazioni di aspirazione. Il meccanismo di arresto consente di bloccare il tubo alla lunghezza desiderata, migliorando l’operatività e la sicurezza durante l’uso.</p>
                            <p>Grazie alla struttura metallica e ai componenti dimensionati per cicli intensivi, questi arrotolatori risultano adatti a contesti professionali dove è richiesta continuità di servizio e resistenza a sollecitazioni meccaniche.</p>
                        </div>
                    </article>

                    <article id="criteri-di-scelta" class="category-anchor-panel js-category-anchor-panel" data-anchor-target="#criteri-di-scelta">
                        <div class="category-anchor-panel__number">03</div>
                        <h2 class="category-anchor-panel__title h1 fw-normal">Criteri di scelta di un arrotolatore per aspirazione gas di scarico</h2>
                        <div class="category-anchor-panel__body p-big fw-normal">
                            <p>La scelta di un arrotolatore deve tenere conto di diversi fattori tecnici legati all’impianto di aspirazione e all’ambiente operativo. Tra i principali parametri rientrano la lunghezza e il diametro del tubo, la portata d’aria richiesta e lo spazio disponibile per l’installazione.</p>
                            <p>Un arrotolatore del tubo di aspirazione gas di scarico meccanico deve essere selezionato in funzione del tipo di veicoli serviti, della frequenza di utilizzo e del layout dell’officina. In postazioni con elevato turnover di veicoli, è preferibile optare per soluzioni robuste con sistemi di blocco affidabili e tamburi dimensionati per cicli frequenti.</p>
                            <p>La compatibilità con i sistemi di canalizzazione esistenti e con eventuali accessori di aspirazione rappresenta un ulteriore elemento da considerare per garantire efficienza e continuità operativa.</p>
                        </div>
                    </article>

                    <article id="manutenzione-sicurezza" class="category-anchor-panel js-category-anchor-panel" data-anchor-target="#manutenzione-sicurezza">
                        <div class="category-anchor-panel__number">04</div>
                        <h2 class="category-anchor-panel__title h1 fw-normal">Manutenzione e sicurezza</h2>
                        <div class="category-anchor-panel__body p-big fw-normal">
                            <p>Una corretta manutenzione aiuta a preservare nel tempo la funzionalità dell’arrotolatore e la sicurezza dell’operatore. È consigliabile verificare periodicamente lo stato del tubo, il corretto riavvolgimento e l’efficienza del sistema di arresto.</p>
                            <p>La manutenzione programmata riduce il rischio di usura anomala e contribuisce a mantenere costante la qualità dell’aspirazione nelle aree di lavoro.</p>
                        </div>
                    </article>

                    <article id="applicazioni" class="category-anchor-panel js-category-anchor-panel" data-anchor-target="#applicazioni">
                        <div class="category-anchor-panel__number">05</div>
                        <h2 class="category-anchor-panel__title h1 fw-normal">Applicazioni</h2>
                        <div class="category-anchor-panel__body p-big fw-normal">
                            <p>Gli arrotolatori trovano applicazione in officine auto, centri revisione, concessionarie, reparti manutenzione e ambienti industriali dove è necessario gestire l’aspirazione dei gas di scarico in modo ordinato e sicuro.</p>
                        </div>
                    </article>

                    <article id="faq" class="category-anchor-panel category-anchor-panel--faq js-category-anchor-panel" data-anchor-target="#faq">
                        <div class="category-anchor-panel__number">06</div>
                        <h2 class="category-anchor-panel__title h1 fw-normal">FAQ</h2>
                        <div class="category-anchor-faq accordion" id="categoryAnchorFaq">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="categoryAnchorFaqHeadingOne">
                                    <button class="accordion-button collapsed h5 fw-normal" type="button" data-bs-toggle="collapse" data-bs-target="#categoryAnchorFaqOne" aria-expanded="false" aria-controls="categoryAnchorFaqOne">
                                        A cosa serve un arrotolatore per aspirazione gas di scarico?
                                    </button>
                                </h3>
                                <div id="categoryAnchorFaqOne" class="accordion-collapse collapse" aria-labelledby="categoryAnchorFaqHeadingOne" data-bs-parent="#categoryAnchorFaq">
                                    <div class="accordion-body p-big fw-normal">
                                        Serve a gestire il tubo di aspirazione in modo ordinato e sicuro, permettendo di aspirare i fumi dei veicoli direttamente alla fonte e riavvolgere il tubo automaticamente dopo l’utilizzo.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (!('IntersectionObserver' in window)) return;

    const links = Array.from(document.querySelectorAll('.category-anchor-nav__link[href^="#"]'));
    const panels = Array.from(document.querySelectorAll('.js-category-anchor-panel'));

    if (!links.length || !panels.length) return;

    const setActive = function (target) {
        links.forEach(function (link) {
            link.classList.toggle('is-active', link.getAttribute('href') === target);
        });
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                setActive(entry.target.dataset.anchorTarget || ('#' + entry.target.id));
            }
        });
    }, {
        rootMargin: '-35% 0px -50% 0px',
        threshold: 0.01
    });

    panels.forEach(function (panel) {
        observer.observe(panel);
    });
});
</script>

<?php
get_footer();
