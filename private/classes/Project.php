<?php

/**
 * 
 * Class to handle blog posts
 *
**/

class Project {
  public $title = NULL;
  public $status = NULL;
  public $tags = NULL;
  public $intro = NULL;
  public $detailed = NULL;
  public $codeLink = NULL;
  public $executionLink = NULL;

  public function __construct($projects_folder, $project_file) {
    list($meta_data, $project_intro, $project_detailed) = $this->parse_project_file($projects_folder . $project_file);

    $this->project_file = $project_file;

    $this->title = $meta_data['Title'];
    $this->status = $meta_data['Status'];
    $this->tags = $meta_data['Tags'];
    if (array_key_exists('Code', $meta_data)) {
      $this->codeLink = $meta_data['Code'];
    }
    if (array_key_exists('Execution', $meta_data)) {
      $this->executionLink = $meta_data['Execution'];
    }

    $this->intro = $project_intro;
    $this->detailed = $project_detailed;
  }

  private function parse_project_file($blog_post_file) {
    $txt_file = file_get_contents(trim($blog_post_file) . ".txt");

    $rows = explode("---", $txt_file);
    
    $meta_data_lines = explode("\n", $rows[1]);
    $meta_data_lines = array_slice($meta_data_lines, 1, -1);

    $meta_data = $this->parse_meta_data($meta_data_lines);

    // remove_first_and_last_line needed as the title immediately after '---' and the  new line before '---' is included
    $project_intro = $this->remove_first_and_last_line($rows[2]);

    $project_detailed = $this->remove_first_and_last_line($rows[3]);

    return array($meta_data, $project_intro, $project_detailed);
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
