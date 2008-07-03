<?php
/**
* @package		jBlog
* @subpackage 	admin
* @author		Thibault PIRONT < nuKs >
* @copyright	2008 Thibault PIRONT
* @link
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class groupsCtrl extends jController {

    public $pluginParams=array(
        'index'=>array('jacl2.rights.and'=>array('acl.group.view')),
        'saverights'=>array('jacl2.rights.and'=>array('acl.group.view')),
        'newgroup'=>array('jacl2.rights.and'=>array('acl.group.view','acl.group.create')),
        'changename'=>array('jacl2.rights.and'=>array('acl.group.view','acl.group.modify')),
        'delgroup'=>array('jacl2.rights.and'=>array('acl.group.view','acl.group.delete')),
    );

    /**
    *
    */
    function index() {
        $rep = $this->getResponse('adminHtml');
        $rep->body->assignZone('MAIN', 'groupsList');
        return $rep;
    }


    function saverights(){
        $rep = $this->getResponse('redirect');
        $rights = $this->param('rights',array());

        foreach(jAcl2DbUserGroup::getGroupList() as $grp) {
            $id = intval($grp->id_aclgrp);
            jAcl2DbManager::setRightsOnGroup($id, (isset($rights[$id])?$rights[$id]:array()));
        }

        jAcl2DbManager::setRightsOnGroup(0, (isset($rights[0])?$rights[0]:array()));

        $rep->action = 'admin~groups:index';
        return $rep;
    }



    function newgroup() {
        $rep = $this->getResponse('redirect');
        $rep->action = 'admin~groups:index';

        $name = $this->param('newgroup');
        if($name != '') {
            jAcl2DbUserGroup::createGroup($name);
        }

        return $rep;
    }

    function changename() {
        $rep = $this->getResponse('redirect');
        $rep->action = 'admin~groups:index';

        $id = $this->param('group_id');
        $name = $this->param('newname');
        if ($id && $name != '') {
            jAcl2DbUserGroup::updateGroup($id, $name);
        }
        return $rep;
    }

    function delgroup() {
        $rep = $this->getResponse('redirect');
        $rep->action = 'admin~groups:index';

        jAcl2DbUserGroup::removeGroup($this->param('group_id'));

        return $rep;
    }

}
