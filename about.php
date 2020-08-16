<?php
require('config.php');

$view = new MyView($content_file = 'about_me.html');
$view->title = 'About Me';
$view->render();
?>
