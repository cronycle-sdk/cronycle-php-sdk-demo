<?php

require_once 'vendor/autoload.php';

try
{
	$API = new \Cronycle\Api();
	$API->logInWithGoogle( 'http://phpsdk-demo.dev/googleSignInHandler.php' );
}
catch ( \Exception $e )
{
	echo sprintf( 'Error occurred: %d - %s', $e->getCode(), $e->getMessage() );
}