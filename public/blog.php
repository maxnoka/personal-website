<?php
require_once('../private/config/config.php');
require_once( VIEW_PATH . "/MyView.php" );
require_once( CLASS_PATH . "/BlogClass.php" );

$show_all_posts = isset($_GET['show_all_posts']) ? True : False;

$search_tag = (isset($_GET['search_tag'])) ? htmlspecialchars( $_GET['search_tag'] ) : NULL;

$post_no = (isset($_GET['post_no']) && ctype_digit(strval($_GET['post_no']))) ? intval( $_GET['post_no'] ) : NULL;

$blog = new Blog();

if ($show_all_posts == True || $search_tag !== NULL) {
	$view = new MyView($additional_styles = array("blog.css"), $content_file = NULL, $sub_template = 'blog_post_list.html');
	$view->search_tag = $search_tag;
}
else { // i.e. show an individual post
	$view = new MyView($additional_styles = array("blog.css"), $content_file = NULL, $sub_template = 'blog_base.html');
	if ( $post_no !==  NULL) {
      if ($blog->change_current_item_by_index($post_no) == False) {
      	// didn't find the post
      	// TODO add content not found page
      	$view = new MyView($additional_styles = array("blog.css"), $content_file = NULL, $sub_template = 'blog_post_list.html');
      	$view->search_tag = $search_tag;
      };
    }
}

$view->blog = $blog;
$view->title = 'Blog';
$view->render();
?>
