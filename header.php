<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cor-domi
 */

?>
<?php
$pl_enabled = get_field('preloader_enable', 'header_options');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

  	<?php if ( is_front_page() && $pl_enabled ) : ?>
		<style>
			html,
			body {
				background: #000 !important;
			}
		</style>
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
<?php
$pl_enabled  = get_field('preloader_enable',  'header_options');
$pl_duration = (int) get_field('preloader_duration', 'header_options') ?: 100;

if ( is_front_page() && $pl_enabled ): ?>
  <div id="pl-overlay" class="pl-overlay" data-duration="<?php echo esc_attr($pl_duration); ?>">
  </div>

<script>
(function () {
  var d  = document;
  var ov = d.getElementById('pl-overlay');
  if (!ov) return;

  var seenSession = false;
  try {
    seenSession = sessionStorage.getItem('pl_seen') === '1';
  } catch(e) {}

  if (seenSession) {
    d.body.classList.add('preloader-already-seen');
    d.body.classList.add('has-seen-preloader');
    ov.remove();
    return;
  }

  try {
    if ('scrollRestoration' in history) {
      history.scrollRestoration = 'manual';
    }
  } catch(e){}

  window.scrollTo(0, 0);
  window.addEventListener('pageshow', function(e){
    if (e.persisted) window.scrollTo(0, 0);
  });

  var dur = parseInt(ov.getAttribute('data-duration') || '800', 10);
  var textLeadTime = 3000;
  var textHoldTime = 1000;

  ov.style.setProperty('--pl-dur', dur + 'ms');

  d.documentElement.classList.add('pl-lock');
  d.body.classList.add('pl-lock');
  d.body.classList.add('hero-intro-pending');

  function getTransitionMs(el){
    try{
      var cs = getComputedStyle(el);
      var td = (cs.transitionDuration || '0s').split(',')[0].trim();
      return td.endsWith('ms') ? parseFloat(td) : parseFloat(td) * 1000;
    }catch(e){
      return 800;
    }
  }

  var loaderVisibleTime = Math.max(0, dur - textLeadTime);

  setTimeout(function(){
    var fadeMs = getTransitionMs(ov) || 800;

    ov.classList.add('is-done');

    setTimeout(function(){
      d.documentElement.classList.remove('pl-lock');
      d.body.classList.remove('pl-lock');
      ov.remove();

      d.body.classList.add('hero-title-visible');

      setTimeout(function(){
        d.body.classList.add('hero-intro-finished');
      }, textHoldTime);

      try {
        sessionStorage.setItem('pl_seen', '1');
      } catch(e) {}
    }, fadeMs);

  }, loaderVisibleTime);
})();
</script>

