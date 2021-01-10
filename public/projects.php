<?php
require_once('../private/config/config.php');
require_once( VIEW_PATH . "/MyView.php" );
require_once( CLASS_PATH . "/ProjectsListClass.php" );

$search_tag = (isset($_GET['search_tag'])) ? htmlspecialchars( $_GET['search_tag'] ) : NULL;

$project_name = (isset($_GET['project_name'])) ? htmlspecialchars( $_GET['project_name'] ) : NULL;

$projects_list = new ProjectsList();

if ($project_name == NULL) {
  $view = new MyView($additional_styles = array("projects.css"), $content_file = NULL, $sub_template = 'project_list.html');
  $view->title = 'All Projects';
}
else {

  $view = new MyView($additional_styles = array("projects.css"), $content_file = NULL, $sub_template = 'project_base.html');
  $projects_list->change_current_item_by_name($project_name);
  $view->title = 'Projects: ' . $project_name;
}

$view->search_tag = $search_tag;
$view->projects_list = $projects_list;


$view->render();
?>
