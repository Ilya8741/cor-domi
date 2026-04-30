<?php
$spacing  = get_sub_field('spacing');
$title    = get_sub_field('title');
$text     = get_sub_field('text');
$subtitle = get_sub_field('subtitle');
$logos    = get_sub_field('logos');

if (empty($title) && empty($text) && empty($subtitle) && empty($logos)) {
    return;
}

$spacing = !empty($spacing) ? $spacing : 'all-spacing';
?>

<section class="press-hero press-hero--<?php echo esc_attr($spacing); ?>">
    <div class="press-hero__container">
        <div class="press-hero__top">
            <?php if (!empty($title)) : ?>
                <h2 class="press-hero__title main-title-h3" data-aos="fade-right">
                    <?php echo wp_kses_post($title); ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($text)) : ?>
                <div class="press-hero__text" data-aos="fade-left">
                    <?php echo wp_kses_post($text); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($logos) && is_array($logos)) : ?>
            <?php if (!empty($subtitle)) : ?>
                <p class="press-hero__subtitle" data-aos="fade-right">
                    <?php echo wp_kses_post($subtitle); ?>
                </p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="press-hero__marquee-wrap">
        <div class="press-hero__marquee" style="--gap: 16px;">
            <div class="press-hero__marquee-inner direction-left js-press-hero-marquee-inner" data-speed="70">
                <?php for ($seg = 1; $seg <= 3; $seg++) : ?>
                    <div class="press-hero__segment" data-seg="<?php echo esc_attr($seg); ?>" <?php echo $seg > 1 ? 'aria-hidden="true"' : ''; ?>>
                        <?php foreach ($logos as $item) :
                            $image = $item['logo'] ?? null;
                            $link  = $item['link'] ?? null;

                            if (empty($image) || empty($image['url'])) {
                                continue;
                            }

                            $image_url = $image['url'];
                            $image_alt = $image['alt'] ?? 'Press logo';
                        ?>
                            <div class="press-hero__marquee-item">
                                <?php if (!empty($link) && !empty($link['url'])) : ?>
                                    <a
                                        class="press-hero__logo-link"
                                        href="<?php echo esc_url($link['url']); ?>"
                                        target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
                                        <img
                                            class="press-hero__logo"
                                            src="<?php echo esc_url($image_url); ?>"
                                            alt="<?php echo esc_attr($image_alt ?: 'Press logo'); ?>"
                                            loading="lazy">
                                    </a>
                                <?php else : ?>
                                    <img
                                        class="press-hero__logo"
                                        src="<?php echo esc_url($image_url); ?>"
                                        alt="<?php echo esc_attr($image_alt ?: 'Press logo'); ?>"
                                        loading="lazy">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const marquees = document.querySelectorAll('.press-hero__marquee');
        if (!marquees.length) return;

        function initMarquee(root) {
            const inner = root.querySelector('.js-press-hero-marquee-inner');
            if (!inner) return;

            const segments = Array.from(inner.querySelectorAll('.press-hero__segment'));
            if (segments.length < 3) return;

            const SPEED = Number(inner.getAttribute('data-speed')) || 70;

            function fillToViewport(seg) {
                const vw = root.clientWidth;
                const children = Array.from(seg.children);

                if (!children.length) return;

                let guard = 0;

                while (seg.scrollWidth < vw && guard < 20) {
                    const frag = document.createDocumentFragment();

                    children.forEach((node) => {
                        frag.appendChild(node.cloneNode(true));
                    });

                    seg.appendChild(frag);
                    guard++;
                }
            }

            function measureWidth(seg) {
                return seg.getBoundingClientRect().width;
            }

            function apply() {
                segments.forEach((seg) => {
                    seg.style.animation = 'none';
                });

                segments.forEach(fillToViewport);

                const distance = Math.max(1, measureWidth(segments[0]));
                const duration = distance / SPEED;

                segments.forEach((seg, i) => {
                    seg.style.setProperty('--seg-duration', `${duration}s`);
                    seg.style.setProperty('--seg-delay', `${-(i * duration / segments.length)}s`);
                });

                requestAnimationFrame(() => {
                    segments.forEach((seg) => {
                        const animationName = inner.classList.contains('direction-right') ?
                            'press-hero-marquee-right' :
                            'press-hero-marquee-left';

                        seg.style.animation = `${animationName} var(--seg-duration) linear infinite`;
                    });
                });
            }

            apply();

            if (document.fonts && document.fonts.ready) {
                document.fonts.ready.then(apply).catch(() => {});
            }

            let rAF;

            const onResize = () => {
                cancelAnimationFrame(rAF);
                rAF = requestAnimationFrame(apply);
            };

            window.addEventListener('resize', onResize, {
                passive: true
            });
        }

        marquees.forEach(initMarquee);
    });
</script>