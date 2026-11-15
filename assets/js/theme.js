/*! Eletroproj — JS do tema (vanilla, defer). */
(() => {
	'use strict';

	const root = document.documentElement;

	/* Tema claro/escuro: o valor salvo já foi aplicado no <head>; aqui só a troca. */
	document.addEventListener('click', (event) => {
		const toggle = event.target.closest('[data-theme-toggle]');
		if (!toggle) {
			return;
		}
		const next = root.dataset.theme === 'light' ? 'dark' : 'light';
		root.dataset.theme = next;
		try {
			localStorage.setItem('ep-theme', next);
		} catch (e) {
			/* Navegação privada sem storage: a troca vale só nesta página. */
		}
	});
})();
