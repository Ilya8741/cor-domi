<?php

/**
 * The template for displaying the footer
 *
 * @package cor-domi
 */

$instagram_title = get_field('instagram_title', 'footer_options');
$instagram_link = get_field('instagram_link', 'footer_options');
$instagram_images = get_field('instagram_images', 'footer_options');

$footer_explore_title = get_field('footer_explore_title', 'footer_options');
$footer_explore_links = get_field('footer_explore_links', 'footer_options');

$footer_contact_title = get_field('footer_contact_title', 'footer_options');
$footer_contact_links = get_field('footer_contact_links', 'footer_options');

$footer_info_subtitle = get_field('footer_info_subtitle', 'footer_options');
$footer_info_text = get_field('footer_info_text', 'footer_options');
$footer_info_link_1 = get_field('footer_info_link_1', 'footer_options');
$footer_info_link_2 = get_field('footer_info_link_2', 'footer_options');

$footer_partner_links = get_field('footer_partner_links', 'footer_options');

$footer_bottom_link_1 = get_field('footer_bottom_link_1', 'footer_options');
$footer_bottom_link_2 = get_field('footer_bottom_link_2', 'footer_options');
$footer_copyright = get_field('footer_copyright', 'footer_options');
?>

<footer id="colophon" class="site-footer" data-theme="dark">
	<div class="site-footer__inner" data-aos="fade-up" data-aos-offset="200">

		<?php if (!empty($instagram_title) || !empty($instagram_link) || !empty($instagram_images)) : ?>
			<div class="site-footer__top">
				<div class="site-footer__top-head">
					<?php if (!empty($instagram_title)) : ?>
						<h2 class="site-footer__title main-title-h3">
							<?php echo wp_kses_post($instagram_title); ?>
						</h2>
					<?php endif; ?>

					<?php if (!empty($instagram_link['url']) && !empty($instagram_link['title'])) : ?>
						<a
							class="site-footer__social-link"
							href="<?php echo esc_url($instagram_link['url']); ?>"
							<?php echo !empty($instagram_link['target']) ? 'target="' . esc_attr($instagram_link['target']) . '"' : ''; ?>>
							<?php echo esc_html($instagram_link['title']); ?>
						</a>
					<?php endif; ?>
				</div>

				<?php if (!empty($instagram_images)) : ?>
					<div class="site-footer__slider swiper js-footer-slider">
						<div class="swiper-wrapper">
							<?php foreach ($instagram_images as $item) :
								$image = $item['image'] ?? null;
								$link = $item['link'] ?? null;

								if (empty($image)) {
									continue;
								}
							?>
								<div class="swiper-slide site-footer__slide">
									<?php if (!empty($link['url'])) : ?>
										<a
											class="site-footer__slide-link"
											href="<?php echo esc_url($link['url']); ?>"
											<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
											<img
												class="site-footer__slide-image"
												src="<?php echo esc_url($image['url']); ?>"
												alt="<?php echo esc_attr($image['alt'] ?: 'Footer image'); ?>"
												loading="lazy">
										</a>
									<?php else : ?>
										<div class="site-footer__slide-link">
											<img
												class="site-footer__slide-image"
												src="<?php echo esc_url($image['url']); ?>"
												alt="<?php echo esc_attr($image['alt'] ?: 'Footer image'); ?>"
												loading="lazy">
										</div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="site-footer__bottom">
			<div class="site-footer__columns">
				<div class="site-footer__menus site-footer__menus--desktop">
					<div class="site-footer__menu-col">
						<?php if (!empty($footer_explore_title)) : ?>
							<h3 class="site-footer__menu-title"><?php echo esc_html($footer_explore_title); ?></h3>
						<?php endif; ?>

						<?php if (!empty($footer_explore_links)) : ?>
							<ul class="site-footer__menu-list">
								<?php foreach ($footer_explore_links as $item) :
									$link = $item['link'] ?? null;
									if (empty($link['title'])) {
										continue;
									}
								?>
									<li class="site-footer__menu-item">
										<?php if (!empty($link['url'])) : ?>
											<a
												href="<?php echo esc_url($link['url']); ?>"
												<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
												<?php echo esc_html($link['title']); ?>
											</a>
										<?php else : ?>
											<span><?php echo esc_html($link['title']); ?></span>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>

					<div class="site-footer__menu-col">
						<?php if (!empty($footer_contact_title)) : ?>
							<h3 class="site-footer__menu-title"><?php echo esc_html($footer_contact_title); ?></h3>
						<?php endif; ?>

						<?php if (!empty($footer_contact_links)) : ?>
							<ul class="site-footer__menu-list">
								<?php foreach ($footer_contact_links as $item) :
									$link = $item['link'] ?? null;
									if (empty($link['title'])) {
										continue;
									}

									$url = $link['url'] ?? '';
									$is_hash_text = !empty($url) && strpos($url, '#') !== false;
								?>
									<li class="site-footer__menu-item">
										<?php if (!$is_hash_text && !empty($url)) : ?>
											<a
												href="<?php echo esc_url($url); ?>"
												<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
												<?php echo esc_html($link['title']); ?>
											</a>
										<?php else : ?>
											<span><?php echo esc_html($link['title']); ?></span>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>

				<div class="site-footer__menus-mobile">
					<?php if (!empty($footer_explore_links) || !empty($footer_explore_title)) : ?>
						<div class="site-footer__accordion-item main-accordion-item">
							<button
								class="site-footer__accordion-button main-accordion-button"
								type="button"
								aria-expanded="false">
								<span class="site-footer__accordion-title">
									<?php echo esc_html($footer_explore_title ?: 'Explore'); ?>
								</span>
								<svg xmlns="http://www.w3.org/2000/svg" class="site-footer__accordion-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M5 12H19" stroke="#F4EEE7" stroke-linecap="round" stroke-linejoin="round" />
									<path d="M12 5V19" stroke="#F4EEE7" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
							</button>

							<div class="site-footer__accordion-content">
								<div class="site-footer__accordion-inner">
									<?php if (!empty($footer_explore_links)) : ?>
										<ul class="site-footer__menu-list">
											<?php foreach ($footer_explore_links as $item) :
												$link = $item['link'] ?? null;
												if (empty($link['title'])) {
													continue;
												}
											?>
												<li class="site-footer__menu-item">
													<?php if (!empty($link['url'])) : ?>
														<a
															href="<?php echo esc_url($link['url']); ?>"
															<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
															<?php echo esc_html($link['title']); ?>
														</a>
													<?php else : ?>
														<span><?php echo esc_html($link['title']); ?></span>
													<?php endif; ?>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if (!empty($footer_contact_links) || !empty($footer_contact_title)) : ?>
						<div class="site-footer__accordion-item main-accordion-item">
							<button
								class="site-footer__accordion-button main-accordion-button"
								type="button"
								aria-expanded="false">
								<span class="site-footer__accordion-title">
									<?php echo esc_html($footer_contact_title ?: 'Contact'); ?>
								</span>
								<svg xmlns="http://www.w3.org/2000/svg" class="site-footer__accordion-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M5 12H19" stroke="#F4EEE7" stroke-linecap="round" stroke-linejoin="round" />
									<path d="M12 5V19" stroke="#F4EEE7" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
							</button>

							<div class="site-footer__accordion-content">
								<div class="site-footer__accordion-inner">
									<?php if (!empty($footer_contact_links)) : ?>
										<ul class="site-footer__menu-list">
											<?php foreach ($footer_contact_links as $item) :
												$link = $item['link'] ?? null;
												if (empty($link['title'])) {
													continue;
												}

												$url = $link['url'] ?? '';
												$is_hash_text = !empty($url) && strpos($url, '#') !== false;
											?>
												<li class="site-footer__menu-item">
													<?php if (!$is_hash_text && !empty($url)) : ?>
														<a
															href="<?php echo esc_url($url); ?>"
															<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
															<?php echo esc_html($link['title']); ?>
														</a>
													<?php else : ?>
														<span><?php echo esc_html($link['title']); ?></span>
													<?php endif; ?>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<div class="site-footer__info">
					<?php if (!empty($footer_info_subtitle)) : ?>
						<h3 class="site-footer__info-subtitle"><?php echo esc_html($footer_info_subtitle); ?></h3>
					<?php endif; ?>

					<?php if (!empty($footer_info_text)) : ?>
						<div class="site-footer__info-text">
							<?php echo wp_kses_post($footer_info_text); ?>
						</div>
					<?php endif; ?>

					<div class="site-footer__info-links">
						<?php if (!empty($footer_info_link_1['url']) && !empty($footer_info_link_1['title'])) : ?>
							<a
								class="main-link"
								href="<?php echo esc_url($footer_info_link_1['url']); ?>"
								<?php echo !empty($footer_info_link_1['target']) ? 'target="' . esc_attr($footer_info_link_1['target']) . '"' : ''; ?>>
								<?php echo esc_html($footer_info_link_1['title']); ?>
							</a>
						<?php endif; ?>

						<?php if (!empty($footer_info_link_2['url']) && !empty($footer_info_link_2['title'])) : ?>
							<a
								class="main-link"
								href="<?php echo esc_url($footer_info_link_2['url']); ?>"
								<?php echo !empty($footer_info_link_2['target']) ? 'target="' . esc_attr($footer_info_link_2['target']) . '"' : ''; ?>>
								<?php echo esc_html($footer_info_link_2['title']); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="site-footer__bottom-row">
				<div class="site-footer__partners" >
					<?php if (!empty($footer_partner_links)) : ?>
						<?php foreach ($footer_partner_links as $item) :
							$image = $item['image'] ?? null;
							$link = $item['link'] ?? null;

							if (empty($image)) {
								continue;
							}
						?>
							<?php if (!empty($link['url'])) : ?>
								<a
									class="site-footer__partner"
									href="<?php echo esc_url($link['url']); ?>"
									<?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Partner logo'); ?>" loading="lazy">
								</a>
							<?php else : ?>
								<div class="site-footer__partner">
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Partner logo'); ?>" loading="lazy">
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

				<div class="site-footer__legal">
					<?php if (!empty($footer_bottom_link_1['url']) && !empty($footer_bottom_link_1['title'])) : ?>
						<a
							href="<?php echo esc_url($footer_bottom_link_1['url']); ?>"
							<?php echo !empty($footer_bottom_link_1['target']) ? 'target="' . esc_attr($footer_bottom_link_1['target']) . '"' : ''; ?>>
							<?php echo esc_html($footer_bottom_link_1['title']); ?>
						</a>
						<span>
							—
						</span>
					<?php endif; ?>
					<?php if (!empty($footer_bottom_link_2['url']) && !empty($footer_bottom_link_2['title'])) : ?>
						<a
							href="<?php echo esc_url($footer_bottom_link_2['url']); ?>"
							<?php echo !empty($footer_bottom_link_2['target']) ? 'target="' . esc_attr($footer_bottom_link_2['target']) . '"' : ''; ?>>
							<?php echo esc_html($footer_bottom_link_2['title']); ?>
						</a>
						<span>
							—
						</span>
					<?php endif; ?>

					<?php if (!empty($footer_copyright)) : ?>
						<span><?php echo esc_html($footer_copyright); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
		<div class="team-modal footer-modal" aria-hidden="true">
		<div class="team-modal__overlay" data-close></div>
		<div class="team-modal__dialog contact-team-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="footer-modal-title">
 <button class="team-modal__close" type="button" data-close aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
              <path d="M2.63672 16.3643L15.3646 3.63634" stroke="white" stroke-linejoin="round" />
              <path d="M2.63672 3.63574L15.3646 16.3637" stroke="white" stroke-linejoin="round" />
            </svg>
            <span>Close</span>
          </button>
			<div class="team-modal__mount footer-team-modal__mount"></div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const sliders = document.querySelectorAll('.js-footer-slider');
		if (!sliders.length || typeof Swiper === 'undefined') return;

		sliders.forEach((slider) => {
			new Swiper(slider, {
				slidesPerView: 2.2,
				spaceBetween: 19,
				speed: 700,
				loop: true,
				autoplay: {
					delay: 1000,
				},
				breakpoints: {
					768: {
						slidesPerView: 3.8,
						spaceBetween: 24,
					}
				}
			});
		});
	});
