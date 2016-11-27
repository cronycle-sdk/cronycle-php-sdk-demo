<?php

require_once 'vendor/autoload.php';

try
{
	$API = new \Cronycle\Api();
	$accounts = $API->logIn( 'demosdk@cronycle.com', 'lifeafterboards2016' );

	if ( isset( $accounts['errors'] ) )
		throw new \Exception( $accounts['errors'], 403 );

	$API->useAccount( $accounts[0]['auth_token'] );

	$boards = $API->getBoardsList();
	$boardId = $boards[0]['id'];

	$board = $API->getBoardDetails( $boardId );
	$articles = $API->getBoardArticles( $boardId, [ 'per_page' => 2, 'page' => 1, ] );

	echo '<pre>';
	var_dump( $boards );
	var_dump( $board );
	var_dump( $articles );
	echo '</pre>';
}
catch ( \Exception $e )
{
	echo sprintf( 'Error occurred: %d - %s', $e->getCode(), $e->getMessage() );
}