<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

define( "TEMPLATE_PATH", "templates" );
define( "CONTENT_PATH", "content" );
define( "CLASS_PATH", "classes" );

require( CLASS_PATH . "/BlogClass.php" );
require( CLASS_PATH . "/MyView.php" );

// function handleException( $exception ) {
//   echo "Sorry, a problem occurred. Please try later.";
//   error_log( $exception->getMessage() );
// }

// set_exception_handler( 'handleException' );
?>
