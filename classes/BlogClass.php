<?php
require_once(CLASS_PATH . '/' . 'BlogPost.php');

/**
 * 
 * Class to handle blog posts
 *
**/

class Blog {
  public $all_blog_posts_names = NULL;
  public $current_blog_post_index = NULL;
  public $search_tag = NULL;

  public $all_blog_posts = array();

  private $blog_post_list_file= CONTENT_PATH . '/blog_posts/_active_blog_posts.txt';

  public function __construct($post_no, $search_tag) {
    $txt_file = file_get_contents($this->blog_post_list_file);

    $this->all_blog_posts_names = explode("\n", $txt_file);

    foreach ($this->all_blog_posts_names as $blog_post_name) {
      $blog_post = new BlogPost(CONTENT_PATH . '/blog_posts/' . $blog_post_name);
      $this->all_blog_posts[] = $blog_post;
    }
    
    // default is the most recent one / last line of the blog posts text file
    $this->change_current_blog_post(count($this->all_blog_posts_names) - 1); 
    // can also set with _GET parameter
    if ( $post_no !==  NULL) {
      $this->change_current_blog_post($post_no);
    }

    $this->search_tag = $search_tag;
  }

  public function change_current_blog_post($target_blog_post_index) {
    if ($this->check_valid_blog_post_index($target_blog_post_index)) {
      $this->current_blog_post_index = $target_blog_post_index;
    }
    else {
      echo 'Blog post not found';
    }
    
  }

  private function check_valid_blog_post_index($blog_post_index) {
    return array_key_exists($blog_post_index, $this->all_blog_posts_names);
  }

  public function next_blog_post() {
    $this->change_current_blog_post($this->current_blog_post_index + 1);
  }

  public function previous_blog_post() {
    $this->change_current_blog_post($this->current_blog_post_index - 1);
  }

  public function next_post_exists() {
    return $this->check_valid_blog_post_index($this->current_blog_post_index + 1);
  }

  public function previous_post_exists() {
    return $this->check_valid_blog_post_index($this->current_blog_post_index - 1);
  }

  public function get_current_blog_post() {
    return $this->all_blog_posts[$this->current_blog_post_index];
  }

  public function get_posts_with_tag($search_tag) {
    $filtered_posts = array();
    foreach ($this->all_blog_posts as $blog_post) {
      if (in_array($search_tag, $blog_post->tags)) {
        $filtered_posts[] = $blog_post;
      }
    }
    return $filtered_posts;
  }
}