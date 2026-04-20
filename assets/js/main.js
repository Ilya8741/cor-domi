document.addEventListener('DOMContentLoaded', () => {
	initMainAccordion();
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
