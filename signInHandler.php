<?php

require_once 'vendor/autoload.php';

try {
	$ticket = $_GET['ticket'] ?? '';
	$provider = $_GET['provider'] ?? '';

	if ( !$ticket )
		throw new \Exception( 'Something went wrong during auth process...', 403 );

	if ( !$provider )
		throw new \Exception( 'Social sign in provider missed...', 403 );

	$API = new \Cronycle\Api();
	$response = $API->postAuth( $provider, $ticket );

	if ( $response === null || !isset( $response[0]['auth_token'] ) )
		throw new \Exception( 'Authentication failed...', 403 );

	echo '<pre>';
	var_dump( $response );
	echo '</pre>';
}
catch ( \Exception $e )
{
	echo sprintf( 'Error occurred: %d - %s', $e->getCode(), $e->getMessage() );
}