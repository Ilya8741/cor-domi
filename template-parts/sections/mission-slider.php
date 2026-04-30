<?php
$subtitle = get_sub_field('subtitle');
$title = get_sub_field('title');
$images = get_sub_field('images');
$spacing = get_sub_field('spacing');

$background = get_sub_field('background');
$spacing = get_sub_field('spacing');

$background = !empty($background) ? $background : 'yellow';
$spacing = !empty($spacing) ? $spacing : 'all-spacing';

if (empty($subtitle) && empty($title) && empty($images)) {
	return;
}

$spacing = !empty($spacing) ? $spacing : 'all-spacing';
?>

<section class="mission-slider mission-slider--<?php echo esc_attr($background); ?> mission-slider--<?php echo esc_attr($spacing); ?>">
	<?php if (!empty($subtitle) || !empty($title)) : ?>
		<div class="mission-slider__head" data-aos="fade-right">
			<?php if (!empty($subtitle)) : ?>
				<p class="mission-slider__subtitle">
					<?php echo esc_html($subtitle); ?>
				</p>
			<?php endif; ?>

			<?php if (!empty($title)) : ?>
				<h2 class="mission-slider__title main-title-h4">
					<?php echo wp_kses_post($title); ?>
				</h2>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if (!empty($images) && is_array($images)) : ?>
		<?php $duration = 500; ?>

		<div class="mission-slider__slider-wrapper">
			<div class="mission-slider__slider swiper js-mission-slider">
				<div class="swiper-wrapper">
					<?php foreach ($images as $index => $item) :
						$image = $item['image'] ?? null;
						$link = $item['link'] ?? null;

						if (empty($image)) {
							continue;
						}

						$number = $index + 1;
						$ratio_class = ($number % 2 !== 0) ? 'mission-slider__slide--odd' : 'mission-slider__slide--even';
					?>
						<div
							class="swiper-slide mission-slider__slide <?php echo esc_attr($ratio_class); ?>"
							data-aos="fade-right"
							data-aos-duration="<?php echo esc_attr($duration); ?>">
							<?php if (!empty($link['url'])) : ?>
								<a
									class="mission-slider__slide-link"
									href="<?php echo esc_url($link['url']); ?>"
									<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
									<img
										class="mission-slider__image"
										src="<?php echo esc_url($image['url']); ?>"
										alt="<?php echo esc_attr($image['alt'] ?: 'Mission image'); ?>"
										loading="lazy">
								</a>
							<?php else : ?>
								<div class="mission-slider__slide-link">
									<img
										class="mission-slider__image"
										src="<?php echo esc_url($image['url']); ?>"
										alt="<?php echo esc_attr($image['alt'] ?: 'Mission image'); ?>"
										loading="lazy">
								</div>
							<?php endif; ?>
						</div>
						<?php $duration += 100; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</section>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const sliders = document.querySelectorAll('.js-mission-slider');
		if (!sliders.length || typeof Swiper === 'undefined') return;

		sliders.forEach((slider) => {
			new Swiper(slider, {
				slidesPerView: "auto",
				spaceBetween: 19,
				loop: true,
				speed: 700,
				allowTouchMove: false,
				autoplay: {
					delay: 1000,
					disableOnInteraction: false,
					pauseOnMouseEnter: false
				},
				breakpoints: {
					768: {
						spaceBetween: 25
					}
				}
			});
		});
	});
</script>