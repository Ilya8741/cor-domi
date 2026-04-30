<?php
$posts    = get_sub_field('posts');
$subtitle = get_sub_field('subtitle');
$title    = get_sub_field('title');
$text     = get_sub_field('text');
$link     = get_sub_field('link');

$posts = is_array($posts) ? $posts : array();

$has_feature_block = !empty($subtitle) || !empty($title) || !empty($text) || !empty($link);
?>

<section class="press-grid" data-press-grid>
    <div class="press-grid__container">
        <?php if (!empty($posts)) : ?>
            <div class="press-grid__list">
                <?php foreach ($posts as $index => $post_item) : ?>
                    <?php
                    $post_id = is_object($post_item) ? $post_item->ID : $post_item;

                    if (empty($post_id)) {
                        continue;
                    }

                    $post_title = get_the_title($post_id);
                    $post_url   = get_permalink($post_id);
                    $post_image = get_the_post_thumbnail_url($post_id, 'large');
                    $post_location = get_field('location', $post_id);

                    $excerpt = get_the_excerpt($post_id);

                    if (empty($excerpt)) {
                        $post_content = get_post_field('post_content', $post_id);
                        $excerpt = wp_trim_words(wp_strip_all_tags($post_content), 24, '...');
                    }
                    ?>

                    <a href="<?php echo esc_url($post_url); ?>" class="press-grid__item js-press-grid-item" data-aos="fade-up" data-index="<?php echo esc_attr($index); ?>">
                        <div class="press-grid__item-content">
                            <?php if (!empty($post_title)) : ?>
                                <h3 class="press-grid__item-title main-title-h5">
                                    <?php echo esc_html($post_title); ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ($post_location): ?>
                                <p class="press-grid__location">
                                    <?php echo esc_html($post_location); ?>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($excerpt)) : ?>
                                <p class="press-grid__item-text">
                                    <?php echo esc_html($excerpt); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($post_image)) : ?>
                            <div class="press-grid__item-media">
                                <img
                                    class="press-grid__item-image"
                                    src="<?php echo esc_url($post_image); ?>"
                                    alt="<?php echo esc_attr($post_title); ?>"
                                    loading="lazy">
                            </div>
                        <?php endif; ?>
                    </a>

                    <?php if ($index === 2 && $has_feature_block) : ?>
                        <div class="press-grid__feature js-press-grid-feature" data-theme="dark" data-aos="fade-up">
                            <?php if (!empty($subtitle)) : ?>
                                <p class="press-grid__feature-subtitle">
                                    <?php echo esc_html($subtitle); ?>
                                </p>
                            <?php endif; ?>

                            <div class="press-grid__feature-row">
                                <div class="press-grid__feature-content">
                                    <?php if (!empty($title)) : ?>
                                        <h2 class="press-grid__feature-title main-title-h4">
                                            <?php echo esc_html($title); ?>
                                        </h2>
                                    <?php endif; ?>

                                    <?php if (!empty($text)) : ?>
                                        <div class="press-grid__feature-text">
                                            <?php echo wp_kses_post(wpautop($text)); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($link) && !empty($link['url'])) : ?>
                                    <a
                                        class="press-grid__feature-link main-link"
                                        href="<?php echo esc_url($link['url']); ?>"
                                        target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
                                        <?php echo esc_html($link['title'] ?: 'Read more'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <?php if (count($posts) > 6) : ?>
                <div class="press-grid__load-wrapper">
                    <button class="press-grid__load-more main-link" type="button" data-press-load-more>
                        Load more
                    </button>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sections = document.querySelectorAll('[data-press-grid]');
        if (!sections.length) return;

        sections.forEach((section) => {
            const items = Array.from(section.querySelectorAll('.js-press-grid-item'));
            const button = section.querySelector('[data-press-load-more]');
            const buttonWrapper = section.querySelector('.press-grid__load-wrapper');

            if (!items.length) return;

            const STEP = 6;
            let visibleCount = STEP;

            function refreshAOS() {
                if (typeof AOS !== 'undefined') {
                    requestAnimationFrame(() => {
                        AOS.refreshHard();
                    });
                }
            }

            function updateItems(shouldRefreshAOS = false) {
                items.forEach((item, index) => {
                    if (index < visibleCount) {
                        item.classList.remove('is-hidden');

                        if (shouldRefreshAOS) {
                            item.classList.remove('aos-animate');
                        }
                    } else {
                        item.classList.add('is-hidden');
                    }
                });

                if (button && visibleCount >= items.length) {
                    button.style.display = 'none';
                    buttonWrapper.style.display = 'none';
                }

                if (shouldRefreshAOS) {
                    refreshAOS();
                }
            }

            updateItems();

            if (button) {
                button.addEventListener('click', () => {
                    visibleCount += STEP;
                    updateItems(true);
                });
            }
        });
    });
</script>