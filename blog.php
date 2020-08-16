<?php
require('config.php');

$show_all_posts = isset($_GET['show_all_posts']) ? True : False;

$search_tag = (isset($_GET['search_tag'])) ? htmlspecialchars( $_GET['search_tag'] ) : NULL;

$post_no = (isset($_GET['post_no']) && ctype_digit(strval($_GET['post_no']))) ? intval( $_GET['post_no'] ) : NULL;

$blog = new Blog($post_no, $search_tag);

if ($show_all_posts == True || $search_tag !== NULL) {
	$view = new MyView($content_file = NULL, $sub_template = 'blog_post_list.html');
}
else { // i.e. show and individual post
	$view = new MyView($content_file = NULL, $sub_template = 'blog_base.html');
}

$view->blog = $blog;
$view->title = 'Blog';
$view->render();
?>
