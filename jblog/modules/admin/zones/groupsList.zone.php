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

class groupsListZone extends jZone {
    protected $_tplname='admin~groups_rights';
    protected $_useCache = false;
    

    protected function _prepareTpl(){
        $gid=array(0);
        $o = new StdClass;
        $o->id_aclgrp ='0';
        $o->name = jLocale::get('admin~acl2.anonymous.group.name');
        $o->grouptype=0;
        $groups=array($o);
        $grouprights=array(0=>false);
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

        $this->_tpl->assign(compact('groups', 'rights'));
    }
}
?>
