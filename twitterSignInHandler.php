<?php

try {
	$ticket = $_GET['ticket'] ?? '';

	// If no state or code throw an exception
	if ( !$ticket )
		throw new \Exception( 'Something went wrong during auth process...', 403 );

	// Getting user object from backend
	$ch = curl_init( 'https://api.cronycle.com/v5/auth/twitter2/post-auth?ticket='.$ticket );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );

	$response = curl_exec( $ch );
	$json = json_decode( $response, true );

	curl_close( $ch );

	if ( $json === null || !isset( $json[0]['auth_token'] ) )
		throw new \Exception( 'Authentication failed...', 403 );

	echo '<pre>';
	var_dump( $json );
	echo '</pre>';
}
catch ( \Exception $e )
{
	echo sprintf( 'Error occurred: %d - %s', $e->getCode(), $e->getMessage() );
}