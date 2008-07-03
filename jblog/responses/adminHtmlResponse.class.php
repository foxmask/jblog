<?php 
require_once (JELIX_LIB_CORE_PATH.'response/jResponseHtml.class.php');

class adminHtmlResponse extends jResponseHtml {
    public $bodyTpl = 'jblog~main';
    public $themePath;
    
    function __construct() {
        parent::__construct();
        global $gJConfig;
        $this->themePath = $gJConfig->urlengine['basePath'].'themes/'.$gJConfig->theme.'/';
		
        $this->title = "jBlog::";
        $this->addCSSLink($this->themePath.'css/main.css');
        // Include your common CSS and JS files here
    }

    protected function doAfterActions() {
		global $gJConfig;
		
        if($this->bodyTpl != 'jblog~main') {
			$tpl = new jTpl();
			$vars = $this->body->getTemplateVars();
			foreach($vars as $k=>$v) {
				$tpl->assign($k, $v);
			}
			$tpl = $tpl->fetch($this->bodyTpl);
			
			$this->bodyTpl = 'jblog~main';
	        $this->body->assign('MAIN',$tpl);
		}
        $this->body->assignZoneIfNone('HEADER','jcommunity~status');
		$this->body->assignZone('SIDEBAR_RIGHT', 'admin~sideBarRight');
        $this->body->assignIfNone('FOOTER',$gJConfig->jblog['copyright']);
        
    }
}
?>
