<?php
$hero_title = get_sub_field('hero_title');
$hero_image = get_sub_field('hero_image');
$hero_subtitle = get_sub_field('hero_subtitle');
$about_page = get_sub_field('about_page');

if ($hero_title || $hero_image): ?>
	<section data-theme="dark" class="hero-section <?php if ($about_page): ?> hero-section--about<?php endif; ?>">
		<?php if ($hero_image): ?>
			<div class="hero-section__media">
				<?php
				echo wp_get_attachment_image(
					$hero_image['ID'],
					'full',
					false,
					[
						'class'         => 'hero-section__image',
						'alt'           => esc_attr($hero_image['alt'] ?? ''),
						'loading'       => 'eager',
						'fetchpriority' => 'high',
					]
				);
				?>
				<div class="hero-section__overlay"></div>
			</div>
		<?php endif; ?>

		<div class="hero-section__content">
				<?php if ($hero_subtitle): ?>
				<span class="hero-section__subtitle">
					<?php echo wp_kses_post($hero_subtitle); ?>
				</span>
			<?php endif; ?>
			<?php if ($hero_title): ?>
				<h1 class="main-title-h1 hero-section__title">
					<?php echo wp_kses_post($hero_title); ?>
				</h1>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>