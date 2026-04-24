<?php
    $subtitle = get_sub_field('subtitle');
    $title = get_sub_field('title');
    $image = get_sub_field('image');
?>

<?php if ($subtitle || $title || $image): ?>
<section class="service-hero">
  <div class="service-hero__header">
    <?php if ($subtitle): ?>
      <p class="service-hero__subtitle"  data-aos="fade-right">
        <?php echo esc_html($subtitle); ?>
      </p>
    <?php endif; ?>

    <?php if ($title): ?>
      <h1 class="service-hero__title main-title-h3"  data-aos="fade-left">
        <?php echo wp_kses_post($title); ?>
      </h1>
    <?php endif; ?>
  </div>

  <?php if ($image): ?>
    <div class="service-hero__media" data-aos="fade-up" data-aos-duration="1000">
      <?php
      echo wp_get_attachment_image(
        $image['ID'],
        'full',
        false,
        array(
          'class' => 'service-hero__image',
          'loading' => 'lazy',
          'decoding' => 'async',
          'alt' => !empty($image['alt']) ? $image['alt'] : ''
        )
      );
      ?>
    </div>
  <?php endif; ?>
</section>
<?php endif; ?>