<?php
$background = get_sub_field('background');
$spacing = get_sub_field('spacing');
$title = get_sub_field('title');
$text = get_sub_field('text');
$link = get_sub_field('link');
$big_image = get_sub_field('big_image');
$small_image = get_sub_field('small_image');

if (empty($title) && empty($text) && empty($link) && empty($big_image) && empty($small_image)) {
	return;
}

$background = !empty($background) ? $background : 'yellow';
$spacing = !empty($spacing) ? $spacing : 'all-spacing';
?>

<section class="grid-section grid-section--<?php echo esc_attr($background); ?> grid-section--<?php echo esc_attr($spacing); ?>">
	<div class="grid-section__container">
		<div class="grid-section__mobile-top">
			<?php if (!empty($big_image)) : ?>
				<div class="grid-section__big-image-wrap">
					<img
						class="grid-section__big-image"
						src="<?php echo esc_url($big_image['url']); ?>"
						alt="<?php echo esc_attr($big_image['alt'] ?: 'Grid section image'); ?>"
						loading="lazy"
					>
				</div>
			<?php endif; ?>

			<?php if (!empty($small_image)) : ?>
				<div class="grid-section__small-image-wrap">
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
					<div class="grid-section__big-image-wrap grid-section__big-image-wrap--desktop">
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
					<div class="grid-section__small-image-wrap grid-section__small-image-wrap--desktop">
						<img
							class="grid-section__small-image"
							src="<?php echo esc_url($small_image['url']); ?>"
							alt="<?php echo esc_attr($small_image['alt'] ?: 'Grid section image'); ?>"
							loading="lazy"
						>
					</div>
				<?php endif; ?>

				<div class="grid-section__content">
					<?php if (!empty($title)) : ?>
						<h2 class="grid-section__title main-title-h4">
							<?php echo esc_html($title); ?>
						</h2>
					<?php endif; ?>

					<?php if (!empty($text)) : ?>
						<p class="grid-section__text">
							<?php echo nl2br(esc_html($text)); ?>
						</p>
					<?php endif; ?>

					<?php if (!empty($link['url']) && !empty($link['title'])) : ?>
						<a
							class="grid-section__link main-link"
							href="<?php echo esc_url($link['url']); ?>"
							<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
						>
							<?php echo esc_html($link['title']); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>