</script>
<script>
/**
 * GLOBAL modal manager for any section
 * - Opens templates by [data-modal="#id"] into the nearest .team-modal within the same section/page part
 * - Re-inits CF7 on mount
 * - Normalizes file inputs (unique id/for, meta, size/type checks)
 * - Keeps focus trapped; supports close on overlay / [data-close] / Esc
 * - Restores last-opened modal after CF7 AJAX submit (sessionStorage)
 */

(function () {
  // ---------- Utilities ----------
  const html = document.documentElement;
  const STORAGE_KEY = 'globalModalToReopen';

  function closestContainerWithModal(fromEl) {
    let el = fromEl;
    while (el && el !== document) {
      if (el.querySelector && el.querySelector('.team-modal')) return el;
      el = el.parentElement;
    }
    return document;
  }

  function getModalParts(container) {
    const modal = container.querySelector('.team-modal');
    if (!modal) return {};
    const mount = modal.querySelector('.team-modal__mount');
    const overlay = modal.querySelector('.team-modal__overlay');
    const dialog = modal.querySelector('.team-modal__dialog');
    return { modal, mount, overlay, dialog };
  }

  function ensureId(el, prefix) {
    if (!el) return null;
    if (!el.id) {
      el.id = prefix + '-' + Date.now() + '-' + Math.random().toString(36).slice(2, 8);
    }
    return el.id;
  }

  // ---------- Submit button decorator (input->button) ----------
  function decorateSubmitButtons(scope) {
    const buttons = scope.querySelectorAll('.wpcf7-submit.contact-form-button');
    buttons.forEach(btn => {
      if (btn.tagName.toLowerCase() !== 'input') return;
      const newBtn = document.createElement('button');
      newBtn.type = 'submit';
      newBtn.className = btn.className;
      newBtn.innerHTML =
        '<span>' + (btn.value || 'Submit') + '</span>';
      btn.parentNode.replaceChild(newBtn, btn);
    });
  }

  // ---------- CF7 re-init ----------
  function initCF7(scope) {
    try {
      const forms = scope.querySelectorAll('.wpcf7 form');
      if (!forms.length) return;
      if (window.wpcf7?.init) {
        forms.forEach(f => window.wpcf7.init(f));
      } else if (window.wpcf7?.initForm) {
        forms.forEach(f => window.wpcf7.initForm(f));
      }
    } catch (_) {}
  }

  const FileDrop = (function () {
    function fmtMB(bytes) { return (bytes / (1024 * 1024)).toFixed(2) + ' MB'; }

    function ensureMeta(wrap) {
      let meta = wrap.querySelector('.file-drop__meta');
      if (!meta) {
        meta = document.createElement('div');
        meta.className = 'file-drop__meta';
        meta.setAttribute('aria-live', 'polite');
        wrap.appendChild(meta);
      }
      return meta;
    }

    function renderFileMeta(wrap, file) {
      const meta = ensureMeta(wrap);
      const labelText = wrap.querySelector('.file-drop__text');
      if (file) {
        const name = file.name || '';
        const size = Number.isFinite(file.size) ? fmtMB(file.size) : '';
        const out  = size ? (name + ' • ' + size) : name;
        meta.textContent = out;
        wrap.classList.add('has-file');
        if (labelText) labelText.style.visibility = 'hidden';
      } else {
        meta.textContent = '';
        wrap.classList.remove('has-file');
        if (labelText) labelText.style.visibility = '';
      }
    }

    function markError(wrap, msg) {
      wrap.classList.add('file-drop--error');
      const meta = ensureMeta(wrap);
      if (msg) meta.textContent = msg;
    }
    function clearError(wrap) { wrap.classList.remove('file-drop--error'); }

    let uid = 0;
    function ensureUniqueIdForInput(wrap) {
      const input = wrap.querySelector('input[type="file"]');
      const label = wrap.querySelector('label.file-drop__label');
      if (!input || !label) return;

      if (!input.id || document.querySelectorAll('#' + CSS.escape(input.id)).length > 1) {
        input.id = 'file-input-' + Date.now() + '-' + (uid++);
      }
      if (label.getAttribute('for') !== input.id) {
        label.setAttribute('for', input.id);
      }
    }

    function initWrap(wrap) {
      ensureUniqueIdForInput(wrap);
      const input = wrap.querySelector('input[type="file"]');
      if (!input) return;

      renderFileMeta(wrap, input.files && input.files[0] ? input.files[0] : null);

      function validateAndRender() {
        clearError(wrap);
        const f = input.files && input.files[0];
        if (!f) { renderFileMeta(wrap, null); return; }

        const maxMB = parseFloat(wrap.getAttribute('data-max') || '0');
        if (maxMB > 0 && Number.isFinite(f.size)) {
          const sizeMB = f.size / (1024 * 1024);
          if (sizeMB > maxMB) {
            markError(wrap, `File is too large (${fmtMB(f.size)}), max ${maxMB} MB`);
            try { input.value = ''; } catch(_) {}
            renderFileMeta(wrap, null);
            return;
          }
        }

        const accept = (input.getAttribute('accept') || '').trim();
        if (accept) {
          const ok = accept.split(',').map(s => s.trim()).some(rule => {
            if (!rule) return true;
            if (rule.endsWith('/*')) {
              const prefix = rule.slice(0, -1);
              return (f.type || '').startsWith(prefix);
            }
            return (f.type || '') === rule;
          });
          if (!ok) {
            markError(wrap, `File type not allowed (${f.type || 'unknown'})`);
            try { input.value = ''; } catch(_) {}
            renderFileMeta(wrap, null);
            return;
          }
        }

        renderFileMeta(wrap, f);
      }

      input.addEventListener('change', validateAndRender, true);
      input.addEventListener('input',  validateAndRender, true);
    }

    function sanitizeAllTemplates(scope) {
      scope.querySelectorAll('.team-modal-template input[type="file"]').forEach(inp => {
        if (inp.id) inp.removeAttribute('id');
        const lbl = inp.closest('.file-drop')?.querySelector('label.file-drop__label[for]');
        if (lbl) lbl.removeAttribute('for');
      });
    }

    function initScope(scope) {
      sanitizeAllTemplates(scope);
      scope.querySelectorAll('.file-drop').forEach(initWrap);
    }

    return { initScope };
  })();

  // ---------- Focus trap ----------
  function trapFocus(modal) {
    const focusables = () => modal.querySelectorAll('a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])');
    modal.__lastFocused = document.activeElement;

    function onTab(e) {
      if (e.key !== 'Tab') return;
      const list = Array.from(focusables()).filter(el => !el.hasAttribute('disabled'));
      if (!list.length) return;
      const first = list[0];
      const last  = list[list.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    }

    const listNow = Array.from(focusables()).filter(el => !el.hasAttribute('disabled'));
    if (listNow.length) listNow[0].focus();

    modal.addEventListener('keydown', onTab);
    modal.__onTabHandler = onTab;
  }

  function releaseFocus(modal) {
    if (modal.__onTabHandler) {
      modal.removeEventListener('keydown', modal.__onTabHandler);
      modal.__onTabHandler = null;
    }
    if (modal.__lastFocused && document.contains(modal.__lastFocused)) {
      modal.__lastFocused.focus();
    }
  }

  // ---------- Open/Close ----------
  function afterMount(container, selector) {
    const { modal, mount, dialog } = getModalParts(container);
    if (!modal || !mount) return;

    const title = mount.querySelector('.team-modal__title');
    if (title && dialog) {
      const titleId = ensureId(title, 'team-modal-title');
      dialog.setAttribute('aria-labelledby', titleId);
    }

    initCF7(mount);
    decorateSubmitButtons(mount);

    FileDrop.initScope(mount);

    const ev = new CustomEvent('team-modal:mounted', { detail: { mount } });
    document.dispatchEvent(ev);

    modal.dataset.origin = selector;

    trapFocus(modal);
  }

  function openModalFromTemplate(container, selector, trigger) {
    const { modal, mount } = getModalParts(container);
    if (!modal || !mount) return;
    const tpl = container.querySelector(selector) || document.querySelector(selector);
    if (!tpl) return;

    const wasOpen = modal.classList.contains('is-open');

    mount.innerHTML = tpl.innerHTML;
    if (!wasOpen) {
      modal.classList.add('is-open');
      modal.setAttribute('aria-hidden', 'false');
      html.classList.add('is-locked');
    }

    if (modal.__currentTrigger) modal.__currentTrigger.setAttribute('aria-expanded', 'false');
    modal.__currentTrigger = trigger || null;
    if (modal.__currentTrigger) modal.__currentTrigger.setAttribute('aria-expanded', 'true');

    afterMount(container, selector);
  }

  function closeModal(container) {
    const { modal, mount } = getModalParts(container);
    if (!modal || !mount) return;

    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    html.classList.remove('is-locked');
    mount.innerHTML = '';

    if (modal.__currentTrigger) {
      modal.__currentTrigger.setAttribute('aria-expanded', 'false');
      modal.__currentTrigger = null;
    }
    delete modal.dataset.origin;

    releaseFocus(modal);
  }

  // ---------- Global delegates ----------
  document.addEventListener('click', function (e) {
    const trigger = e.target.closest('[data-modal]');
    if (!trigger) return;

	if (trigger.hasAttribute('data-modal-local')) return;

    const selector = trigger.getAttribute('data-modal');
    if (!selector) return;

    const container = closestContainerWithModal(trigger);
    const { modal, overlay } = getModalParts(container);
    if (!modal) return;

    e.preventDefault();
    openModalFromTemplate(container, selector, trigger);

    if (!modal.__boundClose) {
      modal.__boundClose = true;

      // overlay click
      overlay && overlay.addEventListener('click', () => closeModal(container));

      // buttons with [data-close]
      modal.addEventListener('click', (evt) => {
        if (evt.target.hasAttribute('data-close') || evt.target.closest('[data-close]')) {
          closeModal(container);
        }
      });

      // Esc
      document.addEventListener('keydown', (evt) => {
        if (evt.key === 'Escape' && modal.classList.contains('is-open')) {
          closeModal(container);
        }
      });
    }
  });

  function initGlobal() {
    FileDrop.initScope(document);
    decorateSubmitButtons(document);
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initGlobal);
  } else {
    initGlobal();
  }

  // ---------- Restore modal after CF7 submit ----------

  document.addEventListener('submit', function (e) {
    const form = e.target.closest('.wpcf7 form');
    if (!form) return;

    const container = closestContainerWithModal(form);
    const { modal } = getModalParts(container);
    const modalId = ensureId(modal, 'team-modal');

    let selector = modal?.dataset?.origin || '';
    if (!selector) {
      const tpl = form.closest('.team-modal-template[id]');
      if (tpl) selector = '#' + tpl.id;
    }
    if (!selector) return;

    try {
      sessionStorage.setItem(STORAGE_KEY, JSON.stringify({ modalId, selector }));
    } catch (_) {}
  }, true);

  ['wpcf7mailsent','wpcf7invalid','wpcf7mailfailed'].forEach(evtName => {
    document.addEventListener(evtName, function (e) {
      const wrap = e.target; // .wpcf7
      if (!wrap) return;

      const container = closestContainerWithModal(wrap);
      const { modal } = getModalParts(container);
      if (!modal) return;

      if (modal.classList.contains('is-open')) return;

      const raw = sessionStorage.getItem(STORAGE_KEY);
      if (!raw) return;
      try {
        const data = JSON.parse(raw);
        if (!data || !data.selector) return;
        if (data.modalId && modal.id && data.modalId !== modal.id) return;

        openModalFromTemplate(container, data.selector);
      } catch (_) {}
    });
  });

  function restoreFromStorageOnLoad() {
    const raw = sessionStorage.getItem(STORAGE_KEY);
    if (!raw) return;
    try {
      const { modalId, selector } = JSON.parse(raw) || {};
      if (!selector) return;
      const modal = modalId ? document.getElementById(modalId) : document.querySelector('.team-modal');
      if (!modal) return;
      const container = modal.closest('[class]') || document;
      openModalFromTemplate(container, selector);
    } catch (_) {}
    sessionStorage.removeItem(STORAGE_KEY);
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', restoreFromStorageOnLoad);
  } else {
    restoreFromStorageOnLoad();
  }
})();
</script>

</body>

</html>