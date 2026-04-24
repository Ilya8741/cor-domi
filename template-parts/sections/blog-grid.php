<?php
$subtitle = get_sub_field('subtitle');
$title = get_sub_field('title');
$manual_posts = get_sub_field('manual_posts');

$quote_title = get_sub_field('quote_title');
$quote_link = get_sub_field('quote_link');
$quote_text = get_sub_field('quote_text');
$quote_name = get_sub_field('quote_name');
$quote_job = get_sub_field('quote_job');

if (empty($subtitle) && empty($title) && empty($manual_posts) && empty($quote_title) && empty($quote_text)) {
	return;
}

$posts = is_array($manual_posts) ? $manual_posts : array();

if (!function_exists('blog_grid_card_class')) {
	function blog_grid_card_class($position)
	{
		$desktop_class = 'blog-grid__item blog-grid__item--small';

		if ($position <= 3) {
			$desktop_class = 'blog-grid__item blog-grid__item--small';
		} elseif ($position === 4 || $position === 5) {
			$desktop_class = 'blog-grid__item blog-grid__item--wide';
		} elseif ($position === 6 || $position === 7) {
			$desktop_class = 'blog-grid__item blog-grid__item--wide';
		} elseif ($position === 11 || $position === 12) {
			$desktop_class = 'blog-grid__item blog-grid__item--wide';
		}

		$mobile_class = 'blog-grid__item--mobile-small';

		if ($position === 5 || $position === 6 || $position === 11) {
			$mobile_class = 'blog-grid__item--mobile-wide';
		} elseif ($position >= 12) {
			$pattern_index = ($position - 12) % 5;

			if ($pattern_index === 4) {
				$mobile_class = 'blog-grid__item--mobile-wide';
			}
		}

		return $desktop_class . ' ' . $mobile_class;
	}
}
?>

<section class="blog-grid">
	<?php
	$quote_html = '';

	if ($quote_title || $quote_text || $quote_name || $quote_job) {
		ob_start();
	?>
		<div class="blog-grid__quote" data-aos="fade-up" data-aos-duration="1000">
			<section class="quote-section">
				<div class="quote-section__container">
					<div class="quote-section__top">
						<div class="quote-section__quote" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="67" height="49" viewBox="0 0 67 49" fill="none">
								<path d="M67 0C65.8 5.06667 64.5333 10.5333 63.2 16.4C61.8667 22.2667 60.6667 28 59.6 33.6C58.5333 39.2 57.6667 44.3333 57 49H38L36.6 46.8C37.8 42.1333 39.3333 37.1333 41.2 31.8C43.0667 26.3333 45.1333 20.8667 47.4 15.4C49.6667 9.93334 51.8667 4.8 54 0H67ZM30 0C28.8 5.06667 27.5333 10.5333 26.2 16.4C24.8667 22.2667 23.6667 28 22.6 33.6C21.5333 39.2 20.6667 44.3333 20 49H1.2L0 46.8C1.2 42.1333 2.73333 37.1333 4.6 31.8C6.46667 26.3333 8.46667 20.8667 10.6 15.4C12.8667 9.93334 15.0667 4.8 17.2 0H30Z" fill="#0D0D0D" />
							</svg>
						</div>

						<div class="quote-section__line" aria-hidden="true"></div>
					</div>

					<div class="quote-section__grid">
						<div class="quote-section__left">
							<?php if (!empty($quote_title)) : ?>
								<h2 class="quote-section__title main-title-h5">
									<?php echo esc_html($quote_title); ?>
								</h2>
							<?php endif; ?>

							<?php if (!empty($quote_link['url']) && !empty($quote_link['title'])) : ?>
								<a
									class="quote-section__link main-link"
									href="<?php echo esc_url($quote_link['url']); ?>"
									<?php echo !empty($quote_link['target']) ? 'target="' . esc_attr($quote_link['target']) . '"' : ''; ?>>
									<?php echo esc_html($quote_link['title']); ?>
								</a>
							<?php endif; ?>
						</div>

						<div class="quote-section__right">
							<?php if (!empty($quote_text)) : ?>
								<p class="quote-section__text">
									<?php echo esc_html($quote_text); ?>
								</p>
							<?php endif; ?>

							<?php if (!empty($quote_name)) : ?>
								<p class="quote-section__name">
									<?php echo esc_html($quote_name); ?>
								</p>
							<?php endif; ?>

							<?php if (!empty($quote_job)) : ?>
								<p class="quote-section__job">
									<?php echo esc_html($quote_job); ?>
								</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		</div>
	<?php
		$quote_html = ob_get_clean();
	}
	?>
	<div class="blog-grid__container">
		<?php if ($subtitle || $title): ?>
			<div class="blog-grid__header">
				<?php if ($subtitle): ?>
					<p class="blog-grid__subtitle" data-aos="fade-right">
						<?php echo esc_html($subtitle); ?>
					</p>
				<?php endif; ?>

				<?php if ($title): ?>
					<h2 class="blog-grid__title main-title-h3" data-aos="fade-left">
						<?php echo wp_kses_post($title); ?>
					</h2>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if (!empty($posts)): ?>
			<div class="blog-grid__grid">
				<?php
				$visible_index = 0;

				foreach ($posts as $post_id):
					$post_id = (int) $post_id;

					if (!$post_id) {
						continue;
					}

					$visible_index++;

					$post_title = get_the_title($post_id);
					$post_url = get_permalink($post_id);
					$post_location = get_field('location', $post_id);
					$image_id = get_post_thumbnail_id($post_id);

					$item_classes = blog_grid_card_class($visible_index);
				?>
					<article class="<?php echo esc_attr($item_classes); ?>" data-aos="fade-up">
						<a class="blog-grid__card" href="<?php echo esc_url($post_url); ?>">
							<?php if ($image_id): ?>
								<div class="blog-grid__image-wrap">
									<?php
									echo wp_get_attachment_image(
										$image_id,
										'large',
										false,
										array(
											'class' => 'blog-grid__image',
											'loading' => 'lazy',
											'decoding' => 'async',
											'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: $post_title
										)
									);
									?>
								</div>
							<?php endif; ?>

							<div class="blog-grid__meta">
								<?php if ($post_title): ?>
									<h3 class="blog-grid__post-title">
										<?php echo esc_html($post_title); ?>
									</h3>
								<?php endif; ?>

								<?php if ($post_location): ?>
									<p class="blog-grid__location">
										<?php echo esc_html($post_location); ?>
									</p>
								<?php endif; ?>
							</div>
						</a>
					</article>

					<?php if ($visible_index === 5 && $quote_html): ?>
						<?php echo $quote_html; ?>
					<?php endif; ?>
				<?php endforeach; ?>

				<?php if ($visible_index > 0 && $visible_index < 5 && $quote_html): ?>
					<?php echo $quote_html; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>