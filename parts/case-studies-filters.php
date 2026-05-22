<?php
$all_case_studies = get_posts([
    'post_type'      => 'caso-studio',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'fields'         => 'ids',
]);

$used_sector_ids = [];
foreach ($all_case_studies as $cs_id) {
    $sectors = get_field('sectors', $cs_id);
    if (!$sectors) continue;
    if (!is_array($sectors)) $sectors = [$sectors];
    foreach ($sectors as $sector) {
        $used_sector_ids[$sector->ID] = $sector;
    }
}
usort($used_sector_ids, fn($a, $b) => strcmp($a->post_title, $b->post_title));

$tags = get_terms([
    'taxonomy'   => 'tag-caso-studio',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);
?>

<div class="filters-bar filters-bar row">
    <div class="filters-bar__dropdowns col-12 col-lg-9 sp-px-3 sp-lg-px-0 sp-gap-4 sp-lg-gap-0">
        <div class="filter-select-wrap col-lg-4 offset-lg-1 sp-py-3 sp-lg-py-3 sp-uxl-py-4">
            <label class="filter-select-label text-white">Settore</label>
            <select id="filter-settore" class="filter-select p-small" name="settore">
                <option value="">Seleziona un settore</option>
                <?php foreach ($used_sector_ids as $sector) : ?>
                    <option value="<?= esc_attr($sector->ID) ?>">
                        <?= esc_html($sector->post_title) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="filter-select-wrap col-lg-4 offset-lg-1 sp-py-3 sp-lg-py-3 sp-uxl-py-4">
            <label class="filter-select-label text-white">Tag</label>
            <select id="filter-tag" class="filter-select p-small" name="tag">
                <option value="">Seleziona una parola chiave</option>
                <?php foreach ($tags as $tag) : ?>
                    <option value="<?= esc_attr($tag->slug) ?>">
                        <?= esc_html($tag->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

    </div>

    <div class="filter-search-wrap col-12 col-lg-3 sp-px-3 sp-lg-px-4 sp-py-4 sp-lg-py-0">
        <input
            type="text"
            id="filter-search"
            class="filter-search p-small"
            placeholder="Cerca qualcosa"
            autocomplete="off"
        />
        <button class="filter-search-btn" aria-label="Cerca">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
        </button>
    </div>
</div>