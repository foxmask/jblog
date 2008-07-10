<?php
/**
* @package      jBlog
* @subpackage   jArticles
* @author       Thibault PIRONT
* @copyright    2008 Thibault PIRONT
* @link         http://forge.jelix.org/projects/jblog
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*
*/

class articlesListZone extends jZone {

    protected $_tplname='jarticles~articles_list';
    protected $_useCache = true;
    

    protected function _prepareTpl(){
		global $gJConfig;
		$category = $this->getParam("category", null, true);
		$tag = $this->getParam("tag", null, true);
        $fetchContent = $this->getParam("fetchContent", true, true);
        $listPageSize = $this->getParam("listPageSize", 10, true);
		$order = $this->getParam("order", "desc", true);
        $offset = $this->getParam("idx", 0, true);

        $artfactory = jDao::get("jarticles~articles");
	   	$conditions = jDao::createConditions();
		if($tag != null) {
			$srv_tags = jClasses::getService("jtags~tags");
			$conditions->addCondition('id', '=', $srv_tags->getSubjectsByTags($tag, $gJConfig->jblog['scope']));
		}
		if($category != null) {
			$conditions->addCondition('category_id', '=', $category);
		}
		$conditions->addItemOrder('date', $order);
		$articles = $artfactory->findBy($conditions, $offset, $listPageSize+$offset);
		$nbArticles = $articles->rowCount();
				
        $this->_tpl->assign('offset', $offset);
        $this->_tpl->assign('listPageSize', $listPageSize);
		
        $this->_tpl->assign('articlesCount', $nbArticles);
        $this->_tpl->assign('articles', $articles);
        $this->_tpl->assign('fetchContent', $fetchContent);
    }
	
	public function __construct($params=array()){
		// Cancel Cache creating AND LOADING
		if(jAcl2::check('admin.view'))
			$this->_useCache=false;
		parent::__construct($params);
   	}
}
?>
