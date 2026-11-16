<?php
/**
 * Comentários.
 *
 * @package Eletroproj
 */

if ( post_password_required() ) {
	return;
}
?>
<section id="comentarios" class="comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments__title">
			<?php
			/* translators: %s: número de comentários */
			printf( esc_html( _n( '%s comentário', '%s comentários', (int) get_comments_number(), 'eletroproj' ) ), esc_html( number_format_i18n( get_comments_number() ) ) );
			?>
		</h2>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="comments__closed"><?php esc_html_e( 'Os comentários estão fechados.', 'eletroproj' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply'        => __( 'Deixe um comentário', 'eletroproj' ),
			'title_reply_before' => '<h2 id="reply-title" class="comments__title">',
			'title_reply_after'  => '</h2>',
			'label_submit'       => __( 'Publicar comentário', 'eletroproj' ),
			'class_submit'       => 'button',
		)
	);
	?>
</section>
