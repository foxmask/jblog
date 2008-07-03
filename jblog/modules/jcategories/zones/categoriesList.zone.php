<?php
/**
* @package      jBlog
* @subpackage   jCategories
* @author       Thibault PIRONT
* @copyright    2008 Thibault PIRONT
* @link         http://forge.jelix.org/projects/sharecode/
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*
*/

class categoriesListZone extends jZone {

    protected $_tplname='categorylist';
    protected $_useCache = true;
    

    protected function _prepareTpl(){
        $catfactory = jDao::get("jcategories~categories");
        
        $destination = $this->getParam("destination", null);
        
        $categories = $catfactory->findAll();
                
        $this->_tpl->assign('categories', $categories);
        $this->_tpl->assign('destination', $destination);
    }
}
?>
