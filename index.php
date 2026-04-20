<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cor-domi
 */

get_header();
?>


<main id="primary" class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();

            if (have_rows('page_content')) :
                while (have_rows('page_content')) : the_row();
                    $layout = get_row_layout();
                    get_template_part('template-parts/sections/' . $layout);
                endwhile;
            else :
                get_template_part('template-parts/content', get_post_type());
            endif;

        endwhile;
    else :
        get_template_part('template-parts/content', 'none');
    endif;
    ?>
</main><!-- #main -->

<?php
get_footer();
