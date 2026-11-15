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

	/* ---------- Sumário: item ativo conforme a rolagem ---------- */
	const toc = $('[data-toc]');
	if (toc && 'IntersectionObserver' in window) {
		const links = [...toc.querySelectorAll('a')];
		const byId = new Map(links.map((a) => [decodeURIComponent(a.hash.slice(1)), a]));
		const heads = [...byId.keys()].map((id) => document.getElementById(id)).filter(Boolean);
		const setActive = (id) => links.forEach((a) => a.classList.toggle('active', a === byId.get(id)));
		/* Sem leituras de layout: usa só os dados que o observer entrega (evita "forced reflow"). */
		const io = new IntersectionObserver(
			(entries) => {
				entries.forEach((e) => {
					const i = heads.indexOf(e.target);
					if (e.isIntersecting) {
						setActive(e.target.id);
					} else if (e.boundingClientRect.top > e.rootBounds.top && i > 0) {
						setActive(heads[i - 1].id); // título saiu por baixo: volta ao anterior
					}
				});
			},
			{ rootMargin: '-170px 0px -55% 0px' }
		);
		heads.forEach((h) => io.observe(h));
		if (heads[0]) {
			setActive(heads[0].id);
		}
	}

	/* Sumário do mobile fecha ao escolher um item. */
	document.querySelectorAll('.mobile-toc a').forEach((a) => {
		a.addEventListener('click', () => a.closest('details').removeAttribute('open'));
	});

	/* ---------- Guia: filtro por nível ---------- */
	const filter = $('[data-level-filter]');
	if (filter) {
		filter.addEventListener('click', (event) => {
			const btn = event.target.closest('button[data-level]');
			if (!btn) {
				return;
			}
			const level = btn.dataset.level;
			filter.querySelectorAll('button').forEach((b) => b.setAttribute('aria-pressed', String(b === btn)));
			document.querySelectorAll('[data-chapter]').forEach((row) => {
				row.hidden = level !== 'todos' && row.dataset.chapter !== level;
			});
		});
	}
})();
