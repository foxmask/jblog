<?php
/**
* @package		jBlog
* @subpackage 	jArticles
* @author		Thibault PIRONT < nuKs >
* @copyright	2008 Thibault PIRONT
* @link 		http://forge.jelix.org/projects/jblog/
* @licence  	http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class articlesCtrl extends jController {	
    /**
    *
    */
    function index() {
        $rep = $this->getResponse('articlesHtml');
        $rep->body->assignZone('MAIN', 'articlesList', array('fetchContent'=>false));
        return $rep;
    }

    function byCategory() {
        $rep = $this->getResponse('articlesHtml');
        $rep->body->assignZone('MAIN', 'articlesList', array('category'=>$this->param('catId'), 'fetchContent'=>false));
        return $rep;
    }
	
    function byTag() {
        $rep = $this->getResponse('articlesHtml');
        $rep->body->assignZone('MAIN', 'articlesList', array('tag'=>$this->param('tag'), 'fetchContent'=>false));
        return $rep;
    }
	
    function view() {
		global $gJConfig;
		$id =$this->intParam('id');
		
        $rep = $this->getResponse('articlesHtml');
		$rep->body->assign('MAIN', jZone::get('jarticles~article', array('id' => $id)).
							jZone::get('jcomments~view', array('id'=>$id, 'scope'=>$gJConfig->jblog['scope'])).
							jZone::get('jcomments~edit', array('id'=>$id, 'scope'=>$gJConfig->jblog['scope'], 
																		  'return_url'=>'jarticles~articles:view', 
																		  'return_url_params'=>$id)));
		/*$rep->body->assignZone('MAIN', 'article', array('id' => $id));
 		$rep->body->assignZone('comments', 'jcomments~view', array('id'=>$id, 'scope'=>$gJConfig->jblog['scope']));
		$rep->body->assignZone('commentsEdit', 'jcomments~edit', array('id'=>$id, 'scope'=>$gJConfig->jblog['scope'], 
																		  'return_url'=>'jarticles~articles:view', 
																		  'return_url_params'=>$id));
    	*/
		return $rep;
    }
	
    function rss() {
		global $gJConfig;
		
        $rep = $this->getResponse('rss2.0');
        $dao = jDao::get('jarticles~articles');
        $first = true;
		
		$rep->infos->title = $gJConfig->jblog['name'];
		$rep->infos->webSiteUrl= "http://" .$_SERVER['SERVER_NAME'].jUrl::get('jarticles~articles:index');
		$rep->infos->copyright = $gJConfig->jblog['copyright'];
		$rep->infos->description = $gJConfig->jblog['description'];
		$rep->infos->ttl=60;

        $cond = jDao::createConditions();
        $cond->addItemOrder('date', 'desc');
        $list = $dao->findBy($cond,0,10);

        foreach($list as $article){
            if($first){
                //$rep->infos->updated = $snippet->sn_updated_at;
                $rep->infos->published = $article->date;
                $first=false;
            }
			
            $url = "http://" .$_SERVER['SERVER_NAME'].jUrl::get('jarticles~articles:view', array('id'=>$article->id));
			
			$wr = new jWiki('wr3_to_xhtml');
			$content = $wr->render($article->content);
			
            $item = $rep->createItem($article->title, $url, $article->date);
			$item->categories = array($article->category);
			$item->authorName = $article->author;
            $item->content = $content;
            $item->contentType='html';
            $item->idIsPermalink = true;

            $rep->addItem($item);
        }
        return $rep;
    }
}
?>