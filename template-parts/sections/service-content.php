<?php
$spacing    = get_sub_field('spacing') ?: 'all-spacing';
$background = get_sub_field('background') ?: 'bg-beige';

$title = get_sub_field('title');
$text  = get_sub_field('text');
$link  = get_sub_field('link');

$image_1 = get_sub_field('image_1');
$image_2 = get_sub_field('image_2');

$items = get_sub_field('items');

$contact_form  = get_sub_field('contact_form');
$contact_title = get_sub_field('contact_title');

$section_id = 'service-content-' . uniqid();
$modal_id   = $section_id . '-contact-modal';
?>

<?php if ($title || $text || $link || $image_1 || $image_2 || $items || $contact_form): ?>
<section
	id="<?php echo esc_attr($section_id); ?>"
	class="service-content <?php echo esc_attr($spacing); ?> <?php echo esc_attr($background); ?>"
>
	<div class="service-content__container">
		<div class="service-content__top <?php if (!$image_2): ?>service-content__top--without-image<?php endif; ?>">
			<div class="service-content__content" data-aos="fade-right">
				<?php if ($title): ?>
					<h2 class="service-content__title main-title-h5">
						<?php echo esc_html($title); ?>
					</h2>
				<?php endif; ?>

				<?php if ($text): ?>
					<div class="service-content__text">
						<?php echo wp_kses_post($text); ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($link['title'])): ?>

					<?php if (!empty($contact_form)) : ?>
						<a
							class="service-content__link main-link"
							href="#<?php echo esc_attr($modal_id); ?>"
							data-modal="#<?php echo esc_attr($modal_id); ?>"
							aria-expanded="false"
						>
							<?php echo esc_html($link['title']); ?>
						</a>
					<?php elseif (!empty($link['url'])) : ?>
						<a
							class="service-content__link main-link"
							href="<?php echo esc_url($link['url']); ?>"
							<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
						>
							<?php echo esc_html($link['title']); ?>
						</a>
					<?php endif; ?>

				<?php endif; ?>
			</div>

			<?php if ($image_1): ?>
				<div class="service-content__image service-content__image--small" data-aos="fade-left">
					<?php
					echo wp_get_attachment_image(
						$image_1['ID'],
						'full',
						false,
						array(
							'class'    => 'service-content__img',
							'loading'  => 'lazy',
							'decoding' => 'async',
							'alt'      => !empty($image_1['alt']) ? $image_1['alt'] : ''
						)
					);
					?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ($image_2): ?>
			<div class="service-content__bottom">
				<div class="service-content__image service-content__image--large" data-aos="fade-right">
					<?php
					echo wp_get_attachment_image(
						$image_2['ID'],
						'full',
						false,
						array(
							'class'    => 'service-content__img',
							'loading'  => 'lazy',
							'decoding' => 'async',
							'alt'      => !empty($image_2['alt']) ? $image_2['alt'] : ''
						)
					);
					?>
				</div>

				<?php if (!empty($items)): ?>
					<div class="service-content__accordion" data-aos="fade-left">
						<?php foreach ($items as $index => $item):
							$item_title = $item['title'] ?? '';
							$item_text  = $item['text'] ?? '';
							$is_open    = $index === 0;

							if (!$item_title && !$item_text) {
								continue;
							}
						?>
							<div class="service-content__accordion-item main-accordion-item <?php echo $is_open ? 'is-open' : ''; ?>">
								<button
									class="service-content__accordion-button main-accordion-button"
									type="button"
									aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
								>
									<h4 class="service-content__accordion-title main-title-h6">
										<?php echo esc_html($item_title); ?>
									</h4>

									<svg xmlns="http://www.w3.org/2000/svg" class="service-content__accordion-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M5 12H19" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M12 5V19" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</button>

								<div class="service-content__accordion-content">
									<div class="service-content__accordion-inner">
										<?php if ($item_text): ?>
											<div class="service-content__accordion-text">
												<?php echo wp_kses_post($item_text); ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
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
<?php endif; ?>