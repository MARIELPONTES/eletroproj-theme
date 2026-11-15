<?php
/**
 * Envio da newsletter para a Brevo (API v3), no servidor — sem script externo na página.
 * Configuração: Aparência › Personalizar › Eletroproj › Newsletter (Brevo).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Recebe o formulário, cadastra o contato na lista e volta para a página com ?nl=ok|erro.
 */
function ep_newsletter_submit(): void {
	$back = isset( $_POST['ep_back'] ) ? esc_url_raw( wp_unslash( $_POST['ep_back'] ) ) : home_url( '/' );
	$back = wp_validate_redirect( $back, home_url( '/' ) );
	$fail = static function () use ( $back ): void {
		wp_safe_redirect( add_query_arg( 'nl', 'erro', $back ) . '#newsletter' );
		exit;
	};

	if ( ! isset( $_POST['ep_nl_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['ep_nl_nonce'] ) ), 'ep_newsletter' ) ) {
		$fail();
	}
	// Honeypot: robôs preenchem o campo escondido.
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'nl', 'ok', $back ) . '#newsletter' );
		exit;
	}

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$key   = trim( (string) ep_opt( 'ep_brevo_key' ) );
	$list  = (int) ep_opt( 'ep_brevo_list' );

	if ( ! is_email( $email ) || '' === $key || ! $list ) {
		$fail();
	}

	$response = wp_remote_post(
		'https://api.brevo.com/v3/contacts',
		array(
			'timeout' => 10,
			'headers' => array(
				'api-key'      => $key,
				'accept'       => 'application/json',
				'content-type' => 'application/json',
			),
			'body'    => wp_json_encode(
				array(
					'email'         => $email,
					'listIds'       => array( $list ),
					'updateEnabled' => true,
				)
			),
		)
	);

	$code = (int) wp_remote_retrieve_response_code( $response );
	if ( is_wp_error( $response ) || $code < 200 || $code >= 300 ) {
		$fail();
	}

	wp_safe_redirect( add_query_arg( 'nl', 'ok', $back ) . '#newsletter' );
	exit;
}
add_action( 'admin_post_nopriv_ep_newsletter', 'ep_newsletter_submit' );
add_action( 'admin_post_ep_newsletter', 'ep_newsletter_submit' );
