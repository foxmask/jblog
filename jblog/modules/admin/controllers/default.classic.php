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
    /**
    *
    */
    function index() {
        $rep = $this->getResponse('adminHtml');
        
        //$rep->body->assignZone('HEADER', 'jcommunity~status');
        
        $rep->body->assign('MAIN', 'Les billets');
        $rep->body->assign('FOOTER', 'Thibault PIRONT, tous droits réservés');
        return $rep;
    }
}
?>
