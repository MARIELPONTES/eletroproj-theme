/**
 * Eletroproj Editorial — interações leves (sem dependências).
 */
( function () {
	'use strict';

	var doc = document.documentElement;
	var i18n = window.eletroprojI18n || { copiar: 'Copiar', copiado: 'Copiado!', link: 'Link copiado!' };

	/* Menu no mobile ------------------------------------------------------ */
	var toggle = document.querySelector( '.menu-toggle' );
	var nav = document.getElementById( 'primary-nav' );
	if ( toggle && nav ) {
		var closeMenu = function () {
			nav.classList.remove( 'is-open' );
			toggle.setAttribute( 'aria-expanded', 'false' );
		};
		toggle.addEventListener( 'click', function () {
			var open = nav.classList.toggle( 'is-open' );
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			if ( open ) {
				var first = nav.querySelector( 'a' );
				if ( first ) {
					first.focus();
				}
			}
		} );
		document.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key && nav.classList.contains( 'is-open' ) ) {
				closeMenu();
				toggle.focus();
			}
		} );
		document.addEventListener( 'click', function ( e ) {
			if ( nav.classList.contains( 'is-open' ) && ! nav.contains( e.target ) && ! toggle.contains( e.target ) ) {
				closeMenu();
			}
		} );
	}

	/* Modo claro/escuro ---------------------------------------------------- */
	var themeBtn = document.querySelector( '.theme-toggle' );
	if ( themeBtn ) {
		var current = function () {
			return doc.getAttribute( 'data-theme' ) === 'dark' ? 'dark' : 'light';
		};
		var syncPressed = function () {
			themeBtn.setAttribute( 'aria-pressed', current() === 'dark' ? 'true' : 'false' );
		};
		syncPressed();
		themeBtn.addEventListener( 'click', function () {
			var next = current() === 'dark' ? 'light' : 'dark';
			doc.setAttribute( 'data-theme', next );
			try {
				localStorage.setItem( 'eletroproj-tema', next );
				localStorage.setItem( 'eletroproj-tema-base', doc.getAttribute( 'data-tema-padrao' ) || 'sistema' );
			} catch ( e ) {}
			syncPressed();
		} );
	}

	/* Barra de progresso de leitura --------------------------------------- */
	var bar = document.querySelector( '.progress__bar' );
	var article = document.querySelector( '.entry-content' );
	if ( bar && article ) {
		var ticking = false;
		var update = function () {
			var rect = article.getBoundingClientRect();
			var total = rect.height - window.innerHeight;
			var done = total > 0 ? Math.min( 1, Math.max( 0, -rect.top / total ) ) : 1;
			bar.style.setProperty( '--progresso', done.toFixed( 4 ) );
			ticking = false;
		};
		window.addEventListener(
			'scroll',
			function () {
				if ( ! ticking ) {
					window.requestAnimationFrame( update );
					ticking = true;
				}
			},
			{ passive: true }
		);
		update();
	}

	/* Copiar texto -------------------------------------------------------- */
	var copyText = function ( text ) {
		if ( navigator.clipboard && window.isSecureContext ) {
			return navigator.clipboard.writeText( text );
		}
		return new Promise( function ( resolve, reject ) {
			var ta = document.createElement( 'textarea' );
			ta.value = text;
			ta.setAttribute( 'readonly', '' );
			ta.style.position = 'fixed';
			ta.style.opacity = '0';
			document.body.appendChild( ta );
			ta.select();
			try {
				document.execCommand( 'copy' );
				resolve();
			} catch ( e ) {
				reject( e );
			}
			document.body.removeChild( ta );
		} );
	};

	// Botão "Copiar" nos blocos de código.
	document.querySelectorAll( '.entry-content pre' ).forEach( function ( pre ) {
		var btn = document.createElement( 'button' );
		btn.type = 'button';
		btn.className = 'copy-code';
		btn.textContent = i18n.copiar;
		btn.addEventListener( 'click', function () {
			var code = pre.querySelector( 'code' ) || pre;
			copyText( code.innerText.replace( new RegExp( i18n.copiar + '$' ), '' ).trim() ).then( function () {
				btn.textContent = i18n.copiado;
				setTimeout( function () {
					btn.textContent = i18n.copiar;
				}, 1800 );
			} );
		} );
		pre.appendChild( btn );
	} );

	// Copiar link do artigo.
	document.querySelectorAll( '[data-copy-link]' ).forEach( function ( btn ) {
		var original = btn.textContent;
		btn.addEventListener( 'click', function () {
			copyText( btn.getAttribute( 'data-copy-link' ) ).then( function () {
				btn.textContent = i18n.link;
				setTimeout( function () {
					btn.textContent = original;
				}, 1800 );
			} );
		} );
	} );

	/* Sumário: destaca a seção visível ------------------------------------ */
	var tocLinks = document.querySelectorAll( '.toc__item a' );
	if ( tocLinks.length && 'IntersectionObserver' in window ) {
		// O mesmo título pode ter dois links (índice lateral e índice do celular).
		var map = {};
		tocLinks.forEach( function ( a ) {
			var id = decodeURIComponent( a.hash.slice( 1 ) );
			( map[ id ] = map[ id ] || [] ).push( a );
		} );
		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting && map[ entry.target.id ] ) {
						tocLinks.forEach( function ( a ) {
							a.classList.remove( 'is-active' );
							a.removeAttribute( 'aria-current' );
						} );
						map[ entry.target.id ].forEach( function ( a ) {
							a.classList.add( 'is-active' );
							a.setAttribute( 'aria-current', 'location' );
						} );
					}
				} );
			},
			{ rootMargin: '0px 0px -70% 0px' }
		);
		Object.keys( map ).forEach( function ( id ) {
			var el = document.getElementById( id );
			if ( el ) {
				observer.observe( el );
			}
		} );
	}
} )();
