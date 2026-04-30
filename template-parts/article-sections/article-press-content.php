<?php
$content_blocks = get_sub_field('content');
$show_related   = get_sub_field('show_related');

$related_article_mobile_display = get_sub_field('related_article_mobile_display');

$background = get_sub_field('background');
$spacing    = get_sub_field('spacing');

$background = !empty($background) ? $background : 'yellow';
$spacing    = !empty($spacing) ? $spacing : 'all-spacing';

$featured_press_article = get_sub_field('featured_press_article');

$current_post_id = get_the_ID();

$content_blocks = is_array($content_blocks) ? $content_blocks : array();

$should_render_related = !empty($show_related) || !empty($related_article_mobile_display);

if (empty($content_blocks) && empty($should_render_related)) {
    return;
}

$featured_id = 0;

if (!empty($featured_press_article)) {
    $featured_id = is_object($featured_press_article) ? $featured_press_article->ID : (int) $featured_press_article;
}

$related_args = array(
    'post_type'      => 'press',
    'post_status'    => 'publish',
    'posts_per_page' => 4,
    'post__not_in'   => array_filter(array($current_post_id, $featured_id)),
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$related_query = new WP_Query($related_args);

$section_classes = array(
    'article-press-content',
    'article-press-content--' . $background,
    $spacing,
);

if (!empty($show_related)) {
    $section_classes[] = 'article-press-content--show-related';
}

if (!empty($related_article_mobile_display)) {
    $section_classes[] = 'article-press-content--mobile-display';
}
?>

<section class="<?php echo esc_attr(implode(' ', $section_classes)); ?>">
    <div class="article-press-content__container">

        <?php if (!empty($content_blocks)) : ?>
            <div class="article-press-content__main">
                <?php foreach ($content_blocks as $block) : ?>
                    <?php
                    $text = isset($block['text']) ? $block['text'] : '';

                    if (empty($text)) {
                        continue;
                    }
                    ?>

                    <div class="article-press-content__block" data-aos="fade-right">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($should_render_related)) : ?>
            <aside class="article-press-content__sidebar" data-aos="fade-left">

                <?php if (!empty($featured_id)) : ?>
                    <?php
                    $featured_title = get_the_title($featured_id);
                    $featured_url   = get_permalink($featured_id);
                    $featured_date  = get_field('date', $featured_id);

                    if (empty($featured_date)) {
                        $featured_date = get_the_date('j F Y', $featured_id);
                    }
                    ?>

                    <a href="<?php echo esc_url($featured_url); ?>" class="article-press-content__featured">
                        <?php if (!empty($featured_title)) : ?>
                            <h3 class="article-press-content__featured-title">
                                <?php echo esc_html($featured_title); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if (!empty($featured_date)) : ?>
                            <p class="article-press-content__featured-date">
                                <?php echo esc_html($featured_date); ?>
                            </p>
                        <?php endif; ?>

                        <div class="article-press-content__featured-link main-link">
                            Visit press article
                        </div>
                    </a>
                <?php endif; ?>

                <?php if ($related_query->have_posts()) : ?>
                    <div class="article-press-content__related">
                        <h4 class="article-press-content__related-heading">
                            Related insights
                        </h4>

                        <div class="article-press-content__related-list">
                            <?php while ($related_query->have_posts()) : ?>
                                <?php
                                $related_query->the_post();

                                $related_id    = get_the_ID();
                                $related_title = get_the_title($related_id);
                                $related_url   = get_permalink($related_id);
                                ?>

                                <a class="article-press-content__related-link article-press-content__related-item" href="<?php echo esc_url($related_url); ?>">
                                    <?php echo esc_html($related_title); ?>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>

            </aside>
        <?php endif; ?>

    </div>
</section>