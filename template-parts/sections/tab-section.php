<?php if (have_rows('services_repeater')) : ?>
    <?php
    $services = [];
    while (have_rows('services_repeater')) : the_row();
        $title = (string) get_sub_field('title');
        $text  = (string) get_sub_field('text');
        $img   = get_sub_field('image');
        $url_f = get_sub_field('url');

        $href = '';
        $target = '_self';
        if (is_array($url_f)) {
            $href = (string) ($url_f['url'] ?? '');
            $target = (string) ($url_f['target'] ?? '_self');
        } else {
            $href = (string) $url_f;
        }

        if (!$title && !$text && empty($img)) continue;

        $services[] = [
            'title'  => $title,
            'text'   => $text,
            'img'    => $img,
            'href'   => $href,
            'target' => $target,
        ];
    endwhile;

    if (empty($services)) return;
    $first = $services[0];
    $first_img_url = is_array($first['img']) ? ($first['img']['url'] ?? '') : '';
    $first_img_alt = is_array($first['img']) ? ($first['img']['alt'] ?? '') : '';
    ?>

    <section class="services-tabs" data-services-tabs>
        <div class="services-tabs__wrapper">
            <div class="services-cursor" data-services-cursor aria-hidden="true">
                <div class="services-cursor__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                        <path d="M19.0919 19.0919V6.36396H6.36396" stroke="black" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.36328 19.0922L19.0912 6.36426" stroke="black" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <?php $title1 = get_sub_field('title');
            $text1 = get_sub_field('text'); ?>

            <div class="services-tabs__header">
                <?php if (!empty($title1)) : ?>
                    <h2 class="services-tabs__header-title main-title-h5" data-aos="fade-right" data-aos-duration="1000">
                        <?php echo wp_kses_post($title1); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($text1)) : ?>
                    <div class="services-tabs__header-text" data-aos="fade-left" data-aos-duration="1000">
                        <?php echo wp_kses_post($text1); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="services-tabs__inner">
                <div class="services-tabs__left" data-aos="fade-right" data-aos-duration="1000">
                    <div class="services-tabs__list" role="tablist">
                        <?php foreach ($services as $i => $s) :
                            $img_url = is_array($s['img']) ? ($s['img']['url'] ?? '') : '';
                            $img_alt = is_array($s['img']) ? ($s['img']['alt'] ?? '') : '';
                        ?>
                            <a
                                class="services-tab <?php echo $i === 0 ? 'is-active' : ''; ?>"
                                href="<?php echo $s['href'] ? esc_url($s['href']) : '#'; ?>"
                                <?php if ($s['href']) : ?>target="<?php echo esc_attr($s['target']); ?>" <?php endif; ?>
                                role="tab"
                                aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                                data-tab
                                data-title="<?php echo esc_attr($s['title']); ?>"
                                data-text="<?php echo esc_attr($s['text']); ?>"
                                data-img="<?php echo esc_url($img_url); ?>"
                                data-img-alt="<?php echo esc_attr($img_alt); ?>">
                                <h3 class="services-tab__title main-title-h4"><?php echo esc_html($s['title']); ?></h3>

                                <div class="services-tab__text" data-tab-text>
                                    <?php echo wp_kses_post(wpautop($s['text'])); ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- DESKTOP images (all) -->
                <div class="services-tabs__right" data-aos="fade-left" data-aos-duration="1000">
                    <div class="services-tabs__image" data-images>
                        <?php foreach ($services as $i => $s) :
                            $img_url = is_array($s['img']) ? ($s['img']['url'] ?? '') : '';
                            $img_alt = is_array($s['img']) ? ($s['img']['alt'] ?? '') : '';
                            if (!$img_url) continue;
                        ?>
                            <img
                                class="services-tabs__img <?php echo $i === 0 ? 'is-active' : ''; ?>"
                                data-image-index="<?php echo (int) $i; ?>"
                                src="<?php echo esc_url($img_url); ?>"
                                alt="<?php echo esc_attr($img_alt); ?>"
                                loading="lazy">
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="services-tabs__mobile">
                    <?php foreach ($services as $i => $s) : ?>
                        <a
                            class="services-tabs__mobile-item"
                            data-aos="fade-right"
                             data-aos-duration="1000"
                            href="<?php echo $s['href'] ? esc_url($s['href']) : '#'; ?>"
                            <?php if ($s['href']) : ?>target="<?php echo esc_attr($s['target']); ?>" <?php endif; ?>>
                            <div class="services-tabs__mobile-content">
                                <?php if (!empty($s['title'])) : ?>
                                    <h3 class="services-tabs__mobile-title main-title-h4">
                                        <?php echo esc_html($s['title']); ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if (!empty($s['text'])) : ?>
                                    <div class="services-tabs__mobile-text">
                                        <?php echo wp_kses_post(wpautop($s['text'])); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="services-tabs__mobile-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                    <path d="M19.0919 19.0919V6.36396H6.36396" stroke="black" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.36328 19.0922L19.0912 6.36426" stroke="black" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const section = document.querySelector('[data-services-tabs]');
        if (!section) return;

        const tabs = Array.from(section.querySelectorAll('[data-tab]'));
        const images = Array.from(section.querySelectorAll('.services-tabs__img'));

        function setActive(tab) {
            tabs.forEach(t => {
                t.classList.remove('is-active');
                t.setAttribute('aria-selected', 'false');
            });

            tab.classList.add('is-active');
            tab.setAttribute('aria-selected', 'true');

            const idx = tabs.indexOf(tab);
            images.forEach((im, i) => im.classList.toggle('is-active', i === idx));
        }

        tabs.forEach(tab => {
            tab.addEventListener('mouseenter', () => {
                if (window.matchMedia('(min-width: 1000px)').matches) setActive(tab);
            });

            tab.addEventListener('focus', () => {
                if (window.matchMedia('(min-width: 1000px)').matches) setActive(tab);
            });

            tab.addEventListener('click', (e) => {
                const href = tab.getAttribute('href') || '';
                if (!href || href === '#') {
                    e.preventDefault();
                    setActive(tab);
                }
            });
        });

        const cursor = section.querySelector('[data-services-cursor]');
        const canHover = window.matchMedia('(hover: hover)').matches;
        const finePointer = window.matchMedia('(pointer: fine)').matches;

        if (cursor && canHover && finePointer) {
            const move = (e) => {
                const x = e.clientX;
                const y = e.clientY;
                cursor.style.transform = `translate(${x - cursor.offsetWidth / 2}px, ${y - cursor.offsetHeight / 2}px)`;
            };

            section.addEventListener('mouseenter', () => section.classList.add('is-cursor-on'));
            section.addEventListener('mouseleave', () => section.classList.remove('is-cursor-on'));
            section.addEventListener('mousemove', move);
        } else {
            section.classList.remove('is-cursor-on');
            if (cursor) cursor.style.display = 'none';
        }
    });
</script>