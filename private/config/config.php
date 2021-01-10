<?php
define("DEBUG_ENABLED", True);

function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}

if (DEBUG_ENABLED) {
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
}
else {
	set_exception_handler( 'handleException' );
}

// private - used only in php files
define( "VIEW_PATH", __DIR__ . "/../views" );
define( "TEMPLATE_PATH", VIEW_PATH . "/templates" );
define( "CLASS_PATH", __DIR__ . "/../classes" );
define( "CONTENT_PATH", __DIR__ . "/../personal-website-content" );

// public - also used in templates
define( "STYLE_PATH",  "styles" );
define( "SCRIPT_PATH", "scripts" );
?>
