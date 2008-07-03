<?php
/**
* @package      jBlog
* @subpackage   admin
* @author       Thibault PIRONT
* @copyright    2008 Thibault PIRONT
* @link         
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*
*/

class userRightsListZone extends jZone {

    protected $_tplname='admin~user_rights';
    protected $_useCache = false;
    

    protected function _prepareTpl(){
        $user = $this->getParam('user');
        if (!$user) {
			unset($this->_tplname);
            return '<p>invalid user</p>';
        }


        $hisgroup = null;
        $groupsuser = array();
        foreach(jAcl2DbUserGroup::getGroupList($user) as $grp) {
            if($grp->grouptype == 2)
                $hisgroup = $grp;
            else
                $groupsuser[$grp->id_aclgrp]=$grp;
        }

        $gid=array($hisgroup->id_aclgrp);
        $groups=array();
        $grouprights=array($hisgroup->id_aclgrp=>false);
        foreach(jAcl2DbUserGroup::getGroupList() as $grp) {
            $gid[]=$grp->id_aclgrp;
            $groups[]=$grp;
            $grouprights[$grp->id_aclgrp]=false;
        }

        $rights=array();
        $p = jAcl2Db::getProfil();
        $rs = jDao::get('jelix~jacl2subject',$p)->findAllSubject();
        foreach($rs as $rec){
            $rights[$rec->id_aclsbj] = $grouprights;
        }


        $rs = jDao::get('jelix~jacl2rights',$p)->getRightsByGroups($gid);
        foreach($rs as $rec){
            $rights[$rec->id_aclsbj][$rec->id_aclgrp] = true;
        }

        $this->_tpl->assign(compact('hisgroup', 'groupsuser', 'groups', 'rights','user'));
        $this->_tpl->assign('nbgrp', count($groups));
    }
}
?>