<?php endif; ?>
	<div id="page" class="site">
		<header id="masthead" class="site-header">
			<div class="site-header-wrapper">
				<div class="site-header-wrapper-main">
          <div data-aos="fade-right" data-aos-delay="500">
	<button class="header-open header-main-link" aria-label="Open menu">
          Menu
				</button>
          </div>
        
        <div>

        
				<?php if ($image = get_field('logo', 'header_options')) : ?>
					<a href="/" class="header-logo-link header-main-logo-link">
					<?php
					echo wp_get_attachment_image(
						$image['ID'],
						'full',
						false,
						[
							'class' => 'header-main-logo',
							'alt'   => esc_attr($image['alt'] ?? '')
						]
					);
					?>
					
					</a>
				<?php endif; ?>
				<?php if ($image1 = get_field('dark_logo', 'header_options')) : ?>
					<a href="/" class="header-logo-link header-dark-logo-link">
					<?php
					echo wp_get_attachment_image(
						$image1['ID'],
						'full',
						false,
						[
							'class' => 'header-dark-logo',
							'alt'   => esc_attr($image1['alt'] ?? ''),
						]
					);
					?>
					</a>
				<?php endif; ?>
        </div>
        <div data-aos="fade-left" data-aos-delay="500">
				<a href="/contact" class="header-contact-link header-main-link">
          Contact
				</a>
        </div>
				</div>
			</div>
			<div class="header-burger-menu">
				<div class="header-burger-menu-wrapper">

					<?php
					$main_image = get_field('mega_menu_image', 'header_options'); // Image
					?>

					<div class="hb-grid">
						<div class="hb-side">
							<div class="hb-menu-with-img">
								<?php if (have_rows('header_menu', 'header_options')): ?>
									<nav class="hb-menu" aria-label="Header menu">
										<div class="hb-menu__list">
											<?php
											$i = 1;
											while (have_rows('header_menu', 'header_options')): the_row();
												$link = get_sub_field('link'); // Link
												$img_id_attr = 'hb-img-' . $i;
												$has_image   = get_sub_field('image');
												if (!$has_image) {
													$img_id_attr = 'hb-img-0';
												}

												if ($link && !empty($link['url'])): ?>
														<a
															class="hb-menu__link"
															href="<?php echo esc_url($link['url']); ?>"
															target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
															data-img-id="<?php echo esc_attr($img_id_attr); ?>">
															<?php echo esc_html($link['title'] ?: ''); ?>
														</a>
											<?php endif;
												$i++;
											endwhile; ?>
										</div>
									</nav>
								<?php endif; ?>
							</div>
						</div>
						<div class="hb-media">
							<?php if ($main_image): ?>
								<img
									id="hb-img-0"
									class="hb-media__img is-active"
									src="<?php echo esc_url($main_image['url']); ?>"
									alt="<?php echo esc_attr($main_image['alt'] ?? ''); ?>"
									loading="lazy" />
							<?php endif; ?>

							<?php
							if (have_rows('header_menu', 'header_options')):
								$i = 1;
								while (have_rows('header_menu', 'header_options')): the_row();
									$img = get_sub_field('image');
									if ($img): ?>
										<img
											id="hb-img-<?php echo esc_attr($i); ?>"
											class="hb-media__img"
											src="<?php echo esc_url($img['url']); ?>"
											alt="<?php echo esc_attr($img['alt'] ?? ''); ?>"
											loading="lazy" />
							<?php
										$i++;
									endif;
								endwhile;
								reset_rows();
							endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</header>

<script>
    (function () {
      var header = document.getElementById('masthead'); 
      if (!header) return;

      var lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
      var ticking = false;
      var threshold = 8;

      function updateHeaderVisibility() {
        ticking = false;
        var currentY = window.pageYOffset || document.documentElement.scrollTop;
        var diff = currentY - lastScrollY;

        if (currentY <= 0) {
          header.classList.remove('header-hidden');
          lastScrollY = currentY;
          return;
        }

        if (Math.abs(diff) < threshold) {
          return;
        }

        if (diff > 0) {
          header.classList.add('header-hidden');
        } else {
          header.classList.remove('header-hidden');
        }

        lastScrollY = currentY;
      }

      function onScroll() {
        if (!ticking) {
          ticking = true;
          requestAnimationFrame(updateHeaderVisibility);
        }
      }

      window.addEventListener('scroll', onScroll, { passive: true });
    })();
</script>

<script>
  (function () {
    var header = document.querySelector('.site-header-wrapper-main');
    if (!header) return;

    var DARK_SELECTOR = '[data-theme="dark"], .bg-dark, .section--dark';

    function isHeaderOverDarkByTop() {
      var hb = header.getBoundingClientRect();
      var sampleY = Math.max(0, Math.round(hb.top + 20)); 

      var darks = document.querySelectorAll(DARK_SELECTOR);
      for (var i = 0; i < darks.length; i++) {
        var r = darks[i].getBoundingClientRect();
        if (r.top <= sampleY && r.bottom >= sampleY) return true;
      }
      return false;
    }

    var ticking = false;
    function update() {
      ticking = false;
      header.classList.toggle('on-dark', isHeaderOverDarkByTop());
    }

    function onScroll() {
      if (!ticking) {
        ticking = true;
        requestAnimationFrame(update);
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    document.addEventListener('DOMContentLoaded', update);
    update();
  })();
</script>

