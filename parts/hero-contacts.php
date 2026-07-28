<?php
$block_title   = get_field('title_contact', 'option');
$block_subtitle = get_field('txt_subtitle', 'option');
$block_text    = get_field('txt_contact', 'option');
$form          = get_field('form_contact', 'option');
$img           = get_field('img_contact', 'option');
$img_mob       = get_field('img_contact_mob', 'option');

$img_url     = filcar_get_image_url($img);
$img_mob_url = filcar_get_image_url($img_mob);

if (!$img_mob_url) {
	$img_mob_url = $img_url;
}

$contacts = get_field('contacts');
$img_section = get_field('img');
?>
<section class="h-100vh-header section-hero-contacts">
    <div class="grid align-items-center sp-gap-0 h-100vh-header">
        <div class="g-col-lg-6 g-col-12 h-100">
            <div class="contact-form-block__media position-relative h-100 rounded-0">
                <?php
                    get_template_part('parts/breadcrumbs', null, [
                        'variant' => 'dark',
                        'layout' => 'inline',
                        'class' => 'position-absolute z-3 sp-lg-py-4',
                        'inner_class' => 'p-small',
                        'col_class' => 'col-12',
                        'mobile_bg' => true,
                        'items' => [
                            ['label' => __('Home', 'filcar'), 'url' => home_url('/')],
                            ['label' => __('Contatti', 'filcar')],
                        ],
                    ]);
                ?>
                <figure class="contact-form-block__figure mb-0 h-100 position-absolute w-100 br-0 rounded-0">
                    <?php if ($img_url) : ?>
                        <img class="contact-form-block__img d-none d-md-block" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($block_title ?: 'Contatti'); ?>">
                    <?php endif; ?>

                    <?php if ($img_mob_url) : ?>
                        <img class="contact-form-block__img d-block d-md-none" src="<?php echo esc_url($img_mob_url); ?>" alt="<?php echo esc_attr($block_title ?: 'Contatti'); ?>">
                    <?php endif; ?>
                    <svg id="Layer_2" class="filcar-simbol" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 413.72 482.99">
                        <defs>
                            <style>
                            .cls-1 {
                                fill: #1d1d1f;
                            }

                            .cls-2 {
                                opacity: .1;
                            }
                            </style>
                        </defs>
                        <g id="Layer_1-2" data-name="Layer 1">
                            <g class="cls-2">
                            <path class="cls-1" d="M393.28,142.75c-3.54-54.05-85.69-78.31-117.01-28.91,0,0-13.78,20.35-20.6,30.4-1.5,2.21-4.89,1.7-5.68-.85l-2.19-6.98-11.76-42.81h14.17l-3.78.03c4.18,0,7.57,3.39,7.57,7.57,10.12-14.34-1.42-25.51-12.15-25.51h-9.01c-2.8-8.39-12-15.54-19.36-15.54h-23.99l-25.75,83.37c-.79,2.56-4.19,3.06-5.68.84l-20.6-30.51c-31.32-49.4-113.47-25.14-117.01,28.91L0,424.02l54.95-61.27,7.75-125.96c.24-3.95,6.05-4,6.35-.05l7.89,102.01,30.43-30.93-11.57-86.02c-.52-3.87,5.04-5.1,6.2-1.37l21.2,68.37,17.25-21.17c1.43-1.76,4.19-1.5,5.27.5l25.18,46.54c1.45,2.68,1.24,5.94-.52,8.42l-60.24,84.34c5.63,6.92,11.62,13.55,17.89,19.9l28.79-52.24c1.66-3.01,6.24-1.13,5.31,2.17l-18.25,64.91c8.06,6.98,16.53,13.49,25.37,19.51l15.85-65.7c.82-3.39,5.83-2.69,5.69.79l-3.06,76.46c6.07,3.47,12.42,6.74,18.77,9.75,6.35-3.01,12.7-6.28,18.77-9.75l-3.06-76.46c-.14-3.49,4.87-4.18,5.69-.79l15.85,65.7c8.84-6.02,17.31-12.53,25.37-19.51l-18.25-64.91c-.93-3.3,3.65-5.18,5.31-2.17l28.79,52.24c6.27-6.34,12.25-12.97,17.89-19.9l-60.21-84.29c-1.79-2.5-1.97-5.8-.48-8.49l25.85-46.59c1.09-1.97,3.83-2.21,5.25-.47l17.28,21.21,21.2-68.37c1.16-3.73,6.72-2.5,6.2,1.37l-11.57,86.02,30.42,30.93,7.89-102.01c.31-3.95,6.11-3.9,6.35.05l7.75,125.96,54.94,61.27-20.44-281.27Z"/>
                            <polygon class="cls-1" points="206.86 47.44 223.65 47.44 237.07 22.5 218.72 27.4 206.86 0 195 27.4 176.65 22.5 190.08 47.44 206.86 47.44"/>
                            </g>
                        </g>
                    </svg>
                </figure>
                <div class="contact-form-block__overlay sp-pl-0 sp-pr-4 sp-py-11 position-relative h-100">
                    <div class="container-fluid h-100">
                        <div class="d-flex flex-column justify-content-between h-100 sp-gap-5">
                            <?php if ($block_title) : ?>
                                <div class="d-flex justify-content-between align-items-start align-items-xl-end">
                                    <h1 class="h2 contact-form-block__overlay-title mb-0 fw-light">
                                        <?php echo $block_title; ?>
                                    </h1>
                                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 35.4997L35.4998 35.5M35.4998 1.50002L35.4998 35.5M35.4998 35.5L3.29682 3.36077" stroke="#17191B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                            <?php
                            endif;
                            if(!empty($contacts)):
                                $contacts_c = count($contacts);
                            ?>
                            <div class="contacts-list-container d-flex flex-column sp-lg-gap-8 sp-gap-3">
                                <?php
                                for($i = 0; $i < $contacts_c; $i++):
                                    $contact = $contacts[$i];
                                    $contact_title = $contact['title'];
                                    $contact_address = $contact['address'];
                                    $contact_email = $contact['email'];
                                    $contact_tel = $contact['tel'];
                                ?>
                                <div class="contact-item">
                                    <?php if ($contact_title) : ?>
                                        <div class="h7 sp-pb-3"><?php echo $contact_title; ?></div>
                                    <?php
                                    endif;
                                    if($contact_address || $contact_email || $contact_tel) :
                                    ?>
                                    <div class="d-flex flex-column sp-gap-2 contact-item-inner">
                                        <?php if ($contact_address) : ?>
                                        <div class="address-item d-flex sp-gap-2 sp-lg-gap-3 align-items-start">
                                            <div class="svg-container">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="20" viewBox="0 0 14 20" fill="none">
                                                    <path d="M7 9.5C6.33696 9.5 5.70107 9.23661 5.23223 8.76777C4.76339 8.29893 4.5 7.66304 4.5 7C4.5 6.33696 4.76339 5.70107 5.23223 5.23223C5.70107 4.76339 6.33696 4.5 7 4.5C7.66304 4.5 8.29893 4.76339 8.76777 5.23223C9.23661 5.70107 9.5 6.33696 9.5 7C9.5 7.3283 9.43534 7.65339 9.3097 7.95671C9.18406 8.26002 8.99991 8.53562 8.76777 8.76777C8.53562 8.99991 8.26002 9.18406 7.95671 9.3097C7.65339 9.43534 7.3283 9.5 7 9.5ZM7 0C5.14348 0 3.36301 0.737498 2.05025 2.05025C0.737498 3.36301 0 5.14348 0 7C0 12.25 7 20 7 20C7 20 14 12.25 14 7C14 5.14348 13.2625 3.36301 11.9497 2.05025C10.637 0.737498 8.85652 0 7 0Z" fill="#8E9195"/>
                                                </svg>
                                            </div>
                                            <span class="w-100 flex-shrink-1"><?php echo $contact_address; ?></span>
                                        </div>
                                        <?php
                                        endif;
                                        if(!empty($contact_email)) :
                                            $contact_email_c = count($contact_email);
                                        ?>
                                        <div class="email-item d-flex sp-gap-2 sp-lg-gap-3 align-items-start">
                                            <div class="svg-container">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none">
                                                    <path d="M20 3.53516V13.0002C20 13.7654 19.7077 14.5017 19.1827 15.0584C18.6578 15.6152 17.9399 15.9503 17.176 15.9952L17 16.0002H3C2.23479 16.0002 1.49849 15.7078 0.941739 15.1829C0.384993 14.6579 0.0498925 13.9401 0.00500011 13.1762L0 13.0002V3.53516L9.445 9.83216L9.561 9.89816C9.69771 9.96495 9.84785 9.99967 10 9.99967C10.1522 9.99967 10.3023 9.96495 10.439 9.89816L10.555 9.83216L20 3.53516Z" fill="#8E9195"/>
                                                    <path d="M17.0003 0C18.0803 0 19.0273 0.57 19.5553 1.427L10.0003 7.797L0.445312 1.427C0.696105 1.01982 1.0406 0.6785 1.45008 0.431489C1.85957 0.184479 2.32217 0.0389373 2.79931 0.00699997L3.00031 0H17.0003Z" fill="#8E9195"/>
                                                </svg>
                                            </div>
                                            <span class="w-100 flex-shrink-1">
                                                <?php for($j = 0; $j < $contact_email_c; $j++) : ?>
                                                    <?php if($j > 0) : ?> | <?php endif; ?><a href="mailto:<?php echo $contact_email[$j]['email']; ?>" class="text-grey-800 text-decoration-none"><?php echo $contact_email[$j]['email']; ?></a>
                                                <?php endfor; ?>
                                            </span>
                                        </div>
                                        <?php
                                        endif;
                                        if($contact_tel) :
                                        ?>
                                        <div class="tel-item d-flex sp-gap-2 sp-lg-gap-3 align-items-start">
                                            <div class="svg-container">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                    <path d="M18 13.42V16.956C18.0001 17.2092 17.9042 17.453 17.7316 17.6382C17.559 17.8234 17.3226 17.9363 17.07 17.954C16.6333 17.9847 16.2767 18 16 18C7.163 18 0 10.837 0 2C0 1.724 0.0153333 1.36733 0.046 0.93C0.0637224 0.677444 0.176581 0.441011 0.361804 0.268409C0.547026 0.0958068 0.790823 -0.000114433 1.044 2.56579e-07H4.58C4.70404 -0.000125334 4.8237 0.045859 4.91573 0.12902C5.00776 0.212182 5.0656 0.326583 5.078 0.45C5.10067 0.679334 5.122 0.863333 5.142 1.002C5.34072 2.38893 5.74799 3.73784 6.35 5.003C6.445 5.203 6.383 5.442 6.203 5.57L4.045 7.112C5.36471 10.1863 7.81472 12.6363 10.889 13.956L12.429 11.802C12.4917 11.7137 12.5835 11.6503 12.6883 11.6231C12.7932 11.5958 12.9042 11.6064 13.002 11.653C14.267 12.2539 15.6156 12.6601 17.002 12.858C17.1407 12.878 17.324 12.8993 17.552 12.922C17.6752 12.9346 17.7894 12.9926 17.8724 13.0846C17.9553 13.1766 18.0002 13.2961 18 13.42Z" fill="#8E9195"/>
                                                </svg>
                                            </div>
                                            <span class="w-100 flex-shrink-1"><a href="tel:<?php echo $contact_tel; ?>" class="text-grey-800 text-decoration-none"><?php echo $contact_tel; ?></a></span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endfor; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-lg-6 h-100 position-relative figure-container">
            <figure class="respimg w-100 h-100 position-absolute top-0 left-0 aspect-ratio-4x3">
                <img src="<?php echo wp_get_attachment_image_url($img_section['ID'], 'full'); ?>" alt="<?php echo get_the_title(); ?>">
            </figure>
        </div>
    </div>
</section>