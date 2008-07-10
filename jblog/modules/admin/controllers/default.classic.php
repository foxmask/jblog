<?php
/**
* @package		jBlog
* @subpackage 	admin
* @author		Thibault PIRONT < nuKs >
* @copyright	2008 Thibault PIRONT
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class defaultCtrl extends jController {
	public $pluginParams=array(
        'index'=>array('jacl2.rights.and'=>array('admin.view')),
    );
	
    /**
    *
    */
    function index() {
        $rep = $this->getResponse('adminHtml');
		return $rep;
    }
}
?>
