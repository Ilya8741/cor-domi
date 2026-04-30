<section class="contact-page">
  <div class="contact-page-wrapper">
    <div class="contact-page-header">
      <span class="contact-page-subtitle" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
        <?php the_sub_field('title'); ?>
      </span>

      <h2 class="contact-page-title" data-aos="fade-left" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
        <?php the_sub_field('text'); ?> 
      </h2>

    </div>
    <?php if (have_rows('contact_buttons')): ?>
      <?php $duration = 500; ?>
      <div class="contact-buttons">
        <?php
        $i = 0;

        while (have_rows('contact_buttons')): the_row();
          $i++;

          $popup_title  = get_sub_field('popup_title');
          $contact_form = get_sub_field('contact_form', false, false);
          $card_title   = get_sub_field('card_title');
          $card_text    = get_sub_field('card_text');
          $card_image   = get_sub_field('card_image');
          $tpl_id       = 'contact-modal-' . $i;
        ?>

          <?php if ($popup_title): ?>
            <div class="contact-card"  data-aos="fade-right" data-aos-delay="100" data-aos-easing="ease-out" data-aos-duration="<?php echo esc_attr($duration); ?>">
              <?php if (!empty($card_image) && is_array($card_image)): ?>
                <button
                  type="button"
                  class="contact-card__image-wrapper"
                  data-modal="#<?php echo esc_attr($tpl_id); ?>"
                  aria-label="<?php echo esc_attr('Open ' . ($card_title ?: 'contact form')); ?>">
                  <img
                    src="<?php echo esc_url($card_image['url']); ?>"
                    alt="<?php echo esc_attr($card_image['alt'] ?: $card_title); ?>"
                    class="contact-card__image">
                </button>
              <?php endif; ?>

              <?php if ($card_title): ?>
                <h3 class="contact-card__title main-title-h5">
                  <?php echo esc_html($card_title); ?>
                </h3>
              <?php endif; ?>

              <?php if ($card_text): ?>
                <p class="contact-card__text">
                  <?php echo esc_html($card_text); ?>
                </p>
              <?php endif; ?>

              <button type="button" class="main-link contact-link" data-modal="#<?php echo esc_attr($tpl_id); ?>">
                <span>Enquire now</span>
              </button>
            </div>

            <div id="<?php echo esc_attr($tpl_id); ?>" class="team-modal-template contact-team-modal-template" hidden>
              <div class="team-modal__inner">
                <div class="team-modal__text">
                  <h3 class="team-modal__title main-title-h5">
                    <?php echo esc_html($popup_title); ?>
                  </h3>

                  <?php if ($contact_form): ?>
                    <div class="team-modal__content contact-team-modal__content">
                      <?php echo do_shortcode(shortcode_unautop($contact_form)); ?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php $duration += 200; ?>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

    <div class="team-modal" aria-hidden="true">
      <div class="team-modal__overlay" data-close></div>

      <div class="team-modal__dialog contact-team-modal__dialog" role="dialog" aria-modal="true" aria-label="Contact modal">
        <button class="team-modal__close" type="button" data-close aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M2.63672 16.3643L15.3646 3.63634" stroke="white" stroke-linejoin="round" />
            <path d="M2.63672 3.63574L15.3646 16.3637" stroke="white" stroke-linejoin="round" />
          </svg>
        </button>

        <div class="team-modal__mount contact-team-modal__mount"></div>
      </div>
    </div>

    <div class="contact-page-info">


      <div class="contact-page-info-block" data-aos="fade-right" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
        <?php $image1 = get_sub_field('image'); ?>

        <?php if (!empty($image1) && is_array($image1)): ?>
          <div class="contact-page-media-wrapper">
            <img
              src="<?php echo esc_url($image1['url']); ?>"
              class="contact-page-info-image"
              alt="<?php echo esc_attr($image1['alt'] ?: 'Contact image'); ?>">
          </div>
        <?php endif; ?>

        <?php if (have_rows('contact_info')): ?>
          <ul class="contact-hb-info__list">
            <?php while (have_rows('contact_info')): the_row(); ?>
              <?php
              $info_link = get_sub_field('link');

              if (empty($info_link) || empty($info_link['url'])) {
                continue;
              }

              $is_address = $info_link['url'] === '#';
              ?>

              <li class=" contact-page-hb-info__item <?php echo $is_address ? 'contact-page-hb-info__item-address' : ''; ?>">
                <?php if (!$is_address): ?>
                  <a
                    class="hb-info__link"
                    href="<?php echo esc_url($info_link['url']); ?>"
                    target="<?php echo esc_attr($info_link['target'] ?: '_self'); ?>">
                    <?php echo esc_html($info_link['title'] ?: ''); ?>
                  </a>
                <?php else: ?>
                  <p class="hb-info__link">
                    <?php echo esc_html($info_link['title'] ?: ''); ?>
                  </p>
                <?php endif; ?>
              </li>
            <?php endwhile; ?>
          </ul>
        <?php endif; ?>

        <?php
        $studio_title  = get_sub_field('studio_title');
        $studio_text   = get_sub_field('studio_text');
        $studio_button = get_sub_field('studio_button');
        ?>

        <?php if ($studio_title || $studio_text || $studio_button): ?>
          <div class="studio-block">
            <?php if ($studio_title): ?>
              <h3 class="studio-block__title">
                <?php echo esc_html($studio_title); ?>
              </h3>
            <?php endif; ?>

            <?php if ($studio_text): ?>
              <p class="studio-block__text">
                <?php echo esc_html($studio_text); ?>
              </p>
            <?php endif; ?>

            <button type="button" class="main-link studio-block__link" data-modal="#contact-modal-1">
              <?php echo esc_html($studio_button); ?>
            </button>
          </div>
        <?php endif; ?>
      </div>
      <?php $map = get_sub_field('map'); ?>

      <?php if (!empty($map) && is_array($map)): ?>
        <div class="contact-page-map-wrapper" data-aos="fade-left" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
          <img
            src="<?php echo esc_url($map['url']); ?>"
            class="contact-page-info-image"
            alt="<?php echo esc_attr($map['alt'] ?: 'Map'); ?>">
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>