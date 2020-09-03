<?php

/**
 * 
 * Class to handle blog posts
 *
**/

require_once('config.php');

require_once(CLASS_PATH . '/' . 'ContentManagementClass.php');
require_once(CLASS_PATH . '/' . 'BlogPost.php');

class Blog extends ContentManagementClass{

  protected $content_items_folder = CONTENT_PATH . '/blog_posts/';
  protected $content_items_list_file = '_active_blog_posts.txt';

  protected function construct_content_item($content_item_name) {
    $blog_post = new BlogPost($this->content_items_folder . $content_item_name);
    return $blog_post;
  }

  /* Methods for navigating the blog */
  public function next_blog_post() {
    $this->change_current_item_by_index($this->current_content_item_idx + 1);
  }

  public function previous_blog_post() {
    $this->change_current_item_by_index($this->current_content_item_idx - 1);
  }

  public function next_post_exists() {
    return $this->check_valid_item_index($this->current_content_item_idx + 1);
  }

  public function previous_post_exists() {
    return $this->check_valid_item_index($this->current_content_item_idx - 1);
  }
}