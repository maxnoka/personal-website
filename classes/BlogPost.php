<?php

/**
 * 
 * Class to handle blog posts
 *
**/

class BlogPost {
  public $date = NULL;
  public $title = NULL;
  public $tags = NULL;
  public $content = NULL;

  public function __construct($blog_post_file) {
    list($meta_data, $blog_content) = $this->parse_blog_post_file($blog_post_file);

    $this->date = $meta_data['Date'];
    $this->title = $meta_data['Title'];
    $this->tags = $meta_data['Tags'];
    $this->content = $blog_content;

  }

  private function parse_blog_post_file($blog_post_file) {
    $txt_file = file_get_contents($blog_post_file);

    $rows = explode("---", $txt_file);
    
    $meta_data_lines = explode("\n", $rows[1]);
    $meta_data_lines = array_slice($meta_data_lines, 1, 3);
    $blog_content = $this->remove_first_and_last_line($rows[2]); 

    $meta_data = $this->parse_meta_data($meta_data_lines);

    return array($meta_data, $blog_content);
  }

  private function remove_first_and_last_line($string) {
    $lines = explode("\n", $string);
    $cut_lines = array_slice($lines, 1, -1);
    return implode($cut_lines);
  }

  private function parse_meta_data($meta_data_lines) {
    foreach($meta_data_lines as $meta_data_line) {
        $meta_data_line_items = preg_split("/[\t]/", $meta_data_line);
        $key = $meta_data_line_items[1];
        $value = $meta_data_line_items[2];
        $meta_data[$key] = $value;
    }

    $meta_data['Tags'] = $this->parse_tags_string($meta_data['Tags']);

    return $meta_data;
  }

  private function parse_tags_string($tags_string) {
    return explode(" ", $tags_string);
  }
}