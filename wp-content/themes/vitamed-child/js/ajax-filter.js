jQuery(document).ready(function ($) {
    function loadPosts(term_slug, paged = 1) {
        var loader = '<div class="loading text-center py-3">Завантаження...</div>';
        $('#main .posts-row').html(loader);

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_specialty_posts',
                term_slug: term_slug,
                paged: paged,
                nonce: ajax_object.nonce
            },
            success: function (response) {
                if (response.success) {
                    $('#main .posts-row').html(response.data.posts_html);
                    $('.pagination-wrapper').html(response.data.pagination);
                    $('.found-posts').remove();
                    if (response.data.found_posts > 0) {
                        $('.page-header').after('<p class="found-posts text-muted mb-3">Знайдено лікарів: ' + response.data.found_posts + '</p>');
                    }
                } else {
                    $('#main .posts-row').html('<div class="row"><div class="col-12"><p class="text-center">Немає постів за вибраним фільтром.</p></div></div>');
                    $('.pagination-wrapper').html('');
                }
            },
            error: function () {
                $('#main .posts-row').html('<div class="row"><div class="col-12"><p class="text-center text-danger">Помилка завантаження. Спробуйте ще раз.</p></div></div>');
                $('.pagination-wrapper').html('');
            }
        });
    }

    $('#specialty-filter').on('change', function () {
        var selectedTerm = $(this).val();
        loadPosts(selectedTerm, 1);
    });

    $(document).on('click', '.pagination-wrapper a.page-numbers', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var pagedMatch = url.match(/paged=(\d+)/);
        var paged = pagedMatch ? pagedMatch[1] : 1;
        var term_slug = $('#specialty-filter').val();
        loadPosts(term_slug, paged);
        $('html, body').animate({
            scrollTop: $('#specialty-filter').offset().top - 20
        }, 600);
    });


});

