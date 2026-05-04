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

$real_items = [];

if (!empty($items) && is_array($items)) {
	$real_items = array_values(array_filter($items, function ($item) {
		return !empty($item['image']);
	}));
}

$real_count = count($real_items);

$loop_items = $real_count > 1
	? array_merge($real_items, $real_items, $real_items, $real_items, $real_items)
	: $real_items;
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

		<?php if (!empty($real_items)) : ?>

			<div class="team-showcase__desktop" data-aos="fade-up">
				<div class="team-showcase__images swiper js-team-showcase-images-swiper">
					<div class="swiper-wrapper">
						<?php foreach ($loop_items as $index => $item) :
							$image = $item['image'] ?? null;
							if (empty($image)) continue;

							$real_index = $real_count > 0 ? $index % $real_count : 0;
						?>
							<div class="swiper-slide team-showcase__image-slide" data-real-index="<?php echo esc_attr($real_index); ?>">
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
								<?php foreach ($real_items as $item) :
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
					<?php foreach ($real_items as $item) :
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

      var REAL_COUNT = contentEl.querySelectorAll('.swiper-slide').length;
      var IMAGE_COUNT = imagesEl.querySelectorAll('.swiper-slide').length;
      var LOOP_GROUPS = REAL_COUNT > 0 ? Math.floor(IMAGE_COUNT / REAL_COUNT) : 1;
      var MIDDLE_GROUP = Math.floor(LOOP_GROUPS / 2);

      var HAS_FAKE_LOOP = REAL_COUNT > 1 && LOOP_GROUPS >= 5;
      var INITIAL = HAS_FAKE_LOOP ? REAL_COUNT * MIDDLE_GROUP : 0;

      var prevBtn = section.querySelector('.team-showcase__arrow--prev');
      var nextBtn = section.querySelector('.team-showcase__arrow--next');

      var isAnimating = false;
      var isNormalizing = false;

      function setBtn(btn, disabled) {
        if (!btn) return;

        btn.disabled = !!disabled;
        btn.classList.toggle('is-disabled', !!disabled);
        btn.setAttribute('aria-disabled', disabled ? 'true' : 'false');
      }

      function getSlideRealIndex(swiper, index) {
        if (!swiper || !swiper.slides || !swiper.slides[index]) return 0;

        var slide = swiper.slides[index];
        var attr = slide.getAttribute('data-real-index');
        var realIndex = parseInt(attr, 10);

        return isNaN(realIndex) ? index : realIndex;
      }

      function getActiveRealIndex(swiper) {
        if (!swiper || swiper.destroyed) return 0;
        return getSlideRealIndex(swiper, swiper.activeIndex);
      }

      function setWidths(swiper, activeIndex) {
        if (!swiper || swiper.destroyed) return;

        swiper.slides.forEach(function (slide, index) {
          var width = BASE_W;
          var distance = Math.abs(index - activeIndex);

          if (distance === 0) {
            width = ACTIVE_W;
          } else if (distance === 1) {
            width = NEAR_W;
          } else if (distance === 2) {
            width = FAR_W;
          }

          slide.style.width = width + 'px';

          slide.classList.toggle('is-active', distance === 0);
          slide.classList.toggle('is-near', distance === 1);
          slide.classList.toggle('is-far', distance === 2);
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

        if (typeof swiper.updateSlidesOffset === 'function') {
          swiper.updateSlidesOffset();
        }

        swiper.updateProgress();
      }

      function snap(swiper) {
        if (!swiper || swiper.destroyed) return;
        swiper.slideTo(swiper.activeIndex, 0, false);
      }

      function updateContent(swiper, speed) {
        if (!contentSwiper || contentSwiper.destroyed) return;

        var realIndex = getActiveRealIndex(swiper);

        if (REAL_COUNT > 0 && realIndex >= REAL_COUNT) {
          realIndex = realIndex % REAL_COUNT;
        }

        contentSwiper.slideTo(realIndex, speed || 0, false);
      }

      function getMiddleIndexByRealIndex(realIndex) {
        if (!HAS_FAKE_LOOP) return realIndex;
        return REAL_COUNT * MIDDLE_GROUP + realIndex;
      }

      function normalizeLoopPosition(swiper) {
        if (!swiper || swiper.destroyed || !HAS_FAKE_LOOP || isNormalizing) return;

        var activeIndex = swiper.activeIndex;
        var firstSafeIndex = REAL_COUNT;
        var lastSafeIndex = REAL_COUNT * (LOOP_GROUPS - 1) - 1;

        if (activeIndex >= firstSafeIndex && activeIndex <= lastSafeIndex) {
          return;
        }

        var realIndex = getActiveRealIndex(swiper);
        var newIndex = getMiddleIndexByRealIndex(realIndex);

        if (newIndex === activeIndex) return;

        isNormalizing = true;

        swiper.setTransition(0);
        setWidths(swiper, newIndex);
        ensureOffsets(swiper);
        hardUpdate(swiper);
        swiper.slideTo(newIndex, 0, false);

        raf2(function () {
          setWidths(swiper, swiper.activeIndex);
          ensureOffsets(swiper);
          hardUpdate(swiper);
          snap(swiper);
          updateContent(swiper, 0);
          isNormalizing = false;
        });
      }

      function updateNav(swiper) {
        if (!swiper || swiper.destroyed) return;

        var total = swiper.slides && swiper.slides.length ? swiper.slides.length : 0;
        var locked = !!swiper.isLocked || total <= 1;

        setBtn(prevBtn, locked || isAnimating);
        setBtn(nextBtn, locked || isAnimating);
      }

      function prepareAndGo(swiper, contentSwiperInstance, dir) {
        if (!swiper || swiper.destroyed || isAnimating || isNormalizing) return;

        var total = swiper.slides && swiper.slides.length ? swiper.slides.length : 0;

        if (swiper.isLocked || total <= 1) {
          updateNav(swiper);
          return;
        }

        var current = swiper.activeIndex;
        var target;

        if (HAS_FAKE_LOOP) {
          target = dir === 'next' ? current + 1 : current - 1;
        } else {
          var lastIndex = Math.max(0, total - 1);

          if (dir === 'next') {
            target = current >= lastIndex ? 0 : current + 1;
          } else {
            target = current <= 0 ? lastIndex : current - 1;
          }
        }

        isAnimating = true;

        setWidths(swiper, target);
        ensureOffsets(swiper);
        hardUpdate(swiper);

        swiper.slideTo(target, swiper.params.speed, false);

        var targetRealIndex = getSlideRealIndex(swiper, target);

        if (REAL_COUNT > 0 && targetRealIndex >= REAL_COUNT) {
          targetRealIndex = targetRealIndex % REAL_COUNT;
        }

        if (contentSwiperInstance && !contentSwiperInstance.destroyed) {
          contentSwiperInstance.slideTo(targetRealIndex, contentSwiperInstance.params.speed, false);
        }

        updateNav(swiper);
      }

      if (imagesEl.swiper && typeof imagesEl.swiper.destroy === 'function') {
        try {
          imagesEl.swiper.destroy(true, true);
        } catch (e) {}
      }

      if (contentEl.swiper && typeof contentEl.swiper.destroy === 'function') {
        try {
          contentEl.swiper.destroy(true, true);
        } catch (e) {}
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
        initialSlide: 0
      });

      var imagesSwiper = new Swiper(imagesEl, {
        slidesPerView: 'auto',
        spaceBetween: GAP,
        speed: 520,
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
            updateContent(this, 0);
            updateNav(this);
          },

          slideChange: function () {
            if (isNormalizing) return;

            setWidths(this, this.activeIndex);
            ensureOffsets(this);
            updateContent(this, contentSwiper.params.speed);
            updateNav(this);
          },

          transitionEnd: function () {
            if (isNormalizing) return;

            normalizeLoopPosition(this);

            setWidths(this, this.activeIndex);
            ensureOffsets(this);
            hardUpdate(this);
            snap(this);
            updateContent(this, 0);

            isAnimating = false;
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
          updateContent(imagesSwiper, 0);
          updateNav(imagesSwiper);
        });
      });

      window.addEventListener('resize', function () {
        if (window.innerWidth <= 767) return;

        ensureOffsets(imagesSwiper);
        setWidths(imagesSwiper, imagesSwiper.activeIndex);
        hardUpdate(imagesSwiper);
        snap(imagesSwiper);
        updateContent(imagesSwiper, 0);

        if (contentSwiper && !contentSwiper.destroyed) {
          contentSwiper.updateAutoHeight(0);
        }

        updateNav(imagesSwiper);
      }, { passive: true });
    }

    if (!desktop && window.jQuery && mobileEl && !window.jQuery(mobileEl).hasClass('slick-initialized')) {
      var $ = window.jQuery;

      $(mobileEl).slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
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