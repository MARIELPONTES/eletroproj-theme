<?php
/**
 * Campos extras: nível do post (filtro do guia) e dados do guia na categoria.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Níveis disponíveis (Figma: filtro do guia).
 *
 * @return array<string,string>
 */
function ep_levels(): array {
	return array(
		'basico'        => __( 'Básico', 'eletroproj' ),
		'intermediario' => __( 'Intermediário', 'eletroproj' ),
		'avancado'      => __( 'Avançado', 'eletroproj' ),
	);
}

/**
 * Registra o meta "ep_level" (também disponível na API REST/editor).
 */
function ep_register_meta(): void {
	register_post_meta(
		'post',
		'ep_level',
		array(
			'type'              => 'string',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => static fn( $v ) => array_key_exists( (string) $v, ep_levels() ) ? (string) $v : '',
			'auth_callback'     => static fn() => current_user_can( 'edit_posts' ),
		)
	);
	foreach ( array( 'ep_guide_title', 'ep_guide_code' ) as $key ) {
		register_term_meta(
			'category',
			$key,
			array(
				'type'              => 'string',
				'single'            => true,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
	}
}
add_action( 'init', 'ep_register_meta' );

/**
 * Caixa "Nível do conteúdo" na lateral do editor de posts.
 */
function ep_level_meta_box(): void {
	add_meta_box(
		'ep_level',
		__( 'Nível do conteúdo', 'eletroproj' ),
		static function ( WP_Post $post ): void {
			$current = (string) get_post_meta( $post->ID, 'ep_level', true );
			wp_nonce_field( 'ep_level', 'ep_level_nonce' );
			echo '<select name="ep_level" style="width:100%"><option value="">' . esc_html__( '— Sem nível —', 'eletroproj' ) . '</option>';
			foreach ( ep_levels() as $key => $label ) {
				printf( '<option value="%s"%s>%s</option>', esc_attr( $key ), selected( $current, $key, false ), esc_html( $label ) );
			}
			echo '</select><p class="description">' . esc_html__( 'Usado no filtro Básico / Intermediário / Avançado da página do guia.', 'eletroproj' ) . '</p>';
		},
		'post',
		'side'
	);
}
add_action( 'add_meta_boxes', 'ep_level_meta_box' );

/**
 * Salva o nível.
 *
 * @param int $post_id Post.
 */
function ep_save_level( int $post_id ): void {
	if ( ! isset( $_POST['ep_level_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['ep_level_nonce'] ) ), 'ep_level' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$level = isset( $_POST['ep_level'] ) ? sanitize_key( wp_unslash( $_POST['ep_level'] ) ) : '';
	if ( array_key_exists( $level, ep_levels() ) ) {
		update_post_meta( $post_id, 'ep_level', $level );
	} else {
		delete_post_meta( $post_id, 'ep_level' );
	}
}
add_action( 'save_post_post', 'ep_save_level' );

/**
 * Campos do guia na tela de edição da categoria (Posts › Categorias › Editar).
 *
 * @param WP_Term $term Categoria.
 */
function ep_category_fields( WP_Term $term ): void {
	wp_nonce_field( 'ep_term', 'ep_term_nonce' );
	$fields = array(
		'ep_guide_title' => array( __( 'Título do guia', 'eletroproj' ), __( 'Título grande da página da categoria. Ex.: Proteção contra descargas atmosféricas. Vazio = nome da categoria.', 'eletroproj' ) ),
		'ep_guide_code'  => array( __( 'Código no quadro do guia', 'eletroproj' ), __( 'Texto grande do quadro quadriculado. Ex.: NBR 5419. Vazio = nome da categoria.', 'eletroproj' ) ),
	);
	foreach ( $fields as $key => list( $label, $help ) ) {
		printf(
			'<tr class="form-field"><th scope="row"><label for="%1$s">%2$s</label></th><td><input name="%1$s" id="%1$s" type="text" value="%3$s"><p class="description">%4$s</p></td></tr>',
			esc_attr( $key ),
			esc_html( $label ),
			esc_attr( (string) get_term_meta( $term->term_id, $key, true ) ),
			esc_html( $help )
		);
	}
}
add_action( 'category_edit_form_fields', 'ep_category_fields' );

/**
 * Salva os campos do guia.
 *
 * @param int $term_id Categoria.
 */
function ep_save_category_fields( int $term_id ): void {
	if ( ! isset( $_POST['ep_term_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['ep_term_nonce'] ) ), 'ep_term' ) || ! current_user_can( 'manage_categories' ) ) {
		return;
	}
	foreach ( array( 'ep_guide_title', 'ep_guide_code' ) as $key ) {
		$value = isset( $_POST[ $key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) : '';
		if ( '' === $value ) {
			delete_term_meta( $term_id, $key );
		} else {
			update_term_meta( $term_id, $key, $value );
		}
	}
}
add_action( 'edited_category', 'ep_save_category_fields' );

/**
 * Minutos de leitura somados de uma categoria (cache de 12 h, limpo ao salvar posts).
 *
 * @param int $term_id Categoria.
 */
function ep_category_minutes( int $term_id ): int {
	$key    = 'ep_cat_min_' . $term_id;
	$cached = get_transient( $key );
	if ( false !== $cached ) {
		return (int) $cached;
	}
	$total = 0;
	foreach ( get_posts(
		array(
			'cat'            => $term_id,
			'posts_per_page' => 300,
			'no_found_rows'  => true,
		)
	) as $post ) {
		$total += ep_reading_time( $post );
	}
	set_transient( $key, $total, 12 * HOUR_IN_SECONDS );
	return $total;
}

add_action(
	'save_post_post',
	static function ( int $post_id ): void {
		foreach ( wp_get_post_categories( $post_id ) as $cat ) {
			delete_transient( 'ep_cat_min_' . $cat );
		}
	}
);

/**
 * "2h18" ou "45 min".
 *
 * @param int $minutes Minutos.
 */
function ep_format_minutes( int $minutes ): string {
	return $minutes >= 60 ? sprintf( '%dh%02d', intdiv( $minutes, 60 ), $minutes % 60 ) : sprintf( '%d min', $minutes );
}
