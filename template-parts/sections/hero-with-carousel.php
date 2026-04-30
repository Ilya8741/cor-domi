<?php
$subtitle = get_sub_field('subtitle');
$title = get_sub_field('title');
$text = get_sub_field('text');

$slides = get_sub_field('slides');
?>

<section class="hero-with-carousel">
    <?php if ($title): ?>
        <div class="hero-with-carousel__header">
            <p class="hero-with-carousel__subtitle" data-aos="fade-right">
                <?php echo esc_html($subtitle); ?>
            </p>
            <div class="hero-with-carousel__header-right">
                <h2 class="main-title-h3 hero-with-carousel__title" data-aos="fade-left">
                    <?php echo esc_html($title); ?>
                </h2>
                <p class="hero-with-carousel__text" data-aos="fade-left">
                    <?php echo esc_html($text); ?>
                </p>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($slides): ?>
        <?php $duration = 500; ?>
        <div class="hero-with-carousel-container">
            <div class="hero-with-carousel__slider swiper js-hero-with-carousel">
                <div class="swiper-wrapper">
                    <?php foreach ($slides as $slide): ?>
                        <?php $image = $slide['image'] ?? null; ?>
                        <?php if ($image): ?>
                            <div class="swiper-slide hero-with-carousel__slide">
                                <div class="hero-with-carousel__image-wrap" data-aos="fade-right"
                                    data-aos-duration="<?php echo esc_attr($duration); ?>">
                                    <?php
                                    echo wp_get_attachment_image(
                                        $image['ID'],
                                        'large',
                                        false,
                                        array(
                                            'class' => 'hero-with-carousel__image',
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
        const sliders = document.querySelectorAll('.js-hero-with-carousel');

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