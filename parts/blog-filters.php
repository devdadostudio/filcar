<?php
$categories = get_categories([
    'taxonomy'   => 'category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);

$tags = get_terms([
    'taxonomy'   => 'post_tag',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);
?>

<div class="filters-bar filters-bar row">
    <div class="filters-bar__dropdowns col-12 col-lg-9 sp-px-3 sp-lg-px-0 sp-gap-4 sp-lg-gap-0">
        <div class="filter-select-wrap col-lg-4 offset-lg-1 sp-py-3 sp-lg-py-3 sp-uxl-py-4">
            <label class="filter-select-label text-white">Categoria</label>
            <select id="filter-blog-category" class="filter-select p-small" name="category">
                <option value="">Seleziona una categoria</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo esc_attr($category->slug); ?>">
                        <?php echo esc_html($category->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="filter-select-wrap col-lg-4 offset-lg-1 sp-py-3 sp-lg-py-3 sp-uxl-py-4">
            <label class="filter-select-label text-white">Tag</label>
            <select id="filter-blog-tag" class="filter-select p-small" name="tag">
                <option value="">Seleziona una parola chiave</option>
                <?php foreach ($tags as $tag) : ?>
                    <option value="<?php echo esc_attr($tag->slug); ?>">
                        <?php echo esc_html($tag->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="filter-search-wrap col-12 col-lg-3 sp-px-3 sp-lg-px-4 sp-py-4 sp-lg-py-0">
        <input
            type="text"
            id="filter-blog-search"
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
