<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$link = get_sub_field('link');
$images = get_sub_field('images');

	$filled_images = array();

		if (!empty($images) && is_array($images)) {
			foreach ($images as $index => $item) {
				$image = $item['image'] ?? null;

				if (!empty($image)) {
					$filled_images[] = array(
						'index' => $index,
						'image' => $image,
					);
				}
			}
		}

		$only_first_image = (
			count($filled_images) === 1 &&
			isset($filled_images[0]['index']) &&
			(int) $filled_images[0]['index'] === 0
		);

if (empty($title) && empty($text) && empty($link) && empty($images)) {
	return;
}
?>

<section class="sticky-section">
	<div class="sticky-section__container">
		<div class="sticky-section__grid <?php echo $only_first_image ? 'only-one' : ''; ?>">

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

		<?php if (!empty($filled_images)) : ?>
			<div class="sticky-section__right">
				<div class="sticky-section__images <?php echo $only_first_image ? 'only-one' : ''; ?>">
					<?php foreach ($filled_images as $filled_item) :
						$index = $filled_item['index'];
						$image = $filled_item['image'];

						$number = $index + 1;
						$item_class = 'sticky-section__image sticky-section__image--' . $number;
						?>
						<div class="<?php echo esc_attr($item_class); ?>" data-aos="fade-up">
							<img
								src="<?php echo esc_url($image['url']); ?>"
								alt="<?php echo esc_attr(!empty($image['alt']) ? $image['alt'] : 'Sticky section image'); ?>"
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