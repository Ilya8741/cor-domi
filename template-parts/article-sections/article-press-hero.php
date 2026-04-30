<?php
$post_id = get_the_ID();

$location = get_field('location', $post_id);
$title    = get_the_title($post_id);
$image_id = get_post_thumbnail_id($post_id);

$share_url   = get_permalink($post_id);
$share_title = get_the_title($post_id);

$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode($share_url);
$linkedin_url = 'https://www.linkedin.com/sharing/share-offsite/?url=' . rawurlencode($share_url);
$x_url        = 'https://twitter.com/intent/tweet?url=' . rawurlencode($share_url) . '&text=' . rawurlencode($share_title);
?>

<section class="article-press-hero">
    <div class="article-press-hero__container">

        <div class="article-press-hero__content">
            <?php if (!empty($location)) : ?>
                <p class="article-press-hero__subtitle" data-aos="fade-left">
                    <?php echo esc_html($location); ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <h1 class="article-press-hero__title main-title-h4" data-aos="fade-right">
                    <?php echo esc_html($title); ?>
                </h1>
            <?php endif; ?>

            <div class="article-press-hero__share" data-aos="fade-left">
                <button
                    class="article-press-hero__share-btn article-hero__copy-link"
                    type="button"
                    aria-label="Copy article link"
                    data-copy-link="<?php echo esc_url($share_url); ?>"
                >
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="9" viewBox="0 0 17 9" fill="none">
  <path d="M6 8.25H4.5C3.50544 8.25 2.55161 7.85491 1.84835 7.15165C1.14509 6.44839 0.75 5.49456 0.75 4.5C0.75 3.50544 1.14509 2.55161 1.84835 1.84835C2.55161 1.14509 3.50544 0.75 4.5 0.75H6" stroke="#2B2B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M10.5 0.75H12C12.9946 0.75 13.9484 1.14509 14.6517 1.84835C15.3549 2.55161 15.75 3.50544 15.75 4.5C15.75 5.49456 15.3549 6.44839 14.6517 7.15165C13.9484 7.85491 12.9946 8.25 12 8.25H10.5" stroke="#2B2B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M5.25 4.5H11.25" stroke="#2B2B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
   <div class="article-hero__copy-link-success">
              <p>Copied!</p>
            </div>
                </button>

                <a
                    class="article-press-hero__share-btn"
                    href="<?php echo esc_url($linkedin_url); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Share on LinkedIn"
                >
       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M18.8156 4H5.18125C4.52812 4 4 4.51563 4 5.15313V18.8438C4 19.4813 4.52812 20 5.18125 20H18.8156C19.4688 20 20 19.4813 20 18.8469V5.15313C20 4.51563 19.4688 4 18.8156 4ZM8.74687 17.6344H6.37188V9.99687H8.74687V17.6344ZM7.55938 8.95625C6.79688 8.95625 6.18125 8.34062 6.18125 7.58125C6.18125 6.82188 6.79688 6.20625 7.55938 6.20625C8.31875 6.20625 8.93437 6.82188 8.93437 7.58125C8.93437 8.3375 8.31875 8.95625 7.55938 8.95625ZM17.6344 17.6344H15.2625V13.9219C15.2625 13.0375 15.2469 11.8969 14.0281 11.8969C12.7937 11.8969 12.6062 12.8625 12.6062 13.8594V17.6344H10.2375V9.99687H12.5125V11.0406H12.5437C12.8594 10.4406 13.6344 9.80625 14.7875 9.80625C17.1906 9.80625 17.6344 11.3875 17.6344 13.4438V17.6344Z" fill="#2B2B2B"/>
</svg>
                </a>

                <a
                    class="article-press-hero__share-btn"
                    href="<?php echo esc_url($facebook_url); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Share on Facebook"
                >
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M11.9981 3.95703C7.56367 3.95703 3.96875 7.55195 3.96875 11.9864C3.96875 15.7519 6.56128 18.9116 10.0586 19.7794V14.4402H8.4029V11.9864H10.0586V10.9291C10.0586 8.19623 11.2954 6.92951 13.9785 6.92951C14.4872 6.92951 15.365 7.0294 15.7241 7.12896V9.3531C15.5346 9.33319 15.2054 9.32323 14.7965 9.32323C13.48 9.32323 12.9713 9.82202 12.9713 11.1186V11.9864H15.594L15.1434 14.4402H12.9713V19.957C16.9471 19.4769 20.0278 16.0917 20.0278 11.9864C20.0275 7.55195 16.4326 3.95703 11.9981 3.95703Z" fill="#2B2B2B"/>
</svg>
                </a>

                <a
                    class="article-press-hero__share-btn"
                    href="<?php echo esc_url($x_url); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Share on X"
                >
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M16.6009 4.61523H19.0544L13.6943 10.7414L20 19.0778H15.0627L11.1957 14.0218L6.77087 19.0778H4.31595L10.049 12.5251L4 4.61523H9.06262L12.5581 9.23657L16.6009 4.61523ZM15.7399 17.6093H17.0993L8.32392 6.0066H6.86506L15.7399 17.6093Z" fill="#2B2B2B"/>
</svg>
                </a>
            </div>
        </div>

        <?php if (!empty($image_id)) : ?>
            <div class="article-press-hero__media" data-aos="fade-up">
                <?php
                echo wp_get_attachment_image(
                    $image_id,
                    'full',
                    false,
                    array(
                        'class' => 'article-press-hero__image',
                        'loading' => 'eager',
                    )
                );
                ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const copyButton = document.querySelector('.article-hero__copy-link');

    copyButton.addEventListener('click', async function() {
      const link = this.getAttribute('data-copy-link');

      try {
        await navigator.clipboard.writeText(link);
        this.classList.add('is-copied');

        setTimeout(() => {
          this.classList.remove('is-copied');
        }, 2000);
      } catch (error) {
        console.error('Copy failed:', error);
      }
    });
  });
</script>