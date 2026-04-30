<?php
$image_1 = get_sub_field('image_1');
$image_2 = get_sub_field('image_2');

$spacing = get_sub_field('spacing');
$spacing = !empty($spacing) ? $spacing : 'all-spacing';

if (empty($image_1) && empty($image_2)) {
    return;
}

$image_1_id = is_array($image_1) ? $image_1['ID'] : $image_1;
$image_2_id = is_array($image_2) ? $image_2['ID'] : $image_2;

$has_two_images = !empty($image_1_id) && !empty($image_2_id);
?>

<section class="article-press-images <?php echo esc_attr($spacing); ?>">
    <div class="article-press-images__container">
        <div class="article-press-images__grid <?php echo $has_two_images ? 'article-press-images__grid--two' : 'article-press-images__grid--single'; ?>">

            <?php if (!empty($image_1_id)) : ?>
                <div class="article-press-images__item" <?php if (!empty($image_2_id)) : ?> data-aos="fade-right" <?php else : ?> data-aos="fade-up" <?php endif; ?> >
                    <?php
                    echo wp_get_attachment_image(
                        $image_1_id,
                        'full',
                        false,
                        array(
                            'class' => 'article-press-images__image',
                            'loading' => 'lazy',
                        )
                    );
                    ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($image_2_id)) : ?>
                <div class="article-press-images__item" <?php if (!empty($image_2_id)) : ?> data-aos="fade-left" <?php else : ?> data-aos="fade-up" <?php endif; ?>>
                    <?php
                    echo wp_get_attachment_image(
                        $image_2_id,
                        'full',
                        false,
                        array(
                            'class' => 'article-press-images__image',
                            'loading' => 'lazy',
                        )
                    );
                    ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>