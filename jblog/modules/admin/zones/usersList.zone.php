<?php
/**
* @package      jBlog
* @subpackage   admin
* @author       Thibault PIRONT
* @copyright    2008 Thibault PIRONT
* @link         http://forge.jelix.org/projects/sharecode/
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*
*/

class usersListZone extends jZone {
    protected $_tplname='admin~users_list';
    protected $_useCache = false;
    

    protected function _prepareTpl(){
        $offset = $this->getParam('idx',0,true);
        $grpid = $this->getParam('grpid',-2,true);
		$fetchFilter = $this->getParam('fetchFilter', false, true);
		
        $groups=array();
        $o = new StdClass;
        $o->id_aclgrp ='-2';
        $o->name=jLocale::get('admin~acl2.all.users.option');
        $o->grouptype=0;
        $groups[]=$o;
        $o = new StdClass;
        $o->id_aclgrp ='-1';
        $o->name=jLocale::get('admin~acl2.without.groups.option');
        $o->grouptype=0;
        $groups[]=$o;
        foreach(jAcl2DbUserGroup::getGroupList() as $grp) {
            $groups[]=$grp;
        }

        $listPageSize = 15;

        $p = jAcl2Db::getProfil();

        if($grpid == -2) {
            //all users
            $dao = jDao::get('jelix~jacl2groupsofuser',$p);
            $cond = jDao::createConditions();
            $cond->addCondition('grouptype', '=', 2);
            $rs = $dao->findBy($cond,$offset,$listPageSize);
            $usersCount = $dao->countBy($cond);

        } elseif($grpid == -1) {
            //only those who have no groups
            $cnx = jDb::getConnection($p);
            if($cnx->dbms != 'pgsql') {
            // with MYSQL 4.0.12, you must use an alias with the count to use it with HAVING
                $sql = 'SELECT login, count(id_aclgrp) as nbgrp FROM jacl2_user_group 
                        GROUP BY login HAVING nbgrp < 2 ORDER BY login';
            } else {
            // But PgSQL doesn't support the HAVING structure with an alias.
	            $sql = 'SELECT login, count(id_aclgrp) as nbgrp FROM jacl2_user_group 
	                    GROUP BY login HAVING count(id_aclgrp) < 2 ORDER BY login';
            }
            $rs = $cnx->query($sql);
            $usersCount = $rs->rowCount();

        } else {
            //in a specific group
            $dao = jDao::get('jelix~jacl2usergroup',$p);
            $rs = $dao->getUsersGroupLimit($grpid, $offset, $listPageSize);
            $usersCount = $dao->getUsersGroupCount($grpid);
        }
        $users=array();
        $dao2 = jDao::get('jelix~jacl2groupsofuser',$p);
        foreach($rs as $u){
            $u->groups = array();
            $gl = $dao2->getGroupsUser($u->login);
            foreach($gl as $g) {
                if($g->grouptype != 2)
                    $u->groups[]=$g;
            }
            $users[] = $u;
        }
		
		if($fetchFilter) {
			$tpl = new jTpl();
	        $tpl->assign(compact('groups','grpid'));
			$this->_tpl->assign('USR_LIST_HEADER', $tpl->fetch('admin~users_list_filter'));
		}
		
        $this->_tpl->assign(compact('offset', 'grpid', 'listPageSize', 'users', 'usersCount'));
    }
}
?>
