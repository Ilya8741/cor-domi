<?php
$content_approach = get_sub_field('content_approach');
$content_outcome = get_sub_field('content_outcome');
$link = get_sub_field('link');
$images = get_sub_field('images');
$article_title = get_the_title();
?>

<section class="sticky-section">
	<div class="sticky-section__container">
		<div class="sticky-section__grid article-sticky-content__grid">
			<div class="sticky-section__left article--sticky-section__left" data-aos="fade-right">
				<div class="sticky-section__left-inner">
					<h2 class="sticky-section__top-content article-sticky-content-title main-title-h5">
						<?php echo wp_kses_post($article_title); ?>
					</h2>

					<div class="sticky-section__bottom-content article-sticky-section__bottom-content">
						<?php if (!empty($content_approach)) : ?>
								<div class="main-accordion-item overview-main-accordion-item key-features-main-accordion-item is-open">
								<button class="main-accordion-button key-features-main-accordion-button">
									<span class="key-features-title">
										Overview
									</span>
									<svg xmlns="http://www.w3.org/2000/svg" class="site-footer__accordion-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M5 12H19" stroke="#0d0d0d" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M12 5V19" stroke="#0d0d0d" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</button>
								<div class="site-footer__accordion-content article--accordion-content">
									<div class="article-sticky-content site-footer__accordion-inner">
											<?php echo wp_kses_post($content_approach); ?>
									</div>
								</div>
							</div>
						
						<?php endif; ?>
						<?php if (!empty($content_outcome)) : ?>
							<div class="main-accordion-item key-features-main-accordion-item">
								<button class="main-accordion-button key-features-main-accordion-button">
									<span class="key-features-title">
										Key features
									</span>
									<svg xmlns="http://www.w3.org/2000/svg" class="site-footer__accordion-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M5 12H19" stroke="#0d0d0d" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M12 5V19" stroke="#0d0d0d" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</button>
								<div class="site-footer__accordion-content article--accordion-content">
									<div class="article-sticky-content site-footer__accordion-inner">
											<?php echo wp_kses_post($content_outcome); ?>
									</div>
								</div>
							</div>
						<?php endif; ?>

						<?php if (!empty($link['url']) && !empty($link['title'])) : ?>
							<a
								class="sticky-section__link article-sticky-content__link main-link"
								href="<?php echo esc_url($link['url']); ?>"
								<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
								<?php echo esc_html($link['title']); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<?php if (!empty($images) && is_array($images)) : ?>
				<div class="sticky-section__right">
					<div class="sticky-section__images">
						<?php foreach ($images as $index => $item) :
							$image   = $item['image'] ?? null;
							$version = $item['version'] ?? 'none';

							if (empty($image)) {
								continue;
							}

							$allowed_versions = array(
								'none',
								'one-column',
								'two-column',
								'landscape',
							);

							if (!in_array($version, $allowed_versions, true)) {
								$version = 'none';
							}

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
									alt="<?php echo esc_attr($image['alt'] ?: 'Sticky section image'); ?>"
									loading="lazy">
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>