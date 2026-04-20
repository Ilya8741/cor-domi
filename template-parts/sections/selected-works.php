<?php
$title = get_sub_field('title');
$posts_selected = get_sub_field('posts_selected');

if (empty($title) && empty($posts_selected)) {
    return;
}
?>

<section class="selected-works-section">
    <div class="selected-works-section__container">
        <?php if (!empty($title)) : ?>
            <div class="selected-works-section__header" data-aos="fade-left">
                <h2 class="selected-works-section__title main-title-h3">
                    <?php echo wp_kses_post($title); ?>
                </h2>
            </div>
        <?php endif; ?>

        <?php if (!empty($posts_selected) && is_array($posts_selected)) : ?>
   <div class="selected-works-slider-wrap js-selected-works-slider-wrap">
    <div class="selected-works-slider swiper js-selected-works-slider">
        <div class="swiper-wrapper">
            <?php foreach ($posts_selected as $post_item) : ?>
                <?php
                $post_id = is_object($post_item) ? $post_item->ID : $post_item;
                $post_title = get_the_title($post_id);
                $post_excerpt = get_the_excerpt($post_id);
                $post_link = get_permalink($post_id);
                $post_image = get_the_post_thumbnail_url($post_id, 'large');
                ?>
                <div class="swiper-slide selected-works-slide">
                    <div class="selected-works-slide__inner" data-aos="fade-right">
                        <a href="<?php echo esc_url($post_link); ?>">
                            <div class="selected-works-slide__image-wrap">
                                <?php if (!empty($post_image)) : ?>
                                    <img
                                        class="selected-works-slide__image"
                                        src="<?php echo esc_url($post_image); ?>"
                                        alt="<?php echo esc_attr($post_title); ?>"
                                        loading="lazy">
                                <?php endif; ?>
                            </div>
                        </a>
                        <div class="selected-works-slide__content">
                            <?php if (!empty($post_title)) : ?>
                                <h3 class="selected-works-slide__title">
                                    <?php echo esc_html($post_title); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if (!empty($post_excerpt)) : ?>
                                <p class="selected-works-slide__excerpt">
                                    <?php echo esc_html($post_excerpt); ?>
                                </p>
                            <?php endif; ?>

                            <a class="selected-works-slide__link main-link" href="<?php echo esc_url($post_link); ?>">
                                View project
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="selected-works-section__nav js-selected-works-nav">
        <button class="selected-works-section__arrow selected-works-section__arrow--prev" type="button" aria-label="Previous slide">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
                <path d="M5.5 10.5L0.5 5.5L5.5 0.5" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M25.5 5.5L0.5 5.5" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <button class="selected-works-section__arrow selected-works-section__arrow--next" type="button" aria-label="Next slide">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
                <path d="M20.5 0.5L25.5 5.5L20.5 10.5" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M0.5 5.5H25.5" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
</div>
        <?php endif; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const sliders = document.querySelectorAll('.js-selected-works-slider');
  if (!sliders.length || typeof Swiper === 'undefined') return;

  sliders.forEach((slider) => {
    const wrap = slider.closest('.js-selected-works-slider-wrap');
    const nav = wrap.querySelector('.js-selected-works-nav');
    const prevBtn = wrap.querySelector('.selected-works-section__arrow--prev');
    const nextBtn = wrap.querySelector('.selected-works-section__arrow--next');

    const updateNavPosition = () => {
      if (!nav) return;

      if (window.innerWidth <= 767) {
        nav.style.top = '';
        return;
      }

      const activeSlide = wrap.querySelector('.swiper-slide-active');
      if (!activeSlide) return;

      const imageWrap = activeSlide.querySelector('.selected-works-slide__image-wrap');
      if (!imageWrap) return;

      const imageHeight = imageWrap.offsetHeight;
      nav.style.top = `${imageHeight + 32}px`;
    };

    const swiper = new Swiper(slider, {
      slidesPerView: 1.08,
      spaceBetween: 16,
      speed: 700,
      loop: true,
      navigation: {
        prevEl: prevBtn,
        nextEl: nextBtn,
      },
      breakpoints: {
        768: {
          slidesPerView: 1.6,
          spaceBetween: 32,
        }
      },
      on: {
        init() {
          updateNavPosition();
        },
        resize() {
          updateNavPosition();
        },
        slideChangeTransitionEnd() {
          updateNavPosition();
        }
      }
    });

    window.addEventListener('resize', updateNavPosition);
    window.addEventListener('load', updateNavPosition);

    if (document.fonts && document.fonts.ready) {
      document.fonts.ready.then(updateNavPosition);
    }

    const images = wrap.querySelectorAll('.selected-works-slide__image');
    images.forEach((img) => {
      if (!img.complete) {
        img.addEventListener('load', updateNavPosition);
      }
    });
  });
});
</script>