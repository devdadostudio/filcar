(function ($) {
    'use strict';

    const $grid       = $('#case-studies-grid');
    const $pagination = $('#case-studies-pagination');
    const $loader     = $('#case-studies-loader');
    let debounceTimer;
    let currentPage = 1;

    function getFilters() {
        return {
            settore: $('#filter-settore').val(),
            tag:     $('#filter-tag').val(),
            search:  $('#filter-search').val(),
        };
    }

    function fetchCaseStudies(page) {
        const filters = getFilters();
        currentPage = page;

        $loader.show();
        $grid.css('opacity', '0.4');

        $.ajax({
            url:    caseStudiesAjax.ajaxurl,
            method: 'POST',
            data: {
                action:  'filter_case_studies',
                nonce:   caseStudiesAjax.nonce,
                paged:   page,
                posts_per_page: caseStudiesAjax.posts_per_page || 3,
                settore: filters.settore,
                tag:     filters.tag,
                search:  filters.search,
            },
            success(response) {
                if (!response.success) return;

                $grid.html(response.data.html);

                $pagination.html(
                    response.data.pagination
                        ? '<div class="col-12">' + response.data.pagination + '</div>'
                        : ''
                );
            },
            complete() {
                $loader.hide();
                $grid.css('opacity', '1');
            },
        });
    }

    // Paginazione — delegato su document così funziona sempre,
    // anche sull'HTML renderizzato inizialmente dal PHP
    $(document).on('click', '.cs-page-prev, .cs-page-next', function (e) {
        e.preventDefault();
        e.stopPropagation();

        if ($(this).hasClass('is-disabled')) return;

        const page = parseInt($(this).data('page'));
        if (!page) return;

        fetchCaseStudies(page);
        $('html, body').animate({ scrollTop: $grid.offset().top - 100 }, 300);
    });

    // Cambio dropdown
    $('#filter-settore, #filter-tag').on('change', function () {
        fetchCaseStudies(1);
    });

    // Ricerca con debounce 350ms
    $('#filter-search').on('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            fetchCaseStudies(1);
        }, 350);
    });

})(jQuery);
