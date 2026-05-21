<section class="videos-block bg-primary">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-white">
                <div class="section-inner">
                    <div class="subtitle-header sp-mb-5 sp-gap-1 subtitle-after-white">
                        <h2 class="h3 light">Video</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row sp-row-gap-8 sp-pb-5 sp-lg-pb-7">
            <?php
            $videos = get_field('videos');
            $videos_c = count($videos);

            for ($i = 0; $i < $videos_c; $i++) {
                $video      = $videos[$i];
                $video_url  = $video['video']; // oembed field → contiene l'URL originale o l'iframe
                $title      = $video['title_video'];
                $date_video = $video['data_video'];

                // Se ACF oembed restituisce già un <iframe>, estraiamo il src
                $raw_url = $video_url;
                if (strpos($video_url, '<iframe') !== false) {
                    preg_match('/src=["\']([^"\']+)["\']/', $video_url, $src_match);
                    $raw_url = $src_match[1] ?? $video_url;
                }

                $info      = get_video_info($raw_url);
                $thumbnail = get_video_thumbnail($info);
                $embed_url = get_embed_url($info);
            ?>
                <div class="col-12 col-lg-3">
                    <!-- Copertina cliccabile -->
                    <figure
                        class="video-figure aspect-ratio-16x9 rounded overflow-hidden video-thumb-trigger"
                        data-embed="<?php echo esc_attr($embed_url); ?>"
                        style="cursor:pointer; position:relative;"
                    >
                        <?php if ($thumbnail): ?>
                            <img
                                src="<?php echo esc_url($thumbnail); ?>"
                                alt="<?php echo esc_attr($title); ?>"
                                style="width:100%; height:100%; object-fit:cover; display:block;"
                                loading="lazy"
                            />
                        <?php endif; ?>
                        <!-- Icona play -->
                        <div class="video-play-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80" width="64" height="64">
                                <circle cx="40" cy="40" r="38" fill="#f81c2f"/>
                                <polygon points="32,24 60,40 32,56" fill="white"/>
                            </svg>
                        </div>
                    </figure>

                    <div class="text-white sp-mb-3 catalog-title"><?php echo $title; ?></div>
                    <div class="text-white">
                        <div class="catalog-date p-smaller">
                            <?php echo $date_video; ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>

<!-- Modale video -->
<div id="video-modal" role="dialog" aria-modal="true" aria-label="Video player" style="display:none;">
    <div id="video-modal-backdrop"></div>
    <div id="video-modal-inner">
        <button id="video-modal-close" aria-label="Chiudi video">&times;</button>
        <div id="video-modal-frame-wrap">
            <iframe
                id="video-modal-iframe"
                src=""
                frameborder="0"
                allow="autoplay; fullscreen; picture-in-picture"
                allowfullscreen
            ></iframe>
        </div>
    </div>
</div>
<script>
(function () {
    const modal   = document.getElementById('video-modal');
    const iframe  = document.getElementById('video-modal-iframe');
    const backdrop = document.getElementById('video-modal-backdrop');
    const closeBtn = document.getElementById('video-modal-close');

    function openModal(embedUrl) {
        iframe.src = embedUrl;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.style.display = 'none';
        iframe.src = '';                      // ferma il video
        document.body.style.overflow = '';
    }

    // Clic sulle thumbnail
    document.querySelectorAll('.video-thumb-trigger').forEach(function (el) {
        el.addEventListener('click', function () {
            var url = el.getAttribute('data-embed');
            if (url) openModal(url);
        });
    });

    // Chiudi con backdrop o pulsante ×
    backdrop.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);

    // Chiudi con ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.style.display !== 'none') closeModal();
    });
})();
</script>