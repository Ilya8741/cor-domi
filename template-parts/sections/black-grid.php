<?php
$spacing     = get_sub_field('spacing') ?: 'all-spacing';
$title       = get_sub_field('title');
$text        = get_sub_field('text');
$link        = get_sub_field('link');
$left_image  = get_sub_field('left_image');
$right_image = get_sub_field('right_image');

if ( ! $left_image && ! $right_image && ! $title && ! $text && ! $link ) {
	return;
}
?>

<section class="black-grid <?php echo esc_attr( $spacing ); ?>" data-theme="dark" data-aos="fade-up">
	<div class="black-grid__inner">
		<div class="black-grid__left">
			<?php if ( $left_image ) : ?>
				<?php
				echo wp_get_attachment_image(
					$left_image['ID'],
					'full',
					false,
					array(
						'class'   => 'black-grid__left-image',
						'loading' => 'lazy',
						'alt'     => ! empty( $left_image['alt'] ) ? $left_image['alt'] : '',
					)
				);
				?>
			<?php endif; ?>
		</div>

		<div class="black-grid__right">
			<?php if ( $right_image ) : ?>
				<div class="black-grid__right-image-wrap">
					<?php
					echo wp_get_attachment_image(
						$right_image['ID'],
						'full',
						false,
						array(
							'class'   => 'black-grid__right-image',
							'loading' => 'lazy',
							'alt'     => ! empty( $right_image['alt'] ) ? $right_image['alt'] : '',
						)
					);
					?>
				</div>
			<?php endif; ?>

			<div class="black-grid__content">
				<?php if ( $title ) : ?>
					<h2 class="main-title-h4 black-grid__title">
						<?php echo wp_kses_post( $title ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $text ) : ?>
					<div class="black-grid__text">
						<?php echo wp_kses_post( $text ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $link ) : ?>
					<a
						class="main-link black-grid__link"
						href="<?php echo esc_url( $link['url'] ); ?>"
						<?php echo ! empty( $link['target'] ) ? 'target="' . esc_attr( $link['target'] ) . '"' : ''; ?>
					>
						<?php echo esc_html( $link['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>