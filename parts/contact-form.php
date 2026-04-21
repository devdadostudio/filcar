<?php
$block_title   = get_field('title_contact', 'option');
$block_subtitle = get_field('txt_subtitle', 'option');
$block_text    = get_field('txt_contact', 'option');
$form          = get_field('form_contact', 'option');
$img           = get_field('img_contact', 'option');
$img_mob       = get_field('img_contact_mob', 'option');
$phone_contact = get_field('phone_contact', 'option');
$email_contact = get_field('email_contact', 'option');

function filcar_get_image_url($image_field) {
	if (empty($image_field)) {
		return '';
	}

	if (is_string($image_field) && filter_var($image_field, FILTER_VALIDATE_URL)) {
		return $image_field;
	}

	if (is_array($image_field) && !empty($image_field['url'])) {
		return $image_field['url'];
	}

	if (is_numeric($image_field)) {
		$url = wp_get_attachment_image_url((int) $image_field, 'full');
		return $url ? $url : '';
	}

	return '';
}

$img_url     = filcar_get_image_url($img);
$img_mob_url = filcar_get_image_url($img_mob);

if (!$img_mob_url) {
	$img_mob_url = $img_url;
}

$page_title = get_the_title();
?>

<section id="contactForm" class="contact-form-block position-relative overflow-hidden sp-pt-6 sp-pb-0 sp-md-pt-13 sp-llg-pt-13 sp-llg-pb-8 bg-grey">
	<div class="container-fluid">
		<div class="row g-3 g-lg-4 align-items-stretch sp-px-2">

			<div class="col-12 col-lg-6 sp-mb-4">
				<div class="contact-form-block__media position-relative h-100">
					<figure class="contact-form-block__figure mb-0 h-100 position-relative">

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
						<div class="contact-form-block__overlay">
							<?php if ($block_title) : ?>
                                <div class="d-flex justify-content-between align-items-start align-items-xl-end">
                                    <h2 class="contact-form-block__overlay-title mb-0">
                                        <?php echo $block_title; ?>
                                    </h2>
                                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 35.4997L35.4998 35.5M35.4998 1.50002L35.4998 35.5M35.4998 35.5L3.29682 3.36077" stroke="#17191B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
								
							<?php endif; ?>

							<?php if ($phone_contact || $email_contact) : ?>
								<div class="contact-form-block__overlay-contacts">
									<?php if ($phone_contact) : ?>
										<a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone_contact)); ?>" class="contact-form-block__contact-link">
											<span class="contact-form-block__contact-icon"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#e3e3e3"><path d="M0 0h24v24H0z" fill="none"/><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56-.35-.12-.74-.03-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/></svg></span>
											<span><?php echo esc_html($phone_contact); ?></span>
										</a>
									<?php endif; ?>

									<?php if ($email_contact) : ?>
										<a href="mailto:<?php echo esc_attr($email_contact); ?>" class="contact-form-block__contact-link">
											<span class="contact-form-block__contact-icon"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#e3e3e3"><path d="M0 0h24v24H0z" fill="none"/><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></span>
											<span><?php echo esc_html($email_contact); ?></span>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>

					</figure>
				</div>
			</div>

			<div class="col-12 col-lg-6 sp-mb-4">
				<div class="contact-form-block__content h-100 d-flex flex-column sp-pt-4 sp-xl-pt-6 sp-pl-4 sp-xl-pl-6 sp-pr-4 sp-xl-pr-6">

					<?php 
                    $page_title = get_the_title();
                    if ($block_text) : ?>
						<div class="contact-form-block__text mb-4">
                            <h2 class="h5"><?php echo $block_subtitle; ?> <span class="h5"><?php echo esc_html($page_title); ?></span>?</h2>
                            <div><?php echo $block_text; ?></div>
						</div>
					<?php endif; ?>

					<div class="contact-form-block__form">
						<?php
						if ($form) {
							echo do_shortcode('[contact-form-7 id="' . esc_attr($form) . '" title="Contattaci"]');
						}
						?>
					</div>

				</div>
			</div>

		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
	var hiddenField = document.querySelector('.contact-form-block input[name="page-origin"]');
	if (hiddenField) {
		hiddenField.value = <?php echo wp_json_encode($page_title); ?>;
	}
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const forms = document.querySelectorAll('.contact-form-block .wpcf7 form');

  forms.forEach(function (form) {
    const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
    if (!submitBtn) return;

    const firstName = form.querySelector('[name="first-name"]');
    const lastName = form.querySelector('[name="last-name"]');
    const company = form.querySelector('[name="company"]');
    const email = form.querySelector('[name="email"]');
    const privacy = form.querySelector('[name="privacy-consent"]');

    function isFilled(field) {
      return field && field.value && field.value.trim() !== '';
    }

    function isValidEmail(field) {
      if (!field) return false;
      return field.value.trim() !== '' && field.checkValidity();
    }

    function isChecked(field) {
      return field && field.checked;
    }

    function updateSubmitState() {
      const isValid =
        isFilled(firstName) &&
        isFilled(lastName) &&
        isFilled(company) &&
        isValidEmail(email) &&
        isChecked(privacy);

      submitBtn.disabled = !isValid;
    }

    form.addEventListener('input', updateSubmitState);
    form.addEventListener('change', updateSubmitState);

    document.addEventListener('wpcf7reset', function (event) {
      if (event.target === form) updateSubmitState();
    });

    updateSubmitState();
  });
});
</script>