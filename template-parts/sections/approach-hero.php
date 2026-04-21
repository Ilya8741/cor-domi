<?php
$image    = get_sub_field('image');
$subtitle = get_sub_field('subtitle');
$title    = get_sub_field('title');
$text     = get_sub_field('text');
$link     = get_sub_field('link');
$big_image = get_sub_field('big_image');

?>

<section class="approach-hero  <?php if ($big_image): ?> approach-hero--big-image<?php endif; ?>">
	<div class="approach-hero__container">
		<?php if ($image): ?>
			<div class="approach-hero__image-wrap">
				<?php echo wp_get_attachment_image($image['ID'], 'full', false, array(
					'class' => 'approach-hero__image',
					'alt'   => !empty($image['alt']) ? $image['alt'] : ''
				)); ?>
			</div>
		<?php endif; ?>

		<div class="approach-hero__content">
			<?php if ($subtitle): ?>
				<span class="approach-hero__subtitle">
					<?php echo esc_html($subtitle); ?>
				</span>
			<?php endif; ?>

			<?php if ($title): ?>
				<h1 class="main-title-h3 approach-hero__title">
					<?php echo wp_kses_post($title); ?>
				</h1>
			<?php endif; ?>
			<?php if ($big_image): ?> <div class="approach-hero__text-wrapper"><?php endif; ?>
			<?php if ($text): ?>
				<div class="approach-hero__text">
					<?php echo wp_kses_post($text); ?>
				</div>
			<?php endif; ?>
			<?php if ( $link ) : ?>
					<a class="main-link approach-hero__link"
						href="<?php echo esc_url( $link['url'] ); ?>"
						<?php echo ! empty( $link['target'] ) ? 'target="' . esc_attr( $link['target'] ) . '"' : ''; ?>>
						<?php echo esc_html( $link['title'] ); ?>
					</a>
				<?php endif; ?>
				<?php if ($big_image): ?> </div><?php endif; ?>
		</div>
	</div>
</section>