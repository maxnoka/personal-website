<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

define( "TEMPLATE_PATH", "templates" );
define( "STYLE_PATH", "styles" );
define( "CONTENT_PATH", "content" );
define( "CLASS_PATH", "classes" );

require( CLASS_PATH . "/MyView.php" );


// function handleException( $exception ) {
//   echo "Sorry, a problem occurred. Please try later.";
//   error_log( $exception->getMessage() );
// }

// set_exception_handler( 'handleException' );
?>
