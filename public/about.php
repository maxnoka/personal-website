<?php
require_once('../private/config/config.php');
require_once( VIEW_PATH . "/MyView.php" );

$view = new MyView($additional_styles = array("about_me.css"), $content_file = 'about_me.html');
$view->title = 'About Me';
$view->render();
?>
