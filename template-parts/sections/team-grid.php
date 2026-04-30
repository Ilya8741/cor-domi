<?php
$items = get_sub_field('items');

$items = is_array($items) ? $items : array();

if (empty($items)) {
    return;
}

$section_id = 'team-grid-' . uniqid();
?>

<section class="team-grid" id="<?php echo esc_attr($section_id); ?>">
    <div class="team-grid__container">

        <div class="team-grid__swiper swiper js-team-grid-swiper">
            <div class="team-grid__wrapper swiper-wrapper">
                <?php $duration = 500; ?>
                <?php foreach ($items as $item) : ?>
                    <?php
                    $image = isset($item['image']) ? $item['image'] : '';
                    $title = isset($item['title']) ? $item['title'] : '';
                    $name  = isset($item['name']) ? $item['name'] : '';

                    $image_id = is_array($image) ? $image['ID'] : $image;

                    if (empty($image_id) && empty($title) && empty($name)) {
                        continue;
                    }
                    ?>

                    <div class="team-grid__item swiper-slide">
                        <div class="team-grid__item-wrapper" data-aos="fade-right"
                            data-aos-duration="<?php echo esc_attr($duration); ?>">
                            <?php if (!empty($image_id)) : ?>
                                <div class="team-grid__image-wrapper">
                                    <?php
                                    echo wp_get_attachment_image(
                                        $image_id,
                                        'large',
                                        false,
                                        array(
                                            'class' => 'team-grid__image',
                                            'loading' => 'lazy',
                                        )
                                    );
                                    ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($title)) : ?>
                                <h3 class="team-grid__title">
                                    <?php echo wp_kses_post($title); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if (!empty($name)) : ?>
                                <p class="team-grid__name">
                                    <?php echo esc_html($name); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                    </div>
                    <?php $duration += 100; ?>
                <?php endforeach; ?>

            </div>
        </div>

        <div class="team-grid__nav js-team-grid-nav">
            <button class="team-grid__arrow selected-works-section__arrow team-grid__arrow--prev" type="button" aria-label="Previous slide">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
                    <path d="M5.5 10.5L0.5 5.5L5.5 0.5" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M25.5 5.5L0.5 5.5" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <button class="team-grid__arrow selected-works-section__arrow team-grid__arrow--next" type="button" aria-label="Next slide">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="11" viewBox="0 0 26 11" fill="none">
                    <path d="M20.5 0.5L25.5 5.5L20.5 10.5" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M0.5 5.5H25.5" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const section = document.getElementById('<?php echo esc_js($section_id); ?>');
        if (!section || typeof Swiper === 'undefined') return;

        const swiperEl = section.querySelector('.js-team-grid-swiper');
        const prevEl = section.querySelector('.team-grid__arrow--prev');
        const nextEl = section.querySelector('.team-grid__arrow--next');

        if (!swiperEl) return;

        new Swiper(swiperEl, {
            slidesPerView: 1.1,
            spaceBetween: 19,
            speed: 600,
            loop: true,
            navigation: {
                prevEl: prevEl,
                nextEl: nextEl,
            },
            breakpoints: {
                768: {
                    enabled: true,
                    slidesPerView: 2.1,
                    spaceBetween: 24,
                },
                992: {
                    enabled: false,
                    slidesPerView: 3,
                    spaceBetween: 24,
                }
            }
        });
    });
</script>