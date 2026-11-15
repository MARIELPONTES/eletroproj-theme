/*! Eletroproj — JS do tema (vanilla, defer). */
(() => {
	'use strict';

	const root = document.documentElement;
	const $ = (sel, ctx = document) => ctx.querySelector(sel);

	/* ---------- Tema claro/escuro (o valor salvo já foi aplicado no <head>) ---------- */
	const toggleTheme = () => {
		const next = root.dataset.theme === 'light' ? 'dark' : 'light';
		root.dataset.theme = next;
		try {
			localStorage.setItem('ep-theme', next);
		} catch (e) {
			/* Sem storage (navegação privada): vale só nesta página. */
		}
	};

	/* ---------- Menu mobile ---------- */
	const menuBtn = $('[data-menu-toggle]');
	const nav = $('#menu-principal');
	const setMenu = (open) => {
		if (!menuBtn || !nav) {
			return;
		}
		nav.classList.toggle('open', open);
		menuBtn.setAttribute('aria-expanded', String(open));
		menuBtn.setAttribute('aria-label', open ? 'Fechar menu' : 'Abrir menu');
	};

	/* ---------- Busca (<dialog>) ---------- */
	const search = $('#busca');
	const openSearch = () => {
		if (!search || search.open) {
			return;
		}
		setMenu(false);
		search.showModal();
		const input = $('input[name="s"]', search);
		if (input) {
			input.focus();
			input.select();
		}
	};

	document.addEventListener('click', (event) => {
		const t = event.target;
		if (t.closest('[data-theme-toggle]')) {
			toggleTheme();
		} else if (t.closest('[data-menu-toggle]')) {
			setMenu(menuBtn.getAttribute('aria-expanded') !== 'true');
		} else if (t.closest('[data-search-open]')) {
			openSearch();
		} else if (t.closest('[data-search-close]') || t === search) {
			/* Botão fechar ou clique no fundo escuro (fora do conteúdo). */
			search.close();
		} else if (nav && nav.classList.contains('open') && !t.closest('.site-header')) {
			setMenu(false);
		}
	});

	document.addEventListener('keydown', (event) => {
		if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'k') {
			event.preventDefault();
			openSearch();
		} else if (event.key === 'Escape' && nav && nav.classList.contains('open')) {
			setMenu(false);
			menuBtn.focus();
		}
	});
})();
