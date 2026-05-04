<?php
$title         = get_sub_field('title');
$text          = get_sub_field('text');
$link          = get_sub_field('link');
$images        = get_sub_field('images');
$contact_form  = get_sub_field('contact_form');
$contact_title = get_sub_field('contact_title');

$filled_images = array();

if (!empty($images) && is_array($images)) {
	foreach ($images as $index => $item) {
		$image   = $item['image'] ?? null;
		$version = $item['version'] ?? 'none';

		if (!empty($image)) {
			$allowed_versions = array(
				'none',
				'one-column',
				'two-column',
				'landscape',
			);

			if (!in_array($version, $allowed_versions, true)) {
				$version = 'none';
			}

			$filled_images[] = array(
				'index'   => $index,
				'image'   => $image,
				'version' => $version,
			);
		}
	}
}

$only_first_image = (
	count($filled_images) === 1 &&
	isset($filled_images[0]['index']) &&
	(int) $filled_images[0]['index'] === 0
);

if (empty($title) && empty($text) && empty($link) && empty($images) && empty($contact_form)) {
	return;
}

$section_id = 'sticky-section-' . uniqid();
$modal_id   = $section_id . '-contact-modal';
?>

<section id="<?php echo esc_attr($section_id); ?>" class="sticky-section">
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

						<?php if (!empty($link['title'])) : ?>

							<?php if (!empty($contact_form)) : ?>
								<a
									class="sticky-section__link main-link"
									href="#<?php echo esc_attr($modal_id); ?>"
									data-modal="#<?php echo esc_attr($modal_id); ?>"
									aria-expanded="false"
								>
									<?php echo esc_html($link['title']); ?>
								</a>
							<?php elseif (!empty($link['url'])) : ?>
								<a
									class="sticky-section__link main-link"
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

			<?php if (!empty($filled_images)) : ?>
				<div class="sticky-section__right">
					<div class="sticky-section__images <?php echo $only_first_image ? 'only-one' : ''; ?>">
						<?php foreach ($filled_images as $filled_item) :
							$index   = $filled_item['index'];
							$image   = $filled_item['image'];
							$version = $filled_item['version'] ?? 'none';

							$number = $index + 1;

							$item_class = array(
								'sticky-section__image',
								'sticky-section__image--' . $number,
								'sticky-section__image--' . $version,
							);
						?>
							<div class="<?php echo esc_attr(implode(' ', $item_class)); ?>" data-aos="fade-up">
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