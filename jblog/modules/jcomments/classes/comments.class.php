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

class Comments {
    
    protected $dao = 'jcomments~comments';
    
    function getNbComments($scope, $id) {
        $dao = jDao::get($this->dao);
        return $dao->nbCommentsByObject($scope, $id);
    }

}
?>