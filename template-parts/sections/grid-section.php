<?php
$background    = get_sub_field('background');
$spacing       = get_sub_field('spacing');
$title         = get_sub_field('title');
$text          = get_sub_field('text');
$link          = get_sub_field('link');
$big_image     = get_sub_field('big_image');
$small_image   = get_sub_field('small_image');
$small_title   = get_sub_field('small_title');
$contact_form  = get_sub_field('contact_form');
$contact_title = get_sub_field('contact_title');

if (empty($title) && empty($text) && empty($link) && empty($big_image) && empty($small_image) && empty($contact_form)) {
	return;
}

$background = !empty($background) ? $background : 'yellow';
$spacing    = !empty($spacing) ? $spacing : 'all-spacing';

$section_id = 'grid-section-' . uniqid();
$modal_id   = $section_id . '-contact-modal';
?>

<section
	id="<?php echo esc_attr($section_id); ?>"
	class="grid-section grid-section--<?php echo esc_attr($background); ?> grid-section--<?php echo esc_attr($spacing); ?><?php if ($small_title): ?> grid-section--small-title<?php endif; ?>"
>
	<div class="grid-section__container">
		<div class="grid-section__mobile-top">
			<?php if (!empty($big_image)) : ?>
				<div class="grid-section__big-image-wrap" data-aos="fade-right">
					<img
						class="grid-section__big-image"
						src="<?php echo esc_url($big_image['url']); ?>"
						alt="<?php echo esc_attr($big_image['alt'] ?: 'Grid section image'); ?>"
						loading="lazy"
					>
				</div>
			<?php endif; ?>

			<?php if (!empty($small_image)) : ?>
				<div class="grid-section__small-image-wrap" data-aos="fade-left">
					<img
						class="grid-section__small-image"
						src="<?php echo esc_url($small_image['url']); ?>"
						alt="<?php echo esc_attr($small_image['alt'] ?: 'Grid section image'); ?>"
						loading="lazy"
					>
				</div>
			<?php endif; ?>
		</div>

		<div class="grid-section__desktop-grid">
			<div class="grid-section__left">
				<?php if (!empty($big_image)) : ?>
					<div class="grid-section__big-image-wrap grid-section__big-image-wrap--desktop" data-aos="fade-right">
						<img
							class="grid-section__big-image"
							src="<?php echo esc_url($big_image['url']); ?>"
							alt="<?php echo esc_attr($big_image['alt'] ?: 'Grid section image'); ?>"
							loading="lazy"
						>
					</div>
				<?php endif; ?>
			</div>

			<div class="grid-section__right">
				<?php if (!empty($small_image)) : ?>
					<div class="grid-section__small-image-wrap grid-section__small-image-wrap--desktop" data-aos="fade-left">
						<img
							class="grid-section__small-image"
							src="<?php echo esc_url($small_image['url']); ?>"
							alt="<?php echo esc_attr($small_image['alt'] ?: 'Grid section image'); ?>"
							loading="lazy"
						>
					</div>
				<?php endif; ?>

				<div class="grid-section__content" data-aos="fade-left">
					<?php if (!empty($title)) : ?>
						<h2 class="grid-section__title main-title-h4">
							<?php echo esc_html($title); ?>
						</h2>
					<?php endif; ?>

					<?php if (!empty($text)) : ?>
						<div class="grid-section__text">
							<?php echo wp_kses_post($text); ?>
						</div>
					<?php endif; ?>

					<?php if (!empty($link['title'])) : ?>

						<?php if (!empty($contact_form)) : ?>
							<a
								class="grid-section__link main-link"
								href="#<?php echo esc_attr($modal_id); ?>"
								data-modal="#<?php echo esc_attr($modal_id); ?>"
								aria-expanded="false"
							>
								<?php echo esc_html($link['title']); ?>
							</a>
						<?php elseif (!empty($link['url'])) : ?>
							<a
								class="grid-section__link main-link"
								href="<?php echo esc_url($link['url']); ?>"
								<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
							>
								<?php echo esc_html($link['title']); ?>
							</a>
						<?php endif; ?>

					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<?php if (!empty($contact_form)) : ?>
		<div id="<?php echo esc_attr($modal_id); ?>" class="team-modal-template" hidden>
			<div class="team-modal__content contact-modal__content">
				<?php if (!empty($contact_title)) : ?>
					<h2 class="team-modal__title contact-modal__title">
						<?php echo wp_kses_post($contact_title); ?>
					</h2>
				<?php endif; ?>

				<div class="contact-modal__form">
					<?php echo do_shortcode($contact_form); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</section>