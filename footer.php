<?php

/**
 * The template for displaying the footer
 *
 * @package cor-domi
 */

$instagram_title = get_field('instagram_title', 'footer_options');
$instagram_link = get_field('instagram_link', 'footer_options');
$instagram_images = get_field('instagram_images', 'footer_options');

$footer_explore_title = get_field('footer_explore_title', 'footer_options');
$footer_explore_links = get_field('footer_explore_links', 'footer_options');

$footer_contact_title = get_field('footer_contact_title', 'footer_options');
$footer_contact_links = get_field('footer_contact_links', 'footer_options');

$footer_info_subtitle = get_field('footer_info_subtitle', 'footer_options');
$footer_info_text = get_field('footer_info_text', 'footer_options');
$footer_info_link_1 = get_field('footer_info_link_1', 'footer_options');
$footer_info_link_2 = get_field('footer_info_link_2', 'footer_options');

$footer_partner_links = get_field('footer_partner_links', 'footer_options');

$footer_bottom_link_1 = get_field('footer_bottom_link_1', 'footer_options');
$footer_bottom_link_2 = get_field('footer_bottom_link_2', 'footer_options');
$footer_copyright = get_field('footer_copyright', 'footer_options');
?>

<footer id="colophon" class="site-footer" data-theme="dark">
	<div class="site-footer__inner"  data-aos="fade-up" data-aos-offset="200">

		<?php if (!empty($instagram_title) || !empty($instagram_link) || !empty($instagram_images)) : ?>
			<div class="site-footer__top">
				<div class="site-footer__top-head">
					<?php if (!empty($instagram_title)) : ?>
						<h2 class="site-footer__title main-title-h3">
							<?php echo wp_kses_post($instagram_title); ?>
						</h2>
					<?php endif; ?>

					<?php if (!empty($instagram_link['url']) && !empty($instagram_link['title'])) : ?>
						<a
							class="site-footer__social-link"
							href="<?php echo esc_url($instagram_link['url']); ?>"
							<?php echo !empty($instagram_link['target']) ? 'target="' . esc_attr($instagram_link['target']) . '"' : ''; ?>>
							<?php echo esc_html($instagram_link['title']); ?>
						</a>
					<?php endif; ?>
				</div>

				<?php if (!empty($instagram_images)) : ?>
					<div class="site-footer__slider swiper js-footer-slider">
						<div class="swiper-wrapper">
							<?php foreach ($instagram_images as $item) :
								$image = $item['image'] ?? null;
								$link = $item['link'] ?? null;

								if (empty($image)) {
									continue;
								}
							?>
								<div class="swiper-slide site-footer__slide">
									<?php if (!empty($link['url'])) : ?>
										<a
											class="site-footer__slide-link"
											href="<?php echo esc_url($link['url']); ?>"
											<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
											<img
												class="site-footer__slide-image"
												src="<?php echo esc_url($image['url']); ?>"
												alt="<?php echo esc_attr($image['alt'] ?: 'Footer image'); ?>"
												loading="lazy">
										</a>
									<?php else : ?>
										<div class="site-footer__slide-link">
											<img
												class="site-footer__slide-image"
												src="<?php echo esc_url($image['url']); ?>"
												alt="<?php echo esc_attr($image['alt'] ?: 'Footer image'); ?>"
												loading="lazy">
										</div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="site-footer__bottom">
			<div class="site-footer__columns">
				<div class="site-footer__menus site-footer__menus--desktop">
					<div class="site-footer__menu-col">
						<?php if (!empty($footer_explore_title)) : ?>
							<h3 class="site-footer__menu-title"><?php echo esc_html($footer_explore_title); ?></h3>
						<?php endif; ?>

						<?php if (!empty($footer_explore_links)) : ?>
							<ul class="site-footer__menu-list">
								<?php foreach ($footer_explore_links as $item) :
									$link = $item['link'] ?? null;
									if (empty($link['title'])) {
										continue;
									}
								?>
									<li class="site-footer__menu-item">
										<?php if (!empty($link['url'])) : ?>
											<a
												href="<?php echo esc_url($link['url']); ?>"
												<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
												<?php echo esc_html($link['title']); ?>
											</a>
										<?php else : ?>
											<span><?php echo esc_html($link['title']); ?></span>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>

					<div class="site-footer__menu-col">
						<?php if (!empty($footer_contact_title)) : ?>
							<h3 class="site-footer__menu-title"><?php echo esc_html($footer_contact_title); ?></h3>
						<?php endif; ?>

						<?php if (!empty($footer_contact_links)) : ?>
							<ul class="site-footer__menu-list">
								<?php foreach ($footer_contact_links as $item) :
									$link = $item['link'] ?? null;
									if (empty($link['title'])) {
										continue;
									}

									$url = $link['url'] ?? '';
									$is_hash_text = !empty($url) && strpos($url, '#') !== false;
								?>
									<li class="site-footer__menu-item">
										<?php if (!$is_hash_text && !empty($url)) : ?>
											<a
												href="<?php echo esc_url($url); ?>"
												<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
												<?php echo esc_html($link['title']); ?>
											</a>
										<?php else : ?>
											<span><?php echo esc_html($link['title']); ?></span>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>

				<div class="site-footer__menus-mobile">
					<?php if (!empty($footer_explore_links) || !empty($footer_explore_title)) : ?>
						<div class="site-footer__accordion-item main-accordion-item">
							<button
								class="site-footer__accordion-button main-accordion-button"
								type="button"
								aria-expanded="false">
								<span class="site-footer__accordion-title">
									<?php echo esc_html($footer_explore_title ?: 'Explore'); ?>
								</span>
								<svg xmlns="http://www.w3.org/2000/svg" class="site-footer__accordion-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M5 12H19" stroke="#F4EEE7" stroke-linecap="round" stroke-linejoin="round" />
									<path d="M12 5V19" stroke="#F4EEE7" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
							</button>

							<div class="site-footer__accordion-content">
								<div class="site-footer__accordion-inner">
									<?php if (!empty($footer_explore_links)) : ?>
										<ul class="site-footer__menu-list">
											<?php foreach ($footer_explore_links as $item) :
												$link = $item['link'] ?? null;
												if (empty($link['title'])) {
													continue;
												}
											?>
												<li class="site-footer__menu-item">
													<?php if (!empty($link['url'])) : ?>
														<a
															href="<?php echo esc_url($link['url']); ?>"
															<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
															<?php echo esc_html($link['title']); ?>
														</a>
													<?php else : ?>
														<span><?php echo esc_html($link['title']); ?></span>
													<?php endif; ?>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if (!empty($footer_contact_links) || !empty($footer_contact_title)) : ?>
						<div class="site-footer__accordion-item main-accordion-item">
							<button
								class="site-footer__accordion-button main-accordion-button"
								type="button"
								aria-expanded="false">
								<span class="site-footer__accordion-title">
									<?php echo esc_html($footer_contact_title ?: 'Contact'); ?>
								</span>
								<svg xmlns="http://www.w3.org/2000/svg" class="site-footer__accordion-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M5 12H19" stroke="#F4EEE7" stroke-linecap="round" stroke-linejoin="round" />
									<path d="M12 5V19" stroke="#F4EEE7" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
							</button>

							<div class="site-footer__accordion-content">
								<div class="site-footer__accordion-inner">
									<?php if (!empty($footer_contact_links)) : ?>
										<ul class="site-footer__menu-list">
											<?php foreach ($footer_contact_links as $item) :
												$link = $item['link'] ?? null;
												if (empty($link['title'])) {
													continue;
												}

												$url = $link['url'] ?? '';
												$is_hash_text = !empty($url) && strpos($url, '#') !== false;
											?>
												<li class="site-footer__menu-item">
													<?php if (!$is_hash_text && !empty($url)) : ?>
														<a
															href="<?php echo esc_url($url); ?>"
															<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
															<?php echo esc_html($link['title']); ?>
														</a>
													<?php else : ?>
														<span><?php echo esc_html($link['title']); ?></span>
													<?php endif; ?>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<div class="site-footer__info">
					<?php if (!empty($footer_info_subtitle)) : ?>
						<h3 class="site-footer__info-subtitle"><?php echo esc_html($footer_info_subtitle); ?></h3>
					<?php endif; ?>

					<?php if (!empty($footer_info_text)) : ?>
						<div class="site-footer__info-text">
							<?php echo wp_kses_post($footer_info_text); ?>
						</div>
					<?php endif; ?>

					<div class="site-footer__info-links">
						<?php if (!empty($footer_info_link_1['url']) && !empty($footer_info_link_1['title'])) : ?>
							<a
								class="main-link"
								href="<?php echo esc_url($footer_info_link_1['url']); ?>"
								<?php echo !empty($footer_info_link_1['target']) ? 'target="' . esc_attr($footer_info_link_1['target']) . '"' : ''; ?>>
								<?php echo esc_html($footer_info_link_1['title']); ?>
							</a>
						<?php endif; ?>

						<?php if (!empty($footer_info_link_2['url']) && !empty($footer_info_link_2['title'])) : ?>
							<a
								class="main-link"
								href="<?php echo esc_url($footer_info_link_2['url']); ?>"
								<?php echo !empty($footer_info_link_2['target']) ? 'target="' . esc_attr($footer_info_link_2['target']) . '"' : ''; ?>>
								<?php echo esc_html($footer_info_link_2['title']); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="site-footer__bottom-row">
				<div class="site-footer__partners" >
					<?php if (!empty($footer_partner_links)) : ?>
						<?php foreach ($footer_partner_links as $item) :
							$image = $item['image'] ?? null;
							$link = $item['link'] ?? null;

							if (empty($image)) {
								continue;
							}
						?>
							<?php if (!empty($link['url'])) : ?>
								<a
									class="site-footer__partner"
									href="<?php echo esc_url($link['url']); ?>"
									<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Partner logo'); ?>" loading="lazy">
								</a>
							<?php else : ?>
								<div class="site-footer__partner">
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Partner logo'); ?>" loading="lazy">
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

				<div class="site-footer__legal">
					<?php if (!empty($footer_bottom_link_1['url']) && !empty($footer_bottom_link_1['title'])) : ?>
						<a
							href="<?php echo esc_url($footer_bottom_link_1['url']); ?>"
							<?php echo !empty($footer_bottom_link_1['target']) ? 'target="' . esc_attr($footer_bottom_link_1['target']) . '"' : ''; ?>>
							<?php echo esc_html($footer_bottom_link_1['title']); ?>
						</a>
						<span>
							—
						</span>
					<?php endif; ?>
					<?php if (!empty($footer_bottom_link_2['url']) && !empty($footer_bottom_link_2['title'])) : ?>
						<a
							href="<?php echo esc_url($footer_bottom_link_2['url']); ?>"
							<?php echo !empty($footer_bottom_link_2['target']) ? 'target="' . esc_attr($footer_bottom_link_2['target']) . '"' : ''; ?>>
							<?php echo esc_html($footer_bottom_link_2['title']); ?>
						</a>
						<span>
							—
						</span>
					<?php endif; ?>

					<?php if (!empty($footer_copyright)) : ?>
						<span><?php echo esc_html($footer_copyright); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const sliders = document.querySelectorAll('.js-footer-slider');
		if (!sliders.length || typeof Swiper === 'undefined') return;

		sliders.forEach((slider) => {
			new Swiper(slider, {
				slidesPerView: 2.2,
				spaceBetween: 19,
				speed: 700,
				loop: true,
				autoplay: {
					delay: 1000,
				},
				breakpoints: {
					768: {
						slidesPerView: 3.8,
						spaceBetween: 24,
					}
				}
			});
		});
	});
</script>

</body>

</html>