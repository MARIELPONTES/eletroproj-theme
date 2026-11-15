<?php
/**
 * Formulário de orçamento da página de serviço: envio por e-mail (wp_mail), sem plugin.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Opções de "Tipo de imóvel" (Figma).
 *
 * @return string[]
 */
function ep_quote_types(): array {
	return array( 'Condomínio residencial', 'Indústria', 'Comércio', 'Outro' );
}

/**
 * Recebe o pedido, envia o e-mail e volta com ?orcamento=ok|erro.
 */
function ep_quote_submit(): void {
	$back = isset( $_POST['ep_back'] ) ? esc_url_raw( wp_unslash( $_POST['ep_back'] ) ) : home_url( '/' );
	$back = wp_validate_redirect( $back, home_url( '/' ) );
	$go   = static function ( string $state ) use ( $back ): void {
		wp_safe_redirect( add_query_arg( 'orcamento', $state, $back ) . '#orcamento' );
		exit;
	};

	if ( ! isset( $_POST['ep_quote_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['ep_quote_nonce'] ) ), 'ep_quote' ) ) {
		$go( 'erro' );
	}
	if ( ! empty( $_POST['website'] ) ) {
		$go( 'ok' ); // Robô: finge sucesso e não envia.
	}

	$nome     = isset( $_POST['nome'] ) ? sanitize_text_field( wp_unslash( $_POST['nome'] ) ) : '';
	$email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$telefone = isset( $_POST['telefone'] ) ? sanitize_text_field( wp_unslash( $_POST['telefone'] ) ) : '';
	$tipo     = isset( $_POST['tipo'] ) ? sanitize_text_field( wp_unslash( $_POST['tipo'] ) ) : '';
	$mensagem = isset( $_POST['mensagem'] ) ? sanitize_textarea_field( wp_unslash( $_POST['mensagem'] ) ) : '';

	if ( '' === $nome || ! is_email( $email ) || '' === $telefone ) {
		$go( 'erro' );
	}
	if ( ! in_array( $tipo, ep_quote_types(), true ) ) {
		$tipo = 'Outro';
	}

	$to   = sanitize_email( (string) ep_opt( 'ep_quote_email' ) );
	$to   = is_email( $to ) ? $to : get_option( 'admin_email' );
	$body = "Novo pedido de orçamento pelo site\n\n"
		. "Nome: {$nome}\nE-mail: {$email}\nTelefone: {$telefone}\nTipo de imóvel: {$tipo}\n\nMensagem:\n{$mensagem}\n\n"
		. 'Página: ' . $back . "\n";

	$sent = wp_mail(
		$to,
		'Orçamento pelo site — ' . $nome,
		$body,
		array( 'Reply-To: ' . $nome . ' <' . $email . '>' )
	);

	$go( $sent ? 'ok' : 'erro' );
}
add_action( 'admin_post_nopriv_ep_quote', 'ep_quote_submit' );
add_action( 'admin_post_ep_quote', 'ep_quote_submit' );
