<?php
$background = get_sub_field('background');
$spacing    = get_sub_field('spacing');

$content = get_sub_field('content');
$image   = get_sub_field('image');

$opportunities = get_sub_field('opportunities');

$cta_title   = get_sub_field('cta_title');
$cta_content = get_sub_field('cta_content');

$background = !empty($background) ? $background : 'yellow';
$spacing    = !empty($spacing) ? $spacing : 'all-spacing';

$opportunities = is_array($opportunities) ? $opportunities : array();

$image_id = '';

if (!empty($image)) {
    if (is_array($image)) {
        $image_id = !empty($image['ID']) ? $image['ID'] : '';
    } elseif (is_numeric($image)) {
        $image_id = $image;
    }
}

if (
    empty($content) &&
    empty($image_id) &&
    empty($opportunities) &&
    empty($cta_title) &&
    empty($cta_content)
) {
    return;
}
?>

<section class="current-opportunities current-opportunities--<?php echo esc_attr($background); ?> <?php echo esc_attr($spacing); ?>">
    <div class="current-opportunities__container">

        <div class="current-opportunities__left">
            <?php if (!empty($content)) : ?>
                <div class="current-opportunities__content" data-aos="fade-right">
                    <?php echo wp_kses_post($content); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($image_id)) : ?>
                <div class="current-opportunities__image-wrapper" data-aos="fade-right">
                    <?php
                    echo wp_get_attachment_image(
                        $image_id,
                        'large',
                        false,
                        array(
                            'class'   => 'current-opportunities__image',
                            'loading' => 'lazy',
                        )
                    );
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="current-opportunities__right">
            <?php if (!empty($opportunities)) : ?>
                <div class="current-opportunities__list">
                    <p class="current-opportunities__eyebrow" data-aos="fade-up">
                        Current opportunities
                    </p>

                    <?php foreach ($opportunities as $item) : ?>
                        <?php
                        if (!is_array($item)) {
                            continue;
                        }

                        $item_title    = !empty($item['title']) ? $item['title'] : '';
                        $item_subtitle = !empty($item['subtitle']) ? $item['subtitle'] : '';
                        $item_link     = !empty($item['link']) ? $item['link'] : '';

                        $link_url    = '';
                        $link_title  = 'Enquire';
                        $link_target = '_self';

                        if (!empty($item_link) && is_array($item_link)) {
                            $link_url    = !empty($item_link['url']) ? $item_link['url'] : '';
                            $link_title  = !empty($item_link['title']) ? $item_link['title'] : 'Enquire';
                            $link_target = !empty($item_link['target']) ? $item_link['target'] : '_self';
                        }

                        if (empty($item_title) && empty($item_subtitle) && empty($link_url)) {
                            continue;
                        }
                        ?>

                        <div class="current-opportunities__item" data-aos="fade-up">
                            <div class="current-opportunities__item-content">
                                <?php if (!empty($item_title)) : ?>
                                    <h3 class="current-opportunities__item-title">
                                        <?php echo wp_kses_post($item_title); ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if (!empty($item_subtitle)) : ?>
                                    <div class="current-opportunities__item-subtitle">
                                        <?php echo wp_kses_post($item_subtitle); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($link_url)) : ?>
                                <a
                                    class="current-opportunities__item-link main-link"
                                    href="<?php echo esc_url($link_url); ?>"
                                    target="<?php echo esc_attr($link_target); ?>"
                                    <?php if ($link_target === '_blank') : ?>
                                        rel="noopener noreferrer"
                                    <?php endif; ?>
                                >
                                    <?php echo esc_html($link_title); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($cta_title) || !empty($cta_content)) : ?>
                <div class="current-opportunities__cta" data-aos="fade-up">
                    <?php if (!empty($cta_title)) : ?>
                        <h3 class="current-opportunities__cta-title">
                            <?php echo esc_html($cta_title); ?>
                        </h3>
                    <?php endif; ?>

                    <?php if (!empty($cta_content)) : ?>
                        <div class="current-opportunities__cta-content">
                            <?php echo wp_kses_post($cta_content); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>