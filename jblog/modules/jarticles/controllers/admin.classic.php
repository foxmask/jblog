<?php
/**
* @package		jBlog
* @subpackage 	jArticles
* @author		Thibault PIRONT < nuKs >
* @copyright	2008 Thibault PIRONT
* @link
* @licence  	http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class adminCtrl extends jControllerDaoCrud {
    public $pluginParams = array(
        '*'        => array('auth.required' => true, 'jacl2.right.and'=>array('articles.admin.access')),
        // 'precreate'=>array('jacl2.rights.and'=>array('jcomments.comments.view','jcomments.comments.modify')),
        //         'create'=>array('jacl2.rights.and'=>array('jcomments.comments.view','jcomments.comments.modify')),
        //          'savecreate'=>array('jacl2.rights.and'=>array('jcomments.comments.view','jcomments.comments.modify')),
        'preupdate'=>array('jacl2.rights.and'=>array('articles.admin.modify')),
        'editupdate'=>array('jacl2.rights.and'=>array('articles.admin.modify')),
        'saveupdate'=>array('jacl2.rights.and'=>array('articles.admin.modify')),
        'view'=>array('jacl2.rights.and'=>array('articles.admin.view')),
        'delete'=>array('jacl2.rights.and'=>array('articles.admin.delete')),
        );
	
    protected $dao = 'jarticles~articles';
    protected $form = 'jarticles~articles';
	
	protected $propertiesForList = array('date', 'category', 'title', 'author');
	protected $propertiesForRecordsOrder = array('date'=>'desc', 'category'=>'asc', 'author'=>'asc', 'title'=>'asc');
		
	
	protected function _getResponse(){
		$rep = $this->getResponse('articlesAdminHtml');
		return $rep;
	}	
	
	protected function _create($form, $resp, $tpl) {
	    jClasses::getService("jtags~tags")->setResponsesHeaders();;
	}
    protected function _beforeSaveCreate($form, $form_daorec) {
        $form_daorec->author = jAuth::getUserSession()->login;
        $form_daorec->date = date('Y-m-d H:i:s');
    }
    protected function _afterCreate($form, $id, $resp) {
		global $gJConfig;
        $tags = explode(",", $form->getData("tags"));
        jClasses::getService("jtags~tags")->saveTagsBySubject($tags, $gJConfig->jblog['scope'], $id);
        jZone::clear("jarticles~articlesList");
    }
	
	
	/**
     * overload this method if you wan to do additionnal things on the response and on the edit template
     * during the editupdate action.
     * @param jFormsBase $form the form
     * @param jHtmlResponse $resp the response
     * @param jtpl $tpl the template to display the edit form 
     */
    protected function _editUpdate($form, $resp, $tpl) {
		global $gJConfig;
		
	    $tags = jClasses::getService("jtags~tags")->getTagsBySubject($gJConfig->jblog['scope'], $this->param('id'));
		$form->setData('tags', implode(', ',$tags));
    }
    
    /**
     * overload this method if you wan to do additionnal things after the update of
     * a record
     * @param jFormsBase $form the form object
     * @param mixed $id the new id of the updated record
     * @param jHtmlResponse $resp the response
     */
    protected function _afterUpdate($form, $id, $resp) {
        jZone::clear("jarticles~articlesList");
        jZone::clear("jarticles~article", array("id"=>$id));
    }
	
    /**
     * overload this method if you want to do additionnal things on the response and on the view template
     * during the view action.
     * @param jFormsBase $form the form
     * @param jHtmlResponse $resp the response
     * @param jtpl $tpl the template to display the form content
     */
    protected function _view($form, $resp, $tpl) {
		global $gJConfig;
		
        $tags = jClasses::getService("jtags~tags")->getTagsBySubject($gJConfig->jblog['scope'], $this->param('id'));
		$form->setData('tags', implode(', ',$tags));
		
		$wr = new jWiki('wr3_to_xhtml');
		$content = $wr->render($form->getData('content'));
		$form->setData('content', $content);
    }
	
    /* overload this method if you want to do additionnal things before the deletion of a record
     * @param mixed $id the id of the record to delete
     * @return boolean true if the record can be deleted
     * @param jHtmlResponse $resp the response
     */
    protected function _delete($id, $resp) {
        jZone::clear("jarticles~articlesList");
        jZone::clear("jarticles~article", array("id"=>$id));
        return true;
    }
}
?>