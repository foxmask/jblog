<?php
/**
* @package
* @subpackage jcomments
* @author
* @copyright
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class nbcommentsZone extends jZone {
    protected $_tplname='nbcomments';

    protected $_useCache = true;

    protected function _prepareTpl(){   
        $id = $this->getParam('id', false);
        $scope = $this->getParam('scope', false);
        
        if (!$id || !$scope) {
            throw new Exception(jLocale::get("jcomments~comments.error.parametermissing"));
        }
        
        $nbcomments = jClasses::getService("jcomments~comments")->getNbComments($scope, $id);
        
        $this->_tpl->assign(compact("nbcomments"));
        
    }
}
?>
