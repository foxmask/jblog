<?php
/**
    * @package      jBlog
    * @subpackage   
    * @author       Thibault PIRONT < nuKs >
    * @copyright    2008 Thibault PIRONT
    * @link         http://forge.jelix.org/projects/sharecode/
	* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
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
	
	protected $dao = 'jcategories~categories';
	protected $form = 'jcategories~categories';
	
	protected $propertiesForList = array('cat_name');
	protected $propertiesForRecordsOrder = array('cat_name'=>'asc');
		
    protected function _getResponse(){
		$rep = $this->getResponse('categoriesAdminHtml');
		return $rep;
	}
}
?>