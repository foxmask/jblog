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

class viewZone extends jZone {
    protected $_tplname='view';

    protected $_useCache = false;
    
    protected function _prepareTpl(){   
        $id = $this->getParam('id', false);
        $scope = $this->getParam('scope', false);
        
        if (!$id || !$scope) {
            throw new Exception(jLocale::get("jcomments~comments.error.parametermissing"));
        }
        
        $coursFactory = jDao::get("jcomments~comments");
        $comments = $coursFactory->getByObject($scope, $id);
        $nbcomments = jClasses::getService("jcomments~comments")->getNbComments($scope, $id);
        
		/** History source of how doing a strange hack (But it worked, I just did the same thing using the wiki tpl modifier)
		 * 
		// @TODO Remove this hack.
		// <Hack of jComments by nuKs for jBlog>
		$oldComments = $comments;
		$comments = array();
		$n = 0;
		$wr = new jWiki('wr3_to_xhtml');
		foreach($oldComments as $oC) {
			$comments[$n] = new stdClass();
			foreach($oC as $key=>$oCsub) {
				if($key == 'com_content'){
					$comments[$n]->$key = $wr->render($oCsub);
				} else
					$comments[$n]->$key = $oCsub;
			}
			$n++;
		}
		// </Hack>
		 */
        $this->_tpl->assign(compact("comments", "id", "nbcomments", "scope"));
    }
}
?>
