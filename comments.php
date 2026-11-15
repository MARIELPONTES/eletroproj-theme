<?php
/**
 * Comentários (não há tela no Figma: lista e formulário com os componentes do Figma —
 * rótulo mono, título condensado, campos e botão padrão).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}

$ep_count = (int) get_comments_number();
?>
<section class="comments" id="comentarios" aria-labelledby="comentarios-titulo">
	<span class="section-number"><?php esc_html_e( 'Comentários', 'eletroproj' ); ?></span>
	<h2 id="comentarios-titulo">
		<?php
		echo esc_html(
			$ep_count
				? sprintf( /* translators: %d: número de comentários */ _n( '%d comentário', '%d comentários', $ep_count, 'eletroproj' ), $ep_count )
				: __( 'Deixe sua dúvida ou contribuição', 'eletroproj' )
		);
		?>
	</h2>

	<?php if ( have_comments() ) : ?>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 0,
					'callback'    => 'ep_comment',
				)
			);
			?>
		</ol>
		<?php
		the_comments_pagination(
			array(
				'prev_text' => __( 'Anteriores', 'eletroproj' ),
				'next_text' => __( 'Próximos', 'eletroproj' ),
			)
		);
		?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply'          => __( 'Escreva um comentário', 'eletroproj' ),
			'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h3>',
			'label_submit'         => __( 'Publicar comentário', 'eletroproj' ),
			'class_submit'         => 'btn btn-primary',
			'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Seu e-mail não será publicado.', 'eletroproj' ) . '</p>',
		)
	);
	?>
</section>
