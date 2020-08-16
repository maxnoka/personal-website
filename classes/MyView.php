<?php
// adapted from https://www.smashingmagazine.com/2011/10/getting-started-with-php-templating/
class MyView {
    protected $vars = array();
    protected $sub_template = NULL;
    protected $content_file = NULL;

    public function __construct($content_file = NULL, $sub_template = NULL) {
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
    }

    public function render() {
        include TEMPLATE_PATH . '/' . 'base_template.html';
    }

    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }

    public function __get($name) {
        return $this->vars[$name];
    }
}
?>
