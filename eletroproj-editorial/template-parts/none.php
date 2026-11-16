<?php
/**
 * Nada encontrado.
 *
 * @package Eletroproj
 */

?>
<div class="empty-state">
	<h2><?php esc_html_e( 'Nada encontrado', 'eletroproj' ); ?></h2>
	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Nenhum artigo corresponde à sua busca. Tente outras palavras, por exemplo o número da norma (NBR 5410) ou o nome do componente.', 'eletroproj' ); ?></p>
	<?php else : ?>
		<p><?php esc_html_e( 'Ainda não há artigos aqui. Que tal buscar por um assunto?', 'eletroproj' ); ?></p>
	<?php endif; ?>
	<?php get_search_form(); ?>
</div>
