document.addEventListener('DOMContentLoaded', () => {
	initMainAccordion();
	initSingleOpenAccordions();
});

function initMainAccordion() {
	const buttons = document.querySelectorAll('.main-accordion-button');
	if (!buttons.length) return;

	buttons.forEach((btn) => {
		btn.addEventListener('click', () => {
			const item = btn.closest('.main-accordion-item');
			if (!item) return;

			const isOpen = item.classList.contains('is-open');

			item.classList.toggle('is-open', !isOpen);
			btn.setAttribute('aria-expanded', (!isOpen).toString());
		});
	});
}

function initSingleOpenAccordions() {
	const wrappers = document.querySelectorAll(
		'section.service-content, .article-sticky-section__bottom-content'
	);

	if (!wrappers.length) return;

	wrappers.forEach((wrapper) => {
		const buttons = wrapper.querySelectorAll('.main-accordion-button');
		if (!buttons.length) return;

		buttons.forEach((btn) => {
			btn.addEventListener(
				'click',
				(event) => {
					event.preventDefault();
					event.stopPropagation();

					const currentItem = btn.closest('.main-accordion-item');
					if (!currentItem) return;

					const allItems = wrapper.querySelectorAll('.main-accordion-item');
					const isCurrentOpen = currentItem.classList.contains('is-open');

					allItems.forEach((item) => {
						const itemButton = item.querySelector('.main-accordion-button');

						// текущий закрываем, если он был открыт
						// остальные закрываем всегда
						const shouldOpen = item === currentItem ? !isCurrentOpen : false;

						item.classList.toggle('is-open', shouldOpen);

						if (itemButton) {
							itemButton.setAttribute('aria-expanded', shouldOpen.toString());
						}
					});
				},
				true
			);
		});
	});
}