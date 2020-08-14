<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

include_once('MyView.php');
$t = new MyView();
$t->title = 'About Me';
$t->render('about_me.html');
?>
