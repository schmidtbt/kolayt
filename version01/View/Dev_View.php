<?php
error_reporting(E_ALL & ~ E_DEPRECATED );
ini_set('log_errors', '1' );
ini_set('display_errors', '1' );

// Utility for displaying Views via serialized objects

if( !isset( $_GET['view'] ) ){
	echo "Please specify a view URL param. For example, www.kolayt.com/?view=<aviewname>&data=<pathtodata>";
}


if( !isset( $_GET['data'] ) ){
	$_GET['data'] = "";
	$data = array();
} else {
	// Fetch data from stored serialized
	$data = unserialize( file_get_contents($_GET['data']) ); // Fix path to data
}


$viewname = $_GET['view'];




@require_once('Kore_autoload.php');
@require_once('kore/View/Kore_View.class.php');

// Setup and display the view using the info provided
$view = new Kore_View( $data ); 
echo $view->render( $viewname );


?>