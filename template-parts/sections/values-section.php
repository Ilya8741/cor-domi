<?php
$background = get_sub_field('background');
$spacing = get_sub_field('spacing');
$text = get_sub_field('text');
$link = get_sub_field('link');
$image = get_sub_field('image');
$subtitle = get_sub_field('subtitle');
$items = get_sub_field('items');

if (empty($text) && empty($link) && empty($image) && empty($subtitle) && empty($items)) {
	return;
}

$background = !empty($background) ? $background : 'yellow';
$spacing = !empty($spacing) ? $spacing : 'all-spacing';
?>

<section class="values-section values-section--<?php echo esc_attr($background); ?> values-section--<?php echo esc_attr($spacing); ?>">
	<div class="values-section__container">
		<div class="values-section__grid">
			<div class="values-section__left">
				<?php if (!empty($text)) : ?>
					<div class="values-section__text">
						<?php echo wp_kses_post($text); ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($link['url']) && !empty($link['title'])) : ?>
					<a
						class="values-section__link main-link"
						href="<?php echo esc_url($link['url']); ?>"
						<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
					>
						<?php echo esc_html($link['title']); ?>
					</a>
				<?php endif; ?>

				<?php if (!empty($image)) : ?>
					<div class="values-section__image-wrap">
						<img
							class="values-section__image"
							src="<?php echo esc_url($image['url']); ?>"
							alt="<?php echo esc_attr($image['alt'] ?: 'Values image'); ?>"
							loading="lazy"
						>
					</div>
				<?php endif; ?>
			</div>

			<div class="values-section__right">
				<?php if (!empty($subtitle)) : ?>
					<p class="values-section__subtitle">
						<?php echo esc_html($subtitle); ?>
					</p>
				<?php endif; ?>

				<?php if (!empty($items) && is_array($items)) : ?>
					<div class="values-section__items">
						<?php foreach ($items as $item) :
							$item_title = $item['title'] ?? '';
							$item_text = $item['text'] ?? '';
							?>
							<div class="values-section__item">
								<?php if (!empty($item_title)) : ?>
									<h3 class="values-section__item-title main-title-h5">
										<?php echo esc_html($item_title); ?>
									</h3>
								<?php endif; ?>
								<?php if (!empty($item_text)) : ?>
									<p class="values-section__item-text">
										<?php echo esc_html($item_text); ?>
									</p>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>