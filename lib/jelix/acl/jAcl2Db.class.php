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
 * Utility class for all classes used for the db driver of jAcl2
 * @package     jelix
 * @subpackage  acl
 * @static
 */
class jAcl2Db {

    /**
     * @internal The constructor is private, because all methods are static
     */
    private function __construct (){ }

    /**
     * return the profil name used for jacl connection
     * @return string profil name
     */
    public static function getProfil(){
        static $profil='';
        if($profil== ''){
            try{
                $prof = jDb::getProfil ('jacl_profil', true);
            }catch(Exception $e){
                $prof = jDb::getProfil ();
            }
            $profil = $prof['name'];
        }
        return $profil;
    }
}
