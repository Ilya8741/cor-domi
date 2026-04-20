<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$link = get_sub_field('link');
$images = get_sub_field('images');

if (empty($title) && empty($subtitle) && empty($link) && empty($images)) {
	return;
}

$top_images = [];
$bottom_images = [];

if (!empty($images) && is_array($images)) {
	foreach ($images as $index => $item) {
		$number = $index + 1;

		if ($number <= 2) {
			$top_images[$number] = $item;
		} elseif ($number <= 5) {
			$bottom_images[$number] = $item;
		}
	}
}
?>

<section class="parallax-section js-parallax-section">
	<div class="parallax-container">
		<div class="parallax-section__inner">

			<?php if (!empty($top_images)) : ?>
				<div class="parallax-section__top">
					<?php foreach ($top_images as $number => $item) :
						$image = $item['image'] ?? null;
						$speed = isset($item['speed']) && $item['speed'] !== '' ? (float) $item['speed'] : 1;

						if (empty($image)) {
							continue;
						}
					?>
						<div
							class="parallax-section__image parallax-section__image--<?php echo esc_attr($number); ?> js-parallax-item"
							data-speed="<?php echo esc_attr($speed); ?>"
						>
							<img
								src="<?php echo esc_url($image['url']); ?>"
								alt="<?php echo esc_attr($image['alt'] ?: 'Parallax image'); ?>"
								loading="lazy"
							>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="parallax-section__content">
				<?php if (!empty($title)) : ?>
					<h3 class="parallax-section__title main-title-h3">
						<?php echo wp_kses_post($title); ?>
					</h3>
				<?php endif; ?>

				<?php if (!empty($subtitle)) : ?>
					<h4 class="parallax-section__subtitle">
						<?php echo wp_kses_post($subtitle); ?>
					</h4>
				<?php endif; ?>

				<?php if (!empty($link['url']) && !empty($link['title'])) : ?>
					<a
						class="parallax-section__link main-link"
						href="<?php echo esc_url($link['url']); ?>"
						<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
					>
						<?php echo esc_html($link['title']); ?>
					</a>
				<?php endif; ?>
			</div>

			<?php if (!empty($bottom_images)) : ?>
				<div class="parallax-section__bottom">
					<?php foreach ($bottom_images as $number => $item) :
						$image = $item['image'] ?? null;
						$speed = isset($item['speed']) && $item['speed'] !== '' ? (float) $item['speed'] : 1;

						if (empty($image)) {
							continue;
						}
					?>
						<div
							class="parallax-section__image parallax-section__image--<?php echo esc_attr($number); ?> js-parallax-item"
							data-speed="<?php echo esc_attr($speed); ?>"
						>
							<img
								src="<?php echo esc_url($image['url']); ?>"
								alt="<?php echo esc_attr($image['alt'] ?: 'Parallax image'); ?>"
								loading="lazy"
							>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
	const sections = document.querySelectorAll('.js-parallax-section');
	if (!sections.length) return;

	const clamp = (value, min, max) => Math.min(Math.max(value, min), max);
	const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);

	const getBaseOffset = (item) => {
		if (item.classList.contains('parallax-section__image--1')) return 320;
		if (item.classList.contains('parallax-section__image--2')) return 420;
		if (item.classList.contains('parallax-section__image--3')) return 380;
		if (item.classList.contains('parallax-section__image--4')) return 500;
		if (item.classList.contains('parallax-section__image--5')) return 600;
		return 360;
	};

	const updateParallax = () => {
		const viewportHeight = window.innerHeight || document.documentElement.clientHeight;

		sections.forEach((section) => {
			const rect = section.getBoundingClientRect();
			const items = section.querySelectorAll('.js-parallax-item');
			if (!items.length) return;

			/*
				progress = 0  -> секция только начинает входить снизу
				progress = 1  -> секция прокручена примерно на всю свою высоту
			*/
			const distance = viewportHeight + rect.height;
			const traveled = viewportHeight - rect.top;
			const rawProgress = traveled / distance;
			const progress = clamp(rawProgress, 0, 1);

			/*
				чтобы движение шло почти всю секцию, без быстрого финиша
			*/
			const eased = easeOutCubic(progress);

			items.forEach((item) => {
				const speed = parseFloat(item.dataset.speed || '1');
				const offset = getBaseOffset(item) * (0.85 + speed);
				const y = offset * (1 - eased);

				item.style.setProperty('--parallax-y', `${y}px`);
			});
		});
	};

	let ticking = false;

	const requestTick = () => {
		if (ticking) return;
		ticking = true;

		window.requestAnimationFrame(() => {
			updateParallax();
			ticking = false;
		});
	};

	updateParallax();

	window.addEventListener('scroll', requestTick, { passive: true });
	window.addEventListener('resize', requestTick);
	window.addEventListener('load', requestTick);
});
</script>