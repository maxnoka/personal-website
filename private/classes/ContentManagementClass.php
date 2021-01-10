<?php 

/**
 *
 * Class to handle the file based content management for e.g. 
 * the blog and the project tracker. 
 *
**/

abstract class ContentManagementClass {

  abstract protected function construct_content_item($content_item_name);
  
  // abstract protected static $content_items_folder
  // abstract protected static $content_items_list_file

  /** 
   *
   * abstract properties don't exist, but the derived class needs to implement this or we throw an error below.
   *
   * $content_items_folder should probably be a folder in CONTENT_PATH. It contains the content_items_list_file and all the content
   *
   * $content_items_list_file: this list contains the names of the content items to show, it as well as all the filenames listed within should be in the $content_items_folder
   *
  **/

  public $content_items;
  protected $content_items_folder; 
  public $current_content_item_idx; // in the content_items array. btw I don't like internal array pointers :|

  public function __construct() {
    /**
     * @param content_items_list_file: this list contains the names of the content items to show, it as well as all the filenames listed within should be in the $content_items_folder
    **/

    // the fake abstract properties, see above and this https://stackoverflow.com/questions/7634970/php-abstract-properties
    if(!isset($this->content_items_folder)) {
      throw new LogicException(get_class($this) . ' must have a $content_items_folder');
    }
    if (!isset($this->content_items_list_file)) {
      throw new LogicException(get_class($this) . ' must have a $content_items_list_file');
    }

    $txt_file = file_get_contents($this->content_items_folder . '/' . $this->content_items_list_file);

    $content_items_names = explode("\n", $txt_file);

    foreach ($content_items_names as $content_item_name) {
      if ($content_item_name == '') {
        continue;
      }
      $new_content_item = $this->construct_content_item($content_item_name);
      
      // now make sure the derived class returns an object that has tags
      if(!isset($new_content_item->tags) && is_array($new_content_item->tags)) {
        throw new LogicException(get_class($new_content_item) . ' must have a $tags property of type array');
      }
      else { // all good
        $this->content_items[$content_item_name] = $new_content_item;
      }
    }
    
    // default is the most recent one / last line of the content_item_list_file
    $this->change_current_item_by_index(count($this->content_items) - 1); 
  }

  public function get_index_by_name($target_item_name) {
    if ($this->check_valid_item_name($target_item_name)) {
      return array_search($target_item_name, array_keys($this->content_items));
      return true;
    }
    else {
      return false; //Content not found
    }
  }

  public function get_items_by_tag($search_tag) {
    $filtered_posts = array();
    foreach ($this->content_items as $content_item_name => $content_item) {
      if (in_array($search_tag, $content_item->tags)) {
        $filtered_posts[$content_item_name] = $content_item;
      }
    }
    return $filtered_posts;
  }

  /* methods to get and set the current item */
  public function change_current_item_by_index($target_item_index) {
    if ($this->check_valid_item_index($target_item_index)) {
      $this->current_content_item_idx = $target_item_index;
      return true;
    }
    else {
      return false; //Content not found
    }
  }

  protected function check_valid_item_index($target_item_index) {
    return array_key_exists($target_item_index, array_values($this->content_items));
  }

  public function change_current_item_by_name($target_item_name) {
    if ($this->check_valid_item_name($target_item_name)) {
      $this->current_content_item_idx = array_search($target_item_name, array_keys($this->content_items));
      return true;
    }
    else {
      return false; //Content not found
    }
  }

  protected function check_valid_item_name($target_item_index) {
    return array_key_exists($target_item_index, $this->content_items);
  }

  public function get_current_item() {
    return array_values($this->content_items)[$this->current_content_item_idx];
  }
}
