<?php
$subtitle   = get_sub_field('subtitle');
$title      = get_sub_field('title');
$items      = get_sub_field('items');
$background = get_sub_field('background');
$spacing    = get_sub_field('spacing');

if (empty($subtitle) && empty($title) && empty($items)) {
	return;
}

$background = !empty($background) ? $background : 'yellow';
$spacing    = !empty($spacing) ? $spacing : 'all-spacing';
?>

<section id="team-showcase" class="team-showcase team-showcase--<?php echo esc_attr($background); ?> team-showcase--<?php echo esc_attr($spacing); ?>">
	<div class="team-showcase__container">

		<?php if (!empty($subtitle) || !empty($title)) : ?>
			<div class="team-showcase__head" data-aos="fade-up">
				<?php if (!empty($subtitle)) : ?>
					<p class="team-showcase__subtitle">
						<?php echo esc_html($subtitle); ?>
					</p>
				<?php endif; ?>

				<?php if (!empty($title)) : ?>
					<h2 class="team-showcase__title main-title-h4">
						<?php echo wp_kses_post($title); ?>
					</h2>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if (!empty($items) && is_array($items)) : ?>

<div class="team-showcase__desktop" data-aos="fade-up">
	<div class="team-showcase__images swiper js-team-showcase-images-swiper">
		<div class="swiper-wrapper">
			<?php foreach ($items as $item) :
				$image = $item['image'] ?? null;
				if (empty($image)) continue;
			?>
				<div class="swiper-slide team-showcase__image-slide">
					<div class="team-showcase__image-slide-inner">
						<div class="team-showcase__image-wrap">
							<img
								class="team-showcase__image"
								src="<?php echo esc_url($image['url']); ?>"
								alt="<?php echo esc_attr($image['alt'] ?: 'Team member'); ?>"
								loading="lazy"
							>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="team-showcase__content-area">
		<div class="team-showcase__content-area-wrapper">
			<div class="team-showcase__content swiper js-team-showcase-content-swiper">
				<div class="swiper-wrapper">
					<?php foreach ($items as $item) :
						$name = $item['name'] ?? '';
						$job  = $item['job'] ?? '';
						$text = $item['text'] ?? '';
						$link = $item['link'] ?? null;
					?>
						<div class="swiper-slide team-showcase__content-slide">
							<div class="team-showcase__content-inner">
								<?php if (!empty($name)) : ?>
									<h3 class="team-showcase__name main-title-h5"><?php echo esc_html($name); ?></h3>
								<?php endif; ?>

								<?php if (!empty($job)) : ?>
									<p class="team-showcase__job"><?php echo esc_html($job); ?></p>
								<?php endif; ?>

								<?php if (!empty($text)) : ?>
									<p class="team-showcase__text"><?php echo esc_html($text); ?></p>
								<?php endif; ?>

								<?php if (!empty($link['url']) && !empty($link['title'])) : ?>
									<a
										class="team-showcase__link main-link"
										href="<?php echo esc_url($link['url']); ?>"
										<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
									>
										<?php echo esc_html($link['title']); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="team-showcase__nav">
				<button class="team-showcase__arrow team-showcase__arrow--prev" type="button" aria-label="Previous slide">
					<svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
						<path d="M5.5 10.5L0.5 5.5L5.5 0.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M25.5 5.5L0.5 5.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</button>
				<button class="team-showcase__arrow team-showcase__arrow--next" type="button" aria-label="Next slide">
					<svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
						<path d="M20.5 0.5L25.5 5.5L20.5 10.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M0.5 5.5H25.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</button>
			</div>
		</div>
	</div>
