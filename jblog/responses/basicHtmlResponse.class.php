<?php 
require_once (JELIX_LIB_CORE_PATH.'response/jResponseHtml.class.php');

class basicHtmlResponse extends jResponseHtml {
    public $bodyTpl = 'jblog~main';
	public $themePath;
    
    function __construct() {
        parent::__construct();
        global $gJConfig;
        $this->themePath = $gJConfig->urlengine['basePath'].'themes/'.$gJConfig->theme.'/';
                
        $this->title = "jBlog";
        // Include your common CSS and JS files here
    }

    protected function doAfterActions() {
        if($this->bodyTpl == 'jblog~main') {
            $this->body->assignIfNone('HEADER','');
            $this->body->assignIfNone('MAIN','<p>no content</p>');
            $this->body->assignIfNone('SIDEBAR_RIGHT','');
            $this->body->assignIfNone('FOOTER','');

	      	$this->addCSSLink($this->themePath.'css/main.css');
		}
    }
}
?>
