<?php
$spacing = get_sub_field('spacing');
$title = get_sub_field('title');
$logos = get_sub_field('logos');

if (empty($title) && empty($logos)) {
	return;
}

$spacing = !empty($spacing) ? $spacing : 'all-spacing';
?>

<section class="logos-section logos-section--<?php echo esc_attr($spacing); ?>">
	<div class="logos-section__container">
		<?php if (!empty($title)) : ?>
			<div class="logos-section__title">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<?php if (!empty($logos) && is_array($logos)) : ?>
			<div class="logos-section__grid">
				<?php foreach ($logos as $item) :
					$image = $item['logo'] ?? null;
					$link = $item['link'] ?? null;

					if (empty($image)) {
						continue;
					}
					?>
								<img
									class="logos-section__logo"
									src="<?php echo esc_url($image['url']); ?>"
									alt="<?php echo esc_attr($image['alt'] ?: 'Logo'); ?>"
									loading="lazy"
								>
				<?php endforeach; ?>
			</div>

			<div class="logos-section__marquee-wrap">
				<?php for ($row = 1; $row <= 3; $row++) : ?>
					<div class="logos-section__marquee" style="--gap: 26px;">
						<div class="logos-section__marquee-inner <?php echo $row === 2 ? 'direction-right' : 'direction-left'; ?> js-logos-marquee-inner" data-speed="80">
							<?php for ($seg = 1; $seg <= 3; $seg++) : ?>
								<div class="logos-section__segment" data-seg="<?php echo esc_attr($seg); ?>" <?php echo $seg > 1 ? 'aria-hidden="true"' : ''; ?>>
									<?php foreach ($logos as $item) :
										$image = $item['logo'] ?? null;
										$link = $item['link'] ?? null;

										if (empty($image)) {
											continue;
										}
										?>
										<img
														class="logos-section__logo"
														src="<?php echo esc_url($image['url']); ?>"
														alt="<?php echo esc_attr($image['alt'] ?: 'Logo'); ?>"
														loading="lazy"
													>
									<?php endforeach; ?>
								</div>
							<?php endfor; ?>
						</div>
					</div>
				<?php endfor; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
	const marquees = document.querySelectorAll('.logos-section__marquee');
	if (!marquees.length) return;

	function initMarquee(root) {
		const inner = root.querySelector('.js-logos-marquee-inner');
		if (!inner) return;

		const segments = Array.from(inner.querySelectorAll('.logos-section__segment'));
		if (segments.length < 3) return;

		const SPEED = Number(inner.getAttribute('data-speed')) || 80;

		function fillToViewport(seg) {
			const vw = root.clientWidth;
			const children = Array.from(seg.children);
			if (!children.length) return;

			let guard = 0;
			while (seg.scrollWidth < vw && guard < 20) {
				const frag = document.createDocumentFragment();
				children.forEach((node) => frag.appendChild(node.cloneNode(true)));
				seg.appendChild(frag);
				guard++;
			}
		}

		function measureWidth(seg) {
			return seg.getBoundingClientRect().width;
		}

		function apply() {
			segments.forEach((s) => s.style.animation = 'none');

			segments.forEach(fillToViewport);

			const distance = Math.max(1, measureWidth(segments[0]));
			const duration = distance / SPEED;

			segments.forEach((seg, i) => {
				seg.style.setProperty('--seg-duration', `${duration}s`);
				seg.style.setProperty('--seg-delay', `${-(i * duration / segments.length)}s`);
			});

			requestAnimationFrame(() => {
				segments.forEach((seg) => {
					const animationName = inner.classList.contains('direction-right')
						? 'logos-marquee-right'
						: 'logos-marquee-left';

					seg.style.animation = `${animationName} var(--seg-duration) linear infinite`;
				});
			});
		}

		apply();

		if (document.fonts && document.fonts.ready) {
			document.fonts.ready.then(apply).catch(() => {});
		}

		let rAF;
		const onResize = () => {
			cancelAnimationFrame(rAF);
			rAF = requestAnimationFrame(apply);
		};

		window.addEventListener('resize', onResize, { passive: true });
	}

	marquees.forEach(initMarquee);
});
</script>