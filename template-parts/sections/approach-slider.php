<?php
$title = get_sub_field('title');
$background = get_sub_field('background') ?: 'white';
$slides = get_sub_field('slides');

$spacing = get_sub_field('spacing') ?: 'all-spacing';

if (!$title && empty($slides)) {
    return;
}

$section_classes = 'approach-slider';
$section_classes .= $background === 'yellow' ? ' approach-slider--yellow' : ' approach-slider--white';
?>

<section class="approach-slider approach-slider--<?php echo esc_attr($background); ?> <?php echo esc_attr($spacing); ?>">
    <?php if ($title): ?>
        <div class="approach-slider__head">
            <h2 class="main-title-h5 approach-slider__title" data-aos="fade-right">
                <?php echo wp_kses_post($title); ?>
            </h2>
        </div>
    <?php endif; ?>

    <?php if ($slides): ?>
        <?php $duration = 500; ?>
        <div class="approach-slider-container">
            <div class="approach-slider__slider swiper js-approach-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($slides as $slide): ?>
                        <?php $image = $slide['image'] ?? null; ?>
                        <?php if ($image): ?>
                            <div class="swiper-slide approach-slider__slide">
                                <div class="approach-slider__image-wrap" data-aos="fade-right"
                                    data-aos-duration="<?php echo esc_attr($duration); ?>">
                                    <?php
                                    echo wp_get_attachment_image(
                                        $image['ID'],
                                        'large',
                                        false,
                                        array(
                                            'class' => 'approach-slider__image',
                                            'alt'   => !empty($image['alt']) ? $image['alt'] : ''
                                        )
                                    );
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php $duration += 100; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sliders = document.querySelectorAll('.js-approach-slider');

        sliders.forEach((slider) => {
            new Swiper(slider, {
                slidesPerView: 2.15,
                spaceBetween: 19,
                freeMode: false,
                loop: true,
                speed: 600,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 3.15,
                        spaceBetween: 24
                    },
                    1200: {
                        slidesPerView: 4.15,
                        spaceBetween: 24
                    }
                }
            });
        });
    });
</script>