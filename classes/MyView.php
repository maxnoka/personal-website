<?php
// adapted from https://www.smashingmagazine.com/2011/10/getting-started-with-php-templating/
class MyView {
    protected $sub_template = NULL;
    protected $content_file = NULL;
    protected $stylesheets = array("main.css");

    public function __construct($additional_styles = [], $content_file = NULL, $sub_template = NULL) {
        if ($sub_template !== NULL) {
            if (file_exists(TEMPLATE_PATH . '/' . $sub_template)) {
                $this->sub_template = $sub_template;
            } 
            else {
                throw new Exception('no sub-template file ' . $sub_template . ' present in directory ' . TEMPLATE_PATH);
            }
        }
        if ($content_file !== NULL) {
            if (file_exists(CONTENT_PATH . '/' . $content_file)) {
                $this->content_file = $content_file;
            } 
            else {
                throw new Exception('no content_file file ' . $content_file . ' present in directory ' . CONTENT_PATH);
            }
        }
        $this->stylesheets = array_merge($this->stylesheets,$additional_styles); 
    }

    public function render() {
        include TEMPLATE_PATH . '/' . 'base_template.html';
    }
}
?>