</div>

			<div class="team-showcase__mobile" data-aos="fade-right">
				<div class="team-showcase__mobile-slider js-team-mobile-slick">
					<?php foreach ($items as $item) :
						$image = $item['image'] ?? null;
						$name  = $item['name'] ?? '';
						$job   = $item['job'] ?? '';
						$text  = $item['text'] ?? '';
						$link  = $item['link'] ?? null;
						?>
						<div class="team-showcase__mobile-slide">
							<?php if (!empty($image)) : ?>
								<div class="team-showcase__mobile-image-wrap">
									<img
										class="team-showcase__mobile-image"
										src="<?php echo esc_url($image['url']); ?>"
										alt="<?php echo esc_attr($image['alt'] ?: 'Team member'); ?>"
										loading="lazy"
									>
								</div>
							<?php endif; ?>

							<div class="team-showcase__mobile-content">
								<?php if (!empty($name)) : ?>
									<h3 class="team-showcase__name main-title-h5"><?php echo esc_html($name); ?></h3>
								<?php endif; ?>

								<?php if (!empty($job)) : ?>
									<p class="team-showcase__job"><?php echo esc_html($job); ?></p>
								<?php endif; ?>

								<?php if (!empty($text)) : ?>
									<p class="team-showcase__text"><?php echo esc_html($text); ?></p>
								<?php endif; ?>

								<?php if (!empty($link['url']) && !empty($link['title'])) : ?>
									<a
										class="team-showcase__link main-link"
										href="<?php echo esc_url($link['url']); ?>"
										<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
									>
										<?php echo esc_html($link['title']); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="team-showcase__nav team-showcase__nav--mobile">
					<button class="team-showcase__arrow team-showcase__arrow--mobile-prev" type="button" aria-label="Previous slide">
						<svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
							<path d="M5.5 10.5L0.5 5.5L5.5 0.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M25.5 5.5L0.5 5.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
					<button class="team-showcase__arrow team-showcase__arrow--mobile-next" type="button" aria-label="Next slide">
						<svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
							<path d="M20.5 0.5L25.5 5.5L20.5 10.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M0.5 5.5H25.5" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
				</div>
			</div>

		<?php endif; ?>
	</div>
</section>

