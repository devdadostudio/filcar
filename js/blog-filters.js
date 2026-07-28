(function ($) {
    'use strict';

    const $grid       = $('#blog-posts-grid');
    const $pagination = $('#blog-posts-pagination');
    const $loader     = $('#blog-posts-loader');
    let debounceTimer;
    let currentPage = 1;

    function getFilters() {
        return {
            category: $('#filter-blog-category').val(),
            tag:      $('#filter-blog-tag').val(),
            search:   $('#filter-blog-search').val(),
        };
    }

    function fetchBlogPosts(page) {
        const filters = getFilters();
        currentPage = page;

        $loader.show();
        $grid.css('opacity', '0.4');

        $.ajax({
            url:    blogPostsAjax.ajaxurl,
            method: 'POST',
            data: {
                action:   'filter_blog_posts',
                nonce:    blogPostsAjax.nonce,
                paged:    page,
                posts_per_page: blogPostsAjax.posts_per_page || 3,
                category: filters.category,
                tag:      filters.tag,
                search:   filters.search,
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

    $(document).on('click', '#blog-posts-pagination .cs-page-prev, #blog-posts-pagination .cs-page-next', function (e) {
        e.preventDefault();
        e.stopPropagation();

        if ($(this).hasClass('is-disabled')) return;

        const page = parseInt($(this).data('page'));
        if (!page) return;

        fetchBlogPosts(page);
        $('html, body').animate({ scrollTop: $grid.offset().top - 100 }, 300);
    });

    $('#filter-blog-category, #filter-blog-tag').on('change', function () {
        fetchBlogPosts(1);
    });

    $('#filter-blog-search').on('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            fetchBlogPosts(1);
        }, 350);
    });

})(jQuery);
