<?php
$image    = get_sub_field('image');
$subtitle = get_sub_field('subtitle');
$title    = get_sub_field('title');
$small_title = get_sub_field('small_title');
if ( ! $image && ! $subtitle && ! $title ) {
	return;
}
?>

<section class="about-hero <?php if ($small_title): ?> about-hero--small-title<?php endif; ?>" data-theme="dark" aria-label="<?php echo esc_attr( wp_strip_all_tags( $title ?: 'About hero section' ) ); ?>">
	<?php if ( $image ) : ?>
		<div class="about-hero__media">
			<?php
			echo wp_get_attachment_image(
				$image['ID'],
				'full',
				false,
				array(
					'class'   => 'about-hero__image',
					'loading' => 'eager',
					'alt'     => ! empty( $image['alt'] ) ? $image['alt'] : '',
				)
			);
			?>
		</div>
	<?php endif; ?>

	<div class="about-hero__overlay"></div>

	<div class="about-hero__container">
		<div class="about-hero__content" data-aos="fade-right">
			<?php if ( $subtitle ) : ?>
				<span class="about-hero__subtitle">
					<?php echo esc_html( $subtitle ); ?>
				</span>
			<?php endif; ?>

			<?php if ( $title ) : ?>
				<h1 class="main-title-h2 about-hero__title">
					<?php echo wp_kses_post( $title ); ?>
				</h1>
			<?php endif; ?>

			
		</div>
	</div>
</section>