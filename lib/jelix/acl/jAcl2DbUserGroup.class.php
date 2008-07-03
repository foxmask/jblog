<?php
/**
* @package     jelix
* @subpackage  acl
* @author      Laurent Jouanneau
* @copyright   2006-2008 Laurent Jouanneau
* @link        http://www.jelix.org
* @licence     http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
* @since 1.1
*/

/**
 * Use this class to register or unregister users in the acl system, and to manage user groups.
 *  Works only with db driver of jAcl2.
 * @package     jelix
 * @subpackage  acl
 * @static
 */
class jAcl2DbUserGroup {

    /**
     * @internal The constructor is private, because all methods are static
     */
    private function __construct (){ }

    /**
     * Says if the current user is a member of the given user group
     * @param int $groupid The id of a group
     * @return boolean true if it's ok
     */
    public static function isMemberOfGroup ($groupid){
        $groups = self::getGroups();
        return in_array($groupid, $groups);
    }

    /**
     * retrieve the list of group the current user is member of
     * @return array list of group id
     */
    public static function getGroups(){
        static $groups = null;

        if(!jAuth::isConnected())
            return array();

        // chargement des groupes
        if($groups === null){
            $gp = jDao::get('jelix~jacl2usergroup', jAcl2Db::getProfil())
                    ->getGroupsUser(jAuth::getUserSession()->login);
            $groups = array();
            foreach($gp as $g){
                $groups[]=intval($g->id_aclgrp);
            }
        }
        return $groups;
    }


    /**
     * get the list of the users of a group
     * @param int $groupid  id of the user group
     * @return array a list of users object (dao records)
     */
    public static function getUsersList($groupid){
        return jDao::get('jelix~jacl2usergroup', jAcl2Db::getProfil())->getUsersGroup($groupid);
    }

    /**
     * register a user in the acl system
     *
     * For example, this method is called by the acl module when responding
     * to the event generated by the auth module when a user is created.
     * When a user is registered, a private group is created.
     * @param string $login the user login
     * @param boolean $defaultGroup if true, the user become the member of default groups
     */
    public static function createUser($login, $defaultGroup=true){
        $p = jAcl2Db::getProfil();
        $daousergroup = jDao::get('jelix~jacl2usergroup',$p);
        $daogroup = jDao::get('jelix~jacl2group',$p);
        $usergrp = jDao::createRecord('jelix~jacl2usergroup',$p);
        $usergrp->login =$login;

        // si $defaultGroup -> assign le user aux groupes par defaut
        if($defaultGroup){
            $defgrp = $daogroup->getDefaultGroups();
            foreach($defgrp as $group){
                $usergrp->id_aclgrp = $group->id_aclgrp;
                $daousergroup->insert($usergrp);
            }
        }

        // creation d'un groupe personnel
        $persgrp = jDao::createRecord('jelix~jacl2group',$p);
        $persgrp->name = $login;
        $persgrp->grouptype = 2;
        $persgrp->ownerlogin = $login;

        $daogroup->insert($persgrp);
        $usergrp->id_aclgrp = $persgrp->id_aclgrp;
        $daousergroup->insert($usergrp);
    }

    /**
     * add a user into a group
     *
     * (a user can be a member of several groups)
     * @param string $login the user login
     * @param int $groupid the group id
     */
    public static function addUserToGroup($login, $groupid){
        if( $groupid == 0)
            throw new Exception ('jAcl2DbUserGroup::addUserToGroup : invalid group id');
        $p = jAcl2Db::getProfil();
        $usergrp = jDao::createRecord('jelix~jacl2usergroup',$p);
        $usergrp->login =$login;
        $usergrp->id_aclgrp = $groupid;
        jDao::get('jelix~jacl2usergroup',$p)->insert($usergrp);
    }

    /**
     * remove a user from a group
     * @param string $login the user login
     * @param int $groupid the group id
     */
    public static function removeUserFromGroup($login,$groupid){
        jDao::get('jelix~jacl2usergroup',jAcl2Db::getProfil())->delete($login,$groupid);
    }

    /**
     * unregister a user in the acl system
     * @param string $login the user login
     */
    public static function removeUser($login){
        $p = jAcl2Db::getProfil();
        $daogroup = jDao::get('jelix~jacl2group',$p);

        // recupere le groupe privé
        $privategrp = $daogroup->getPrivateGroup($login);
        if(!$privategrp) return;

        // supprime les droits sur le groupe privé (jacl_rights)
        jDao::get('jelix~jacl2rights',$p)->deleteByGroup($privategrp->id_aclgrp);

        // supprime le groupe personnel du user (jacl_group)
        $daogroup->delete($privategrp->id_aclgrp);

        // l'enleve de tous les groupes (jacl_users_group)
        jDao::get('jelix~jacl2usergroup',$p)->deleteByUser($login);
    }

    /**
     * create a new group
     * @param string $name its name
     * @return int the id of the new group
     */
    public static function createGroup($name){
        $p = jAcl2Db::getProfil();
        $group = jDao::createRecord('jelix~jacl2group',$p);
        $group->name=$name;
        $group->grouptype=0;
        jDao::get('jelix~jacl2group',$p)->insert($group);
        return $group->id_aclgrp;
    }

    /**
     * set a group to be default (or not)
     *
     * there can have several default group. A default group is a group
     * where a user is assigned to during its registration
     * @param int $groupid the group id
     * @param boolean $default true if the group is to be default, else false
     */
    public static function setDefaultGroup($groupid, $default=true){
        if( $groupid == 0)
            throw new Exception ('jAcl2DbUserGroup::setDefaultGroup : invalid group id');

        $daogroup = jDao::get('jelix~jacl2group',jAcl2Db::getProfil());
        if($default)
            $daogroup->setToDefault($groupid);
        else
            $daogroup->setToNormal($groupid);
    }

    /**
     * change the name of a group
     * @param int $groupid the group id
     * @param string $name the new name
     */
    public static function updateGroup($groupid, $name){
        if( $groupid == 0)
            throw new Exception ('jAcl2DbUserGroup::updateGroup : invalid group id');
        jDao::get('jelix~jacl2group',jAcl2Db::getProfil())->changeName($groupid,$name);
    }

    /**
     * delete a group from the acl system
     * @param int $groupid the group id
     */
    public static function removeGroup($groupid){
        if( $groupid == 0)
            throw new Exception ('jAcl2DbUserGroup::removeGroup : invalid group id');
        $p = jAcl2Db::getProfil();
        // enlever tout les droits attaché au groupe
        jDao::get('jelix~jacl2rights',$p)->deleteByGroup($groupid);
        // enlever les utilisateurs du groupe
        jDao::get('jelix~jacl2usergroup',$p)->deleteByGroup($groupid);
        // suppression du groupe
        jDao::get('jelix~jacl2group',$p)->delete($groupid);
    }

    /**
     * return a list of group.
     *
     * if a login is given, it returns only the groups of the user.
     * Else it returns all groups (except private groups)
     * @param string $login an optional login
     * @return array a list of groups object (dao records)
     */
    public static function getGroupList($login=''){
        if ($login === '') {
            return jDao::get('jelix~jacl2group',jAcl2Db::getProfil())->findAllPublicGroup();
        }else{
            return jDao::get('jelix~jacl2groupsofuser',jAcl2Db::getProfil())->getGroupsUser($login);
        }
    }
}
