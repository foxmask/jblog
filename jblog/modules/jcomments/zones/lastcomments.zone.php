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


class lastcommentsZone extends jZone {
    protected $_tplname='lastcomments';

    
    protected function _prepareTpl(){
        $factory = jDao::get("jcomments~comments");
        $comments = $factory->findAllForZone();
        $this->_tpl->assign(compact('comments'));
    }
}
?>
