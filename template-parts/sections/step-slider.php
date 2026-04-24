<?php
$title   = get_sub_field('title');
$spacing = get_sub_field('spacing') ?: 'all-spacing';
$items    = get_sub_field('items');

if (empty($items)) {
	return;
}
?>

<section class="step-slider <?php echo esc_attr($spacing); ?>">
	<div class="step-slider-container">
		<?php if ($title): ?>
			<div class="step-slider__heading">
				<h2><?php echo esc_html($title); ?></h2>
			</div>
		<?php endif; ?>
		<?php $duration = 500; ?>
		<div class="step-slider__slider-wrapper">
			<div class="swiper step-slider__swiper js-step-slider-swiper">
				<div class="swiper-wrapper">
					<?php foreach ($items as $item): 
						$step_label = $item['step_label'] ?? '';
						$card_title = $item['title'] ?? '';
						$text       = $item['text'] ?? '';
					?>
						<div class="swiper-slide step-slider__slide" >
							<div class="step-slider__card" data-aos="fade-right"
						data-aos-duration="<?php echo esc_attr($duration); ?>">
								<?php if ($step_label): ?>
									<span class="step-slider__step">
										<?php echo esc_html($step_label); ?>
									</span>
								<?php endif; ?>

								<?php if ($card_title): ?>
									<h5 class="main-title-h5 step-slider__title">
										<?php echo esc_html($card_title); ?>
									</h5>
								<?php endif; ?>

								<?php if ($text): ?>
									<div class="step-slider__text">
										<p><?php echo esc_html($text); ?></p>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<?php $duration += 100; ?>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="step-slider__arrows">
				<button
					type="button"
					class="team-showcase__arrow team-showcase__arrow--prev js-step-slider-prev"
					aria-label="Previous slide"
				>
						<svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
							<path d="M5.5 10.5L0.5 5.5L5.5 0.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M25.5 5.5L0.5 5.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
				</button>

				<button
					type="button"
					class="team-showcase__arrow team-showcase__arrow--next js-step-slider-next"
					aria-label="Next slide"
				>
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
							<path d="M20.5 0.5L25.5 5.5L20.5 10.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M0.5 5.5H25.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
				</button>
			</div>
		</div>
	</div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
	const sliders = document.querySelectorAll('.js-step-slider-swiper');

	if (!sliders.length || typeof Swiper === 'undefined') return;

	sliders.forEach((slider) => {
		const section = slider.closest('.step-slider');
		if (!section) return;

		const prevBtn = section.querySelector('.js-step-slider-prev');
		const nextBtn = section.querySelector('.js-step-slider-next');

		new Swiper(slider, {
			slidesPerView: 1.15,
			spaceBetween: 19,
			speed: 700,
			navigation: {
				prevEl: prevBtn,
				nextEl: nextBtn,
			},
			breakpoints: {
                	768: {
					slidesPerView: 2.1,
					spaceBetween: 19,
				},
				1024: {
					slidesPerView: 3.1,
					spaceBetween: 24,
				},
				1200: {
					slidesPerView: 4.1,
					spaceBetween: 24,
				},
                1441: {
					slidesPerView: 4,
					spaceBetween: 24,
				},
			},
		});
	});
});
</script>