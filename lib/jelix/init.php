<?php
/**
* Initialize all defines and includes necessary files
*
* @package  jelix
* @subpackage core
* @author   Jouanneau Laurent
* @contributor Loic Mathaud, Julien Issler
* @copyright 2005-2007 Jouanneau laurent
* @copyright 2007 Julien Issler
* @link     http://www.jelix.org
* @licence  GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
*/


/**
 * Version number of Jelix
 * @name  JELIX_VERSION
 */
define ('JELIX_VERSION', '1.1a1pre.996');

/**
 * base of namespace path used in xml files of jelix
 * @name  JELIX_NAMESPACE_BASE
 */
define ('JELIX_NAMESPACE_BASE' , 'http://jelix.org/ns/');

define ('JELIX_LIB_PATH',         dirname (__FILE__).'/');
define ('JELIX_LIB_CORE_PATH',    JELIX_LIB_PATH.'core/');
define ('JELIX_LIB_UTILS_PATH',   JELIX_LIB_PATH.'utils/');
define ('LIB_PATH',               realpath(JELIX_LIB_PATH.'../').'/');

define ('BYTECODE_CACHE_EXISTS', function_exists('apc_cache_info')|| function_exists('eaccelerator_info'));

error_reporting (E_ALL | E_STRICT);


// chargement du coeur
require (JELIX_LIB_CORE_PATH . 'jErrorHandler.lib.php');
require (JELIX_LIB_CORE_PATH . 'jException.lib.php');
require (JELIX_LIB_CORE_PATH . 'jContext.class.php');
require (JELIX_LIB_CORE_PATH . 'jConfig.class.php');
require (JELIX_LIB_CORE_PATH . 'jSelector.class.php');
require (JELIX_LIB_CORE_PATH . 'jUrl.class.php');
require (JELIX_LIB_CORE_PATH . 'jCoordinator.class.php');
require (JELIX_LIB_CORE_PATH . 'jController.class.php');
require (JELIX_LIB_CORE_PATH . 'jRequest.class.php');
require (JELIX_LIB_CORE_PATH . 'jResponse.class.php');
require (JELIX_LIB_CORE_PATH . 'jLocale.class.php');
require (JELIX_LIB_CORE_PATH . 'jIncluder.class.php');
require (JELIX_LIB_CORE_PATH . 'jSession.class.php');
require (JELIX_LIB_CORE_PATH . 'jICoordPlugin.iface.php');

/**
 * The main object of Jelix which process all things
 * @global jCoordinator $gJCoord
 * @name $gJCoord
 */
$gJCoord = null;

/**
 * Object that contains all configuration values
 * @global stdobject $gJConfig
 * @name $gJConfig
 */
$gJConfig = null;

/**
 * contains path for __autoload function
 * @global array $gLibPath
 * @name $gLibPath
 * @see __autoload()
 */
$gLibPath=array('Db'=>JELIX_LIB_PATH.'db/', 'Dao'=>JELIX_LIB_PATH.'dao/',
 'Forms'=>JELIX_LIB_PATH.'forms/', 'Event'=>JELIX_LIB_PATH.'events/',
 'Tpl'=>JELIX_LIB_PATH.'tpl/', 'Acl'=>JELIX_LIB_PATH.'acl/', 'Controller'=>JELIX_LIB_PATH.'controllers/',
 'Auth'=>JELIX_LIB_PATH.'auth/', 'Installer'=>JELIX_LIB_PATH.'installer/');

/**
 * __autoload function used by php to try to load an unknown class
 */
function __autoload($class){
    if(preg_match('/^j(Dao|Tpl|Acl|Event|Db|Controller|Forms|Auth|Installer).*/i', $class, $m)){
        $f=$GLOBALS['gLibPath'][$m[1]].$class.'.class.php';
    }elseif(preg_match('/^cDao(?:Record)?_(.+)_Jx_(.+)_Jx_(.+)$/', $class, $m)){
        // pour les dao stockés en sessions notament
        $s = new jSelectorDao($m[1].'~'.$m[2], $m[3], false);
        if($GLOBALS['gJConfig']->compilation['checkCacheFiletime']){
            // si il faut verifier le filetime, alors on inclus via le jIncluder
            // au cas où il faudrait recompiler le dao avant l'inclusion de la classe
            jIncluder::inc($s);
            return;
        }else{
            $f = $s->getCompiledFilePath ();
            // on verifie que le fichier est là (dans le cas d'un temp purgé, cf bug #6062)
            if(!file_exists($f)){ // si absent, on recompile
                jIncluder::inc($s);
                return;
            }
        }
    }else{
        $f = JELIX_LIB_UTILS_PATH.$class.'.class.php';
    }

    if(file_exists($f)){
        require_once($f);
    }else{
        throw new Exception("Jelix fatal error : Unknow class $class");
    }
}

?>