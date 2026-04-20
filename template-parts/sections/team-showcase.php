<?php
$subtitle   = get_sub_field('subtitle');
$title      = get_sub_field('title');
$items      = get_sub_field('items');
$background = get_sub_field('background');
$spacing    = get_sub_field('spacing');

if (empty($subtitle) && empty($title) && empty($items)) {
	return;
}

$background = !empty($background) ? $background : 'yellow';
$spacing    = !empty($spacing) ? $spacing : 'all-spacing';
?>

<section class="team-showcase team-showcase--<?php echo esc_attr($background); ?> team-showcase--<?php echo esc_attr($spacing); ?>">
	<div class="team-showcase__container">

		<?php if (!empty($subtitle) || !empty($title)) : ?>
			<div class="team-showcase__head" data-aos="fade-up">
				<?php if (!empty($subtitle)) : ?>
					<p class="team-showcase__subtitle">
						<?php echo esc_html($subtitle); ?>
					</p>
				<?php endif; ?>

				<?php if (!empty($title)) : ?>
					<h2 class="team-showcase__title main-title-h4">
						<?php echo wp_kses_post($title); ?>
					</h2>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if (!empty($items) && is_array($items)) : ?>

			<div class="team-showcase__desktop" data-aos="fade-up">
				<div class="team-showcase__images js-team-images-slick">
					<?php foreach ($items as $item) :
						$image = $item['image'] ?? null;
						if (empty($image)) continue;
						?>
						<div class="team-showcase__image-slide">
							<div class="team-showcase__image-slide-inner">
								<div class="team-showcase__image-wrap">
									<img
										class="team-showcase__image"
										src="<?php echo esc_url($image['url']); ?>"
										alt="<?php echo esc_attr($image['alt'] ?: 'Team member'); ?>"
										loading="lazy"
									>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="team-showcase__content-area">
                    <div class="team-showcase__content-area-wrapper">
					<div class="team-showcase__content js-team-content-slick">
						<?php foreach ($items as $item) :
							$name = $item['name'] ?? '';
							$job  = $item['job'] ?? '';
							$text = $item['text'] ?? '';
							$link = $item['link'] ?? null;
							?>
							<div class="team-showcase__content-slide">
								<div class="team-showcase__content-inner">
									<?php if (!empty($name)) : ?>
										<h3 class="team-showcase__name main-title-h5"><?php echo esc_html($name); ?></h3>
									<?php endif; ?>

									<?php if (!empty($job)) : ?>
										<p class="team-showcase__job"><?php echo esc_html($job); ?></p>
									<?php endif; ?>

									<?php if (!empty($text)) : ?>
										<p class="team-showcase__text"><?php echo esc_html($text); ?></p>
									<?php endif; ?>

									<?php if (!empty($link['url']) && !empty($link['title'])) : ?>
										<a
											class="team-showcase__link main-link"
											href="<?php echo esc_url($link['url']); ?>"
											<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
										>
											<?php echo esc_html($link['title']); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="team-showcase__nav">
						<button class="team-showcase__arrow team-showcase__arrow--prev" type="button" aria-label="Previous slide">
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
								<path d="M5.5 10.5L0.5 5.5L5.5 0.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M25.5 5.5L0.5 5.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
						<button class="team-showcase__arrow team-showcase__arrow--next" type="button" aria-label="Next slide">
							<svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
								<path d="M20.5 0.5L25.5 5.5L20.5 10.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M0.5 5.5H25.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
					</div>
				</div>
                 </div>
			</div>

			<div class="team-showcase__mobile" data-aos="fade-right">
				<div class="team-showcase__mobile-slider js-team-mobile-slick">
					<?php foreach ($items as $item) :
						$image = $item['image'] ?? null;
						$name  = $item['name'] ?? '';
						$job   = $item['job'] ?? '';
						$text  = $item['text'] ?? '';
						$link  = $item['link'] ?? null;
						?>
						<div class="team-showcase__mobile-slide">
							<?php if (!empty($image)) : ?>
								<div class="team-showcase__mobile-image-wrap">
									<img
										class="team-showcase__mobile-image"
										src="<?php echo esc_url($image['url']); ?>"
										alt="<?php echo esc_attr($image['alt'] ?: 'Team member'); ?>"
										loading="lazy"
									>
								</div>
							<?php endif; ?>

							<div class="team-showcase__mobile-content">
								<?php if (!empty($name)) : ?>
									<h3 class="team-showcase__name main-title-h5"><?php echo esc_html($name); ?></h3>
								<?php endif; ?>

								<?php if (!empty($job)) : ?>
									<p class="team-showcase__job"><?php echo esc_html($job); ?></p>
								<?php endif; ?>

								<?php if (!empty($text)) : ?>
									<p class="team-showcase__text"><?php echo esc_html($text); ?></p>
								<?php endif; ?>

								<?php if (!empty($link['url']) && !empty($link['title'])) : ?>
									<a
										class="team-showcase__link main-link"
										href="<?php echo esc_url($link['url']); ?>"
										<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
									>
										<?php echo esc_html($link['title']); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="team-showcase__nav team-showcase__nav--mobile">
					<button class="team-showcase__arrow team-showcase__arrow--mobile-prev" type="button" aria-label="Previous slide">
						<svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
							<path d="M5.5 10.5L0.5 5.5L5.5 0.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M25.5 5.5L0.5 5.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
					<button class="team-showcase__arrow team-showcase__arrow--mobile-next" type="button" aria-label="Next slide">
						<svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
							<path d="M20.5 0.5L25.5 5.5L20.5 10.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M0.5 5.5H25.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
				</div>
			</div>

		<?php endif; ?>
	</div>
</section>

<script>
jQuery(function ($) {
	const $section = $('.team-showcase');
	if (!$section.length) return;

	const $images = $section.find('.js-team-images-slick');
	const $content = $section.find('.js-team-content-slick');
	const $mobile = $section.find('.js-team-mobile-slick');

	if (window.innerWidth > 767 && $images.length && $content.length) {
		$content.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: false,
			arrows: false,
			draggable: false,
			swipe: false,
			adaptiveHeight: true,
            initialSlide: 2,
			speed: 500,
            swipeToSlide: true,
            touchThreshold: 10,
            edgeFriction: 0.15,
            fade: true,
            cssEase: 'ease',
		});

		$images.on('afterChange', function (event, slick, currentSlide) {
			$content.slick('slickGoTo', currentSlide);
		});

		$images.slick({
			centerMode: true,
			centerPadding: '0px',
			variableWidth: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: false,
			speed: 500,
			arrows: true,
            initialSlide: 2,
			prevArrow: $section.find('.team-showcase__arrow--prev'),
			nextArrow: $section.find('.team-showcase__arrow--next'),
			focusOnSelect: true,
			cssEase: 'ease',
		});
	}

	if (window.innerWidth <= 767 && $mobile.length) {
		$mobile.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: false,
			arrows: true,
			prevArrow: $section.find('.team-showcase__arrow--mobile-prev'),
			nextArrow: $section.find('.team-showcase__arrow--mobile-next'),
			speed: 500
		});
	}
});
</script>