(function ($) {
    'use strict';

    const $grid       = $('#case-studies-grid');
    const $pagination = $('#case-studies-pagination');
    const $loader     = $('#case-studies-loader');
    let debounceTimer;
    let isFiltering   = false; // false = navigazione WP normale, true = siamo in modalità AJAX

    function getFilters() {
        return {
            settore: $('#filter-settore').val(),
            tag:     $('#filter-tag').val(),
            search:  $('#filter-search').val(),
        };
    }

    function hasActiveFilters() {
        const f = getFilters();
        return f.settore !== '' || f.tag !== '' || f.search !== '';
    }

    function fetchCaseStudies(page) {
        const filters = getFilters();

        $loader.show();
        $grid.css('opacity', '0.4');

        $.ajax({
            url:    caseStudiesAjax.ajaxurl,
            method: 'POST',
            data: {
                action:  'filter_case_studies',
                nonce:   caseStudiesAjax.nonce,
                paged:   page,
                settore: filters.settore,
                tag:     filters.tag,
                search:  filters.search,
            },
            success(response) {
                if (!response.success) return;

                $grid.html(response.data.html);
                $pagination.html(response.data.pagination
                    ? '<div class="col-12">' + response.data.pagination + '</div>'
                    : ''
                );

                // Intercetta i click sulla paginazione AJAX
                bindPaginationClicks();
            },
            complete() {
                $loader.hide();
                $grid.css('opacity', '1');
            },
        });
    }

    function bindPaginationClicks() {
        // Rimuove listener precedenti per non duplicarli
        $pagination.off('click', 'a').on('click', 'a', function (e) {
            if (!isFiltering) return; // lascia funzionare WP normalmente se no filtri

            e.preventDefault();

            // Legge il numero di pagina dall'href (es. ?paged=2 o /page/2/)
            const href  = $(this).attr('href');
            const match = href.match(/[?&/]paged?[=/](\d+)/i);
            const page  = match ? parseInt(match[1]) : 1;

            fetchCaseStudies(page);
            $('html, body').animate({ scrollTop: $grid.offset().top - 100 }, 300);
        });
    }

    // Cambio dropdown → reset a pagina 1
    $('#filter-settore, #filter-tag').on('change', function () {
        isFiltering = hasActiveFilters();
        if (isFiltering) {
            fetchCaseStudies(1);
        } else {
            // Nessun filtro attivo: ricarica la pagina pulita
            window.location.href = window.location.pathname;
        }
    });

    // Ricerca con debounce 350ms
    $('#filter-search').on('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            isFiltering = hasActiveFilters();
            if (isFiltering) {
                fetchCaseStudies(1);
            } else {
                window.location.href = window.location.pathname;
            }
        }, 350);
    });

    // Init: intercetta paginazione solo se siamo già con filtri attivi al caricamento
    if (hasActiveFilters()) {
        isFiltering = true;
        bindPaginationClicks();
    }

})(jQuery);