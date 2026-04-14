<?php get_header(); ?>
<?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            echo the_content();
        }
    }
?>
<script>
    function resizeBlocksSplitted() {
        let splittedRows = document.querySelectorAll('.splitted-row-h');
        splittedRows.forEach(splittedRow => {
            let splittedColText = splittedRow.querySelector('.splitted-col-text-inner');
            let splittedColImage = splittedRow.querySelector('.splitted-col-image');

            if (!splittedColText || !splittedColImage) return;

            let splittedColTextHeight = splittedColText.offsetHeight;
            splittedColImage.style.height = 'calc(' + splittedColTextHeight + 'px' + ' + var(--padding-white-space))';
        });
    }

    window.addEventListener('load', () => {
        resizeBlocksSplitted();
    });

    window.addEventListener('resize', () => {
        resizeBlocksSplitted();
    });
</script>
<!-- Text Section -->
<?php get_footer(); ?>