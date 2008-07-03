<?php
/**
* @package      jBlog
* @subpackage   jArticles
* @author       Thibault PIRONT
* @copyright    2008 Thibault PIRONT
* @link         
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*
*/

class articleZone extends jZone {

    protected $_tplname='jarticles~article';
    protected $_useCache = true;
    

    protected function _prepareTpl(){
		global $gJConfig;
		$id = $this->getParam("id");
        $artfactory = jDao::get("jarticles~articles");
		$article = $artfactory->get($id);
				
        $this->_tpl->assign('article', $article);
		
		$srv_tags = jClasses::getService("jtags~tags");
		$tags = $srv_tags->getTagsBySubject($gJConfig->jblog['scope'], $id);
		$this->_tpl->assign("tags", $tags);
    }
	
	public function __construct($params=array()){
		// Cancel Cache creating AND LOADING
		if(jAcl2::check('admin.articles.read'))
			$this->_useCache=false;
		
		parent::__construct($params);
   	}
    
}
?>
