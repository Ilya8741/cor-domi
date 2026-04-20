<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$link = get_sub_field('link');
$images = get_sub_field('images');

if (empty($title) && empty($text) && empty($link) && empty($images)) {
	return;
}
?>

<section class="sticky-section">
	<div class="sticky-section__container">
		<div class="sticky-section__grid">

			<div class="sticky-section__left" data-aos="fade-right">
				<div class="sticky-section__left-inner">
					<div class="sticky-section__top-content">
						<?php if (!empty($title)) : ?>
							<h2 class="sticky-section__title main-title-h5">
								<?php echo wp_kses_post($title); ?>
							</h2>
						<?php endif; ?>
					</div>

					<div class="sticky-section__bottom-content">
						<?php if (!empty($text)) : ?>
							<div class="sticky-section__text">
								<?php echo wp_kses_post($text); ?>
							</div>
						<?php endif; ?>

						<?php if (!empty($link['url']) && !empty($link['title'])) : ?>
							<a
								class="sticky-section__link main-link"
								href="<?php echo esc_url($link['url']); ?>"
								<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
							>
								<?php echo esc_html($link['title']); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<?php if (!empty($images) && is_array($images)) : ?>
				<div class="sticky-section__right">
					<div class="sticky-section__images">
						<?php foreach ($images as $index => $item) :
							$image = $item['image'] ?? null;

							if (empty($image)) {
								continue;
							}

							$number = $index + 1;
							$item_class = 'sticky-section__image sticky-section__image--' . $number;
							?>
							<div class="<?php echo esc_attr($item_class); ?>" data-aos="fade-up">
								<img
									src="<?php echo esc_url($image['url']); ?>"
									alt="<?php echo esc_attr($image['alt'] ?: 'Sticky section image'); ?>"
									loading="lazy"
								>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>