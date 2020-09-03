<?php

/**
 * 
 * Class to handle blog posts
 *
**/

require_once('config.php');

require_once(CLASS_PATH . '/' . 'ContentManagementClass.php');
require_once(CLASS_PATH . '/' . 'Project.php');

class ProjectsList extends ContentManagementClass{

  protected $content_items_folder = CONTENT_PATH . '/projects/';
  protected $content_items_list_file = '_active_projects.txt';

  protected function construct_content_item($content_item_name) {
    $project = new Project($this->content_items_folder, $content_item_name);
    return $project;
  }
}
