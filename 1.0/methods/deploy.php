<?php

/// DEPLOY method - ready
$data = json_decode( file_get_contents( 'php://input' ), true );


// authorized senders
$auths = array(
	'Desertsnowman',
);


// allowed deployments
$deploy = array(
	'calderawp-api'			=>	'/var/api/calderawp-api',
	'cwp-theme'				=>	'/var/sites/calderawp.com/wp-content/themes/cwp-theme',
);


if( in_array( $data['sender']['login'], $auths ) && isset( $deploy[ $data['repository']['name'] ] ) ){

	// yup - 
	//do the git
	exec( "git -C " . $deploy[ $data['repository']['name'] ] . " pull", $output );
	
	error_log( implode("\r", $output ) );

	return array('success' => true );
}


return array( 'success' => false );