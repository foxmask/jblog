<?php
/**
    * @package      jBlog
    * @subpackage   jCategories
    * @author       Thibault PIRONT < nuKs >
    * @copyright    2008 Thibault PIRONT
    * @link         http://forge.jelix.org/projects/sharecode/
	* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
    */

class adminCtrl extends jControllerDaoCrud {
    public $pluginParams = array(
        '*'=>array('jacl2.rights.and'=>array('admin.view')),
        'index'=>array('jacl2.rights.and'=>array('jcategories.list')),
        'view'=>array('jacl2.rights.and'=>array('jcategories.read')),
        'precreate'=>array('jacl2.rights.and'=>array('jcategories.create')),
        'create'=>array('jacl2.rights.and'=>array('jcategories.create')),
        'savecreate'=>array('jacl2.rights.and'=>array('jcategories.create')),
        'preupdate'=>array('jacl2.rights.and'=>array('jcategories.update')),
        'editupdate'=>array('jacl2.rights.and'=>array('jcategories.update')),
        'saveupdate'=>array('jacl2.rights.and'=>array('jcategories.update')),
        'delete'=>array('jacl2.rights.and'=>array('jcategories.delete')),
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