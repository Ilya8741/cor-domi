<?php
$background = get_sub_field('background');
$spacing = get_sub_field('spacing');
$title = get_sub_field('title');
$link = get_sub_field('link');
$text = get_sub_field('text');
$name = get_sub_field('name');
$job = get_sub_field('job');
$without_link = get_sub_field('without_link');

if (empty($title) && empty($link) && empty($text) && empty($name) && empty($job)) {
	return;
}

$background = !empty($background) ? $background : 'yellow';
$spacing = !empty($spacing) ? $spacing : 'all-spacing';
?>

<section class="quote-section <?php if ($without_link): ?> quote-section--without-link<?php endif; ?> quote-section--<?php echo esc_attr($background); ?> quote-section--<?php echo esc_attr($spacing); ?>">
	<div class="quote-section__container">
		<div class="quote-section__top">
			<div class="quote-section__quote" aria-hidden="true">
				<svg xmlns="http://www.w3.org/2000/svg" width="67" height="49" viewBox="0 0 67 49" fill="none">
					<path d="M67 0C65.8 5.06667 64.5333 10.5333 63.2 16.4C61.8667 22.2667 60.6667 28 59.6 33.6C58.5333 39.2 57.6667 44.3333 57 49H38L36.6 46.8C37.8 42.1333 39.3333 37.1333 41.2 31.8C43.0667 26.3333 45.1333 20.8667 47.4 15.4C49.6667 9.93334 51.8667 4.8 54 0H67ZM30 0C28.8 5.06667 27.5333 10.5333 26.2 16.4C24.8667 22.2667 23.6667 28 22.6 33.6C21.5333 39.2 20.6667 44.3333 20 49H1.2L0 46.8C1.2 42.1333 2.73333 37.1333 4.6 31.8C6.46667 26.3333 8.46667 20.8667 10.6 15.4C12.8667 9.93334 15.0667 4.8 17.2 0H30Z" fill="#0D0D0D"/>
				</svg>
			</div>

			<div class="quote-section__line" aria-hidden="true"></div>
		</div>

		<div class="quote-section__grid">
			<div class="quote-section__left" data-aos="fade-right">
				<?php if (!empty($title)) : ?>
					<h2 class="quote-section__title main-title-h5">
						<?php echo esc_html($title); ?>
					</h2>
				<?php endif; ?>

				<?php if (!empty($link['url']) && !empty($link['title'])) : ?>
					<a
						class="quote-section__link main-link"
						href="<?php echo esc_url($link['url']); ?>"
						<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
					>
						<?php echo esc_html($link['title']); ?>
					</a>
				<?php endif; ?>
			</div>

			<div class="quote-section__right" data-aos="fade-left">
				<?php if (!empty($text)) : ?>
					<p class="quote-section__text">
						<?php echo esc_html($text); ?>
					</p>
				<?php endif; ?>

				<?php if (!empty($name)) : ?>
					<p class="quote-section__name">
						<?php echo esc_html($name); ?>
					</p>
				<?php endif; ?>

				<?php if (!empty($job)) : ?>
					<p class="quote-section__job">
						<?php echo esc_html($job); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>