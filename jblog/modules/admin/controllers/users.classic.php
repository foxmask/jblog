<?php
/**
* @package		jBlog
* @subpackage	admin
* @author		Thibault PIRONT < nuKs >
* @copyright	2008 Thibault PIRONT
* @link 		
* @licence  	http://www.gnu.org/licenses/gpl.adminHtml GNU General Public Licence, see LICENCE file
*/

class usersCtrl extends jController {

    public $pluginParams=array(
        '*'=>array('jacl2.rights.and'=>array('admin.view')),
        'index'=>array('jacl2.rights.and'=>array('acl.user.view')),
        'rights'=>array('jacl2.rights.and'=>array('acl.user.view')),
        'saverights'=>array('jacl2.rights.and'=>array('acl.user.view')),
        'removegroup'=>array('jacl2.rights.and'=>array('acl.user.view','acl.user.modify')),
        'addgroup'=>array('jacl2.rights.and'=>array('acl.user.view','acl.user.modify')),
    );

    /**
    *
    */
    function index() {
        $rep = $this->getResponse('adminHtml');

        $idx = $this->intParam('idx',0,true);
        $grpid = $this->intParam('grpid',-2,true);

        $rep->body->assignZone('MAIN', 'admin~usersList', array('idx' => $idx, 'grpid' => $grpid, 'fetchFilter' => true));
        return $rep;
    }


    function rights(){
        $rep = $this->getResponse('adminHtml');
        $user = $this->param('user');
		$rep->body->assignZone('MAIN', 'admin~userRightsList', array('user' => $user));
		
        return $rep;
    }

    function saverights(){
        $rep = $this->getResponse('redirect');
        $login = $this->param('user');
        $rights = $this->param('rights',array());

        if($login == '') {
            $rep->action = 'admin~users:index';
            return $rep;
        }

        $rep->action = 'admin~users:rights';
        $rep->params=array('user'=>$login);

        $dao = jDao::get('jelix~jacl2groupsofuser',jAcl2Db::getProfil());
        $grp = $dao->getPrivateGroup($login);

        jAcl2DbManager::setRightsOnGroup($grp->id_aclgrp, $rights);
        return $rep;
    }


    function removegroup(){
        $rep = $this->getResponse('redirect');

        $login = $this->param('user');
        if($login != '') {
            $rep->action = 'admin~users:rights';
            $rep->params=array('user'=>$login);
            jAcl2DbUserGroup::removeUserFromGroup($login, $this->param('grpid') );
        }else{
            $rep->action = 'admin~users:index';
        }

        return $rep;
    }

    function addgroup(){
        $rep = $this->getResponse('redirect');

        $login = $this->param('user');
        if($login != '') {
            $rep->action = 'admin~users:rights';
            $rep->params=array('user'=>$login);
            jAcl2DbUserGroup::addUserToGroup($login, $this->param('grpid') );
        }else{
            $rep->action = 'admin~users:index';
        }

        return $rep;
    }

}
