<?php
$spacing = get_sub_field('spacing');
$title = get_sub_field('title');
$link = get_sub_field('link');
$image_top = get_sub_field('image_top');
$image_bottom = get_sub_field('image_bottom');
$text = get_sub_field('text');

if (empty($title) && empty($link) && empty($image_top) && empty($image_bottom) && empty($text)) {
	return;
}

$spacing = !empty($spacing) ? $spacing : 'all-spacing';
?>

<section class="about-info about-info--<?php echo esc_attr($spacing); ?>">
	<div class="about-info__container">
		<div class="about-info__top">
			<div class="about-info__intro">
				<?php if (!empty($title)) : ?>
					<h2 class="about-info__title main-title-h4">
						<?php echo wp_kses_post($title); ?>
					</h2>
				<?php endif; ?>

				<?php if (!empty($link['url']) && !empty($link['title'])) : ?>
					<a
						class="about-info__link main-link"
						href="<?php echo esc_url($link['url']); ?>"
						<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
					>
						<?php echo esc_html($link['title']); ?>
					</a>
				<?php endif; ?>
			</div>

			<?php if (!empty($image_top)) : ?>
				<div class="about-info__image-top-wrap">
					<img
						class="about-info__image-top"
						src="<?php echo esc_url($image_top['url']); ?>"
						alt="<?php echo esc_attr($image_top['alt'] ?: 'About image'); ?>"
						loading="lazy"
					>
				</div>
			<?php endif; ?>
		</div>

		<div class="about-info__bottom">
			<?php if (!empty($image_bottom)) : ?>
				<div class="about-info__image-bottom-wrap">
					<img
						class="about-info__image-bottom"
						src="<?php echo esc_url($image_bottom['url']); ?>"
						alt="<?php echo esc_attr($image_bottom['alt'] ?: 'About image'); ?>"
						loading="lazy"
					>
				</div>
			<?php endif; ?>

			<?php if (!empty($text)) : ?>
				<div class="about-info__text">
					<?php echo wp_kses_post($text); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>