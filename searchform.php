<div class="search-container-inner sp-pl-0 sp-md-pl-4 d-flex rounded overflow-hidden">
    <div class="search-title d-flex sp-gap-3 sp-md-pr-7 sp-pr-0 align-items-center text-white p-small">
        <i class="icon-filcar-icon-arrow-zoom"></i>
        <span class="d-none d-md-block">Cerca qualcosa</span>
    </div>
    <form action="<?php echo home_url(); ?>" method="get" id="searchform">
        <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
        <span class="search-submit p-small cursor-pointer"><i class='icon-filcar-icon-chevron-forward'></i></span>
    </form>
</div>