<script>
(function () {
  function loadSwiper(cb) {
    if (window.Swiper) return cb();

    var s = document.createElement('script');
    s.src = 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js';
    s.async = true;
    s.onload = cb;
    document.head.appendChild(s);
  }

  function raf2(fn) {
    requestAnimationFrame(function () {
      requestAnimationFrame(fn);
    });
  }

  function initTeamShowcase(section) {
    if (!section || section.dataset.teamSwiperInit === '1') return;
    section.dataset.teamSwiperInit = '1';

    var desktop = window.innerWidth > 767;
    var imagesEl = section.querySelector('.js-team-showcase-images-swiper');
    var contentEl = section.querySelector('.js-team-showcase-content-swiper');
    var mobileEl = section.querySelector('.js-team-mobile-slick');

    if (desktop && imagesEl && contentEl) {
      var BASE_W = 230;
      var NEAR_W = 352;
      var FAR_W = 278;
      var ACTIVE_W = 470;
      var GAP = 48;
      var INITIAL = 2;

      var prevBtn = section.querySelector('.team-showcase__arrow--prev');
      var nextBtn = section.querySelector('.team-showcase__arrow--next');

      function setBtn(btn, disabled) {
        if (!btn) return;
        btn.disabled = !!disabled;
        btn.classList.toggle('is-disabled', !!disabled);
        btn.setAttribute('aria-disabled', disabled ? 'true' : 'false');
      }

      function setWidths(swiper, activeIndex) {
        if (!swiper || swiper.destroyed) return;

        swiper.slides.forEach(function (slide, index) {
          var width = BASE_W;

          if (index === activeIndex) {
            width = ACTIVE_W;
          } else if (index === activeIndex - 1 || index === activeIndex + 1) {
            width = NEAR_W;
          } else if (index === activeIndex - 2 || index === activeIndex + 2) {
            width = FAR_W;
          }

          slide.style.width = width + 'px';
          slide.classList.toggle('is-active', index === activeIndex);
          slide.classList.toggle('is-near', index === activeIndex - 1 || index === activeIndex + 1);
          slide.classList.toggle('is-far', index === activeIndex - 2 || index === activeIndex + 2);
        });
      }

      function ensureOffsets(swiper) {
        if (!swiper || swiper.destroyed) return;

        var viewport = swiper.size || 0;
        var sideSpace = Math.max(0, (viewport - ACTIVE_W) / 2);

        swiper.params.slidesOffsetBefore = Math.ceil(sideSpace);
        swiper.params.slidesOffsetAfter = Math.ceil(sideSpace);
      }

      function hardUpdate(swiper) {
        if (!swiper || swiper.destroyed) return;
        swiper.updateSize();
        swiper.updateSlides();
        if (typeof swiper.updateSlidesOffset === 'function') swiper.updateSlidesOffset();
        swiper.updateProgress();
      }

      function snap(swiper) {
        if (!swiper || swiper.destroyed) return;
        swiper.slideTo(swiper.activeIndex, 0, false);
      }

      function updateNav(swiper) {
        if (!swiper || swiper.destroyed) return;

        var total = swiper.slides && swiper.slides.length ? swiper.slides.length : 0;
        var lastIndex = Math.max(0, total - 1);
        var locked = !!swiper.isLocked;

        setBtn(prevBtn, locked || swiper.activeIndex <= 0);
        setBtn(nextBtn, locked || swiper.activeIndex >= lastIndex);
      }

      function prepareAndGo(swiper, contentSwiper, dir) {
        if (!swiper || swiper.destroyed) return;

        var total = swiper.slides && swiper.slides.length ? swiper.slides.length : 0;
        var lastIndex = Math.max(0, total - 1);

        if (swiper.isLocked || total <= 1) {
          updateNav(swiper);
          return;
        }

        var current = swiper.activeIndex;
        var target = dir === 'next' ? Math.min(current + 1, lastIndex) : Math.max(current - 1, 0);

        if (target === current) {
          updateNav(swiper);
          return;
        }

        setWidths(swiper, target);
        ensureOffsets(swiper);
        hardUpdate(swiper);

        swiper.slideTo(target, swiper.params.speed, false);
        contentSwiper.slideTo(target, contentSwiper.params.speed, false);

        raf2(function () {
          setWidths(swiper, swiper.activeIndex);
          ensureOffsets(swiper);
          hardUpdate(swiper);
          snap(swiper);
          updateNav(swiper);

          raf2(function () {
            ensureOffsets(swiper);
            hardUpdate(swiper);
            updateNav(swiper);
          });
        });
      }

      if (imagesEl.swiper && typeof imagesEl.swiper.destroy === 'function') {
        try { imagesEl.swiper.destroy(true, true); } catch (e) {}
      }

      if (contentEl.swiper && typeof contentEl.swiper.destroy === 'function') {
        try { contentEl.swiper.destroy(true, true); } catch (e) {}
      }

      var contentSwiper = new Swiper(contentEl, {
        slidesPerView: 1,
        allowTouchMove: false,
        autoHeight: true,
        speed: 250,
        effect: 'fade',
        fadeEffect: {
          crossFade: true
        },
        initialSlide: INITIAL
      });

      var imagesSwiper = new Swiper(imagesEl, {
        slidesPerView: 'auto',
        spaceBetween: GAP,
        speed: 420,
        loop: false,
        autoHeight: false,
        watchOverflow: true,
        roundLengths: true,
        centeredSlides: false,
        slidesOffsetBefore: 0,
        slidesOffsetAfter: 0,
        observer: true,
        observeParents: true,
        allowTouchMove: true,
        simulateTouch: false,
        touchStartPreventDefault: false,
        touchMoveStopPropagation: true,
        mousewheel: false,
        keyboard: false,
        slideToClickedSlide: false,
        initialSlide: INITIAL,

        on: {
          init: function () {
            ensureOffsets(this);
            setWidths(this, this.activeIndex);
            hardUpdate(this);
            snap(this);
            updateNav(this);
          },
          slideChange: function () {
            setWidths(this, this.activeIndex);
            ensureOffsets(this);
            updateNav(this);
          },
          transitionEnd: function () {
            setWidths(this, this.activeIndex);
            ensureOffsets(this);
            hardUpdate(this);
            snap(this);
            updateNav(this);
          }
        }
      });

      if (prevBtn) {
        prevBtn.addEventListener('click', function (e) {
          e.preventDefault();
          prepareAndGo(imagesSwiper, contentSwiper, 'prev');
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', function (e) {
          e.preventDefault();
          prepareAndGo(imagesSwiper, contentSwiper, 'next');
        });
      }

      imagesEl.querySelectorAll('img').forEach(function (img) {
        if (img.complete) return;
        img.addEventListener('load', function () {
          ensureOffsets(imagesSwiper);
          setWidths(imagesSwiper, imagesSwiper.activeIndex);
          hardUpdate(imagesSwiper);
          snap(imagesSwiper);
          updateNav(imagesSwiper);
        });
      });

      window.addEventListener('resize', function () {
        if (window.innerWidth <= 767) return;
        ensureOffsets(imagesSwiper);
        setWidths(imagesSwiper, imagesSwiper.activeIndex);
        hardUpdate(imagesSwiper);
        snap(imagesSwiper);
        contentSwiper.updateAutoHeight(0);
        updateNav(imagesSwiper);
      }, { passive: true });
    }

    if (!desktop && window.jQuery && mobileEl && !window.jQuery(mobileEl).hasClass('slick-initialized')) {
      var $ = window.jQuery;

      $(mobileEl).slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        arrows: true,
        prevArrow: $(section).find('.team-showcase__arrow--mobile-prev'),
        nextArrow: $(section).find('.team-showcase__arrow--mobile-next'),
        speed: 500
      });
    }
  }

  function initAllTeamShowcase() {
    document.querySelectorAll('.team-showcase').forEach(function (section) {
      initTeamShowcase(section);
    });
  }

  loadSwiper(initAllTeamShowcase);

  document.addEventListener('shopify:section:load', function () {
    initAllTeamShowcase();
  });
})();
</script>