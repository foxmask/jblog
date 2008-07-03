<?php
/**
* @package      sharecode
* @subpackage   jComments
* @author       Bastien Jaillot
* @copyright    2008 Bastien Jaillot
* @link         http://forge.jelix.org/projects/sharecode/
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*
*/

class editZone extends jZone {
    protected $_tplname='edit';

    protected function _prepareTpl(){   
        $id_subject = $this->getParam('id', false);
        $scope = $this->getParam('scope', false);
        
        $return_url = $this->getParam('return_url', false);
        $return_url_params = $this->getParam('return_url_params', false);
        
        if (!$id_subject || !$scope) {
            throw new Exception(jLocale::get("jcomments~comments.error.parametermissing"));
        }
        
        if (!$return_url_params || !$return_url) {
            throw new Exception(jLocale::get("jcomments~comments.error.returnurlmissing"));
        }
        
		$add_com = jForms::get('jcomments~comments');
        if($add_com == null){
            $add_com = jForms::create('jcomments~comments');
        } 
        
		
		$add_com_action = "jcomments~comments:savecreate";
        
        $this->_tpl->assign(compact("id_subject","add_com_action", "add_com", "scope", "return_url", "return_url_params"));
        
    }
}
?>
