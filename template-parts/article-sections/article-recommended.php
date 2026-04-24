<?php
$title          = get_sub_field('title');
$link           = get_sub_field('link');
$posts_selected = get_sub_field('posts_selected');

$current_id        = get_the_ID();
$current_post_type = get_post_type($current_id);

$recommended_posts = array();

if (!empty($posts_selected) && is_array($posts_selected)) {
	$recommended_posts = $posts_selected;
} else {
	$all_posts = get_posts(array(
		'post_type'      => $current_post_type,
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'fields'         => 'ids',
	));

	$current_index = array_search($current_id, $all_posts, true);
	$total_posts   = count($all_posts);

	if ($current_index !== false && $total_posts > 1) {
		if ($total_posts === 2) {
			$other_post_id = $all_posts[$current_index === 0 ? 1 : 0];

			$recommended_posts = array(
				get_post($other_post_id),
			);
		} else {
			if ($current_index === 0) {
				$next_post_id = $all_posts[1];
				$prev_post_id = $all_posts[$total_posts - 1];
			} elseif ($current_index === $total_posts - 1) {
				$next_post_id = $all_posts[0];
				$prev_post_id = $all_posts[$current_index - 1];
			} else {
				$next_post_id = $all_posts[$current_index + 1];
				$prev_post_id = $all_posts[$current_index - 1];
			}

			$recommended_posts = array(
				get_post($next_post_id),
				get_post($prev_post_id),
			);
		}
	}
}

$recommended_posts = array_filter($recommended_posts);

?>

<section class="article-recommended">
	<div class="article-recommended__container">
		<div class="article-recommended__header">
			<?php if (!empty($title)): ?>
				<h2 class="article-recommended__title main-title-h4"  data-aos="fade-right">
					<?php echo wp_kses_post($title); ?>
				</h2>
			<?php endif; ?>

			<?php if (!empty($link) && is_array($link)): ?>
				<a
					class="article-recommended__link main-link"  data-aos="fade-left"
					href="<?php echo esc_url($link['url']); ?>"
					<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>
				>
					<?php echo esc_html($link['title'] ?: 'View all projects'); ?>
				</a>
			<?php endif; ?>
		</div>

		<?php if (!empty($recommended_posts)): ?>
			<div class="article-recommended__grid"  data-aos="fade-up">
				<?php foreach ($recommended_posts as $recommended_post): ?>
					<?php
					$post_id    = is_object($recommended_post) ? $recommended_post->ID : $recommended_post;
					$post_title = get_the_title($post_id);
					$post_url   = get_permalink($post_id);
					$image_id   = get_post_thumbnail_id($post_id);

					$location = get_field('location', $post_id);
					?>

					<article class="article-recommended__card">
						<a class="article-recommended__card-link" href="<?php echo esc_url($post_url); ?>">
							<?php if (!empty($image_id)): ?>
								<div class="article-recommended__image-wrapper">
									<?php
									echo wp_get_attachment_image(
										$image_id,
										'large',
										false,
										array(
											'class'   => 'article-recommended__image',
											'loading' => 'lazy',
										)
									);
									?>
								</div>
							<?php endif; ?>

							<div class="article-recommended__content">
								<?php if (!empty($post_title)): ?>
									<h3 class="article-recommended__card-title">
										<?php echo esc_html($post_title); ?>
									</h3>
								<?php endif; ?>

								<?php if (!empty($location)): ?>
									<p class="article-recommended__location">
										<?php echo esc_html($location); ?>
									</p>
								<?php endif; ?>
							</div>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>