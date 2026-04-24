<?php
$subtitle = get_sub_field('subtitle');
$title = get_sub_field('title');
$image = get_sub_field('image');

$fallback_subtitle = get_the_title();
$fallback_image_id = get_post_thumbnail_id();

$display_subtitle = $subtitle ? $subtitle : $fallback_subtitle;
$display_image_id = !empty($image['ID']) ? $image['ID'] : $fallback_image_id;

$has_content = $display_subtitle || $title || $display_image_id;
?>

<?php if ($has_content): ?>
<section class="service-hero">
  <div class="service-hero__header article-hero__header">
    <?php if ($display_subtitle): ?>
      <p class="service-hero__subtitle" data-aos="fade-right">
        <?php echo esc_html($display_subtitle); ?>
      </p>
    <?php endif; ?>

    <?php if ($title): ?>
      <h1 class="article-hero__title main-title-h6" data-aos="fade-left">
        <?php echo wp_kses_post($title); ?>
      </h1>
    <?php endif; ?>
  </div>

  <?php if ($display_image_id): ?>
    <div class="service-hero__media" data-aos="fade-up" data-aos-duration="1000">
      <?php
      echo wp_get_attachment_image(
        $display_image_id,
        'full',
        false,
        array(
          'class' => 'service-hero__image',
          'loading' => 'lazy',
          'decoding' => 'async',
          'alt' => get_post_meta($display_image_id, '_wp_attachment_image_alt', true)
        )
      );
      ?>
    </div>
  <?php endif; ?>
</section>
<?php endif; ?>