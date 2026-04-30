<?php
    $subtitle = get_sub_field('subtitle');
    $title = get_sub_field('title');
    $text = get_sub_field('text');
    $link = get_sub_field('link');
?>
<section class="press-grid__feature-section">
<div class="press-grid__feature press-grid__feature--article" data-theme="dark" data-aos="fade-up">
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
</section>
