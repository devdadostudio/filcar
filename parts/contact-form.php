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

<section class="contact-form-block position-relative overflow-hidden sp-pt-6 sp-pb-0 sp-md-pt-13 sp-llg-pt-13 sp-llg-pb-8 bg-grey">
	<div class="container-fluid">
		<div class="row g-3 g-lg-4 align-items-stretch">

			<div class="col-12 col-lg-6 sp-mb-4">
				<div class="contact-form-block__media position-relative h-100">
					<figure class="contact-form-block__figure mb-0 h-100 position-relative">

						<?php if ($img_url) : ?>
							<img
								class="contact-form-block__img d-none d-md-block"
								src="<?php echo esc_url($img_url); ?>"
								alt="<?php echo esc_attr($block_title ?: 'Contatti'); ?>">
						<?php endif; ?>

						<?php if ($img_mob_url) : ?>
							<img
								class="contact-form-block__img d-block d-md-none"
								src="<?php echo esc_url($img_mob_url); ?>"
								alt="<?php echo esc_attr($block_title ?: 'Contatti'); ?>">
						<?php endif; ?>

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
											<span class="contact-form-block__contact-icon">☎</span>
											<span><?php echo esc_html($phone_contact); ?></span>
										</a>
									<?php endif; ?>

									<?php if ($email_contact) : ?>
										<a href="mailto:<?php echo esc_attr($email_contact); ?>" class="contact-form-block__contact-link">
											<span class="contact-form-block__contact-icon">✉</span>
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