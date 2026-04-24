<?php
$spacing  = get_sub_field('spacing') ?: 'all-spacing';
$subtitle = get_sub_field('subtitle');
$title    = get_sub_field('title');
$post_obj = get_sub_field('post');

$post_id = 0;

if ($post_obj instanceof WP_Post) {
	$post_id = $post_obj->ID;
} elseif (is_numeric($post_obj)) {
	$post_id = (int) $post_obj;
}

$post_title    = $post_id ? get_the_title($post_id) : '';
$post_location = $post_id ? get_field('location', $post_id) : '';
$image_id      = $post_id ? get_post_thumbnail_id($post_id) : 0;
$post_url      = $post_id ? get_permalink($post_id) : '';
?>

<?php if ($subtitle || $title || $post_id): ?>
<section class="service-hero project-hero <?php echo esc_attr($spacing); ?>">
	<div class="service-hero__header">
		<?php if ($subtitle): ?>
			<p class="service-hero__subtitle" data-aos="fade-right">
				<?php echo esc_html($subtitle); ?>
			</p>
		<?php endif; ?>

		<?php if ($title): ?>
			<h1 class="service-hero__title main-title-h4" data-aos="fade-left">
				<?php echo wp_kses_post($title); ?>
			</h1>
		<?php endif; ?>
	</div>
    <div class="project-hero-card">
	<?php if ($image_id): ?>
		<div class="service-hero__media" data-aos="fade-up" data-aos-duration="1000">
			<?php if ($post_url): ?>
				<a href="<?php echo esc_url($post_url); ?>" class="project-hero__image-link" aria-label="<?php echo esc_attr($post_title ?: 'Open project'); ?>">
			<?php endif; ?>

			<?php
			echo wp_get_attachment_image(
				$image_id,
				'full',
				false,
				array(
					'class'    => 'service-hero__image',
					'loading'  => 'lazy',
					'decoding' => 'async',
					'alt'      => get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: $post_title
				)
			);
			?>

			<?php if ($post_url): ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ($post_title || $post_location): ?>
		<div class="project-hero__meta" data-aos="fade-up" data-aos-duration="1100">
			<?php if ($post_url): ?>
				<a href="<?php echo esc_url($post_url); ?>" class="project-hero__meta-link">
			<?php endif; ?>

			<?php if ($post_title): ?>
				<h3 class="project-hero__name">
					<?php echo esc_html($post_title); ?>
				</h3>
			<?php endif; ?>

			<?php if ($post_location): ?>
				<p class="project-hero__location">
					<?php echo esc_html($post_location); ?>
				</p>
			<?php endif; ?>

			<?php if ($post_url): ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
    </div>
</section>
<?php endif; ?>