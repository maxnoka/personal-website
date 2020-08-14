
<?php
// adapted from https://www.smashingmagazine.com/2011/10/getting-started-with-php-templating/
class MyView {
    protected $content_dir = 'content/';
    protected $vars = array();

    public function __construct($content_dir = null) {
        if ($content_dir !== null) {
            // Check here whether this directory really exists
            $this->content_dir = $content_dir;
        }
    }

    public function render($content_file) {
        if (file_exists($this->content_dir.$content_file)) {
            $this->content_file = $content_file;
            include 'templates/base_template.html';
        } else {
            throw new Exception('no template file ' . $template_file . ' present in directory ' . $this->template_dir);
        }
    }

    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }

    public function __get($name) {
        return $this->vars[$name];
    }
}
?>
