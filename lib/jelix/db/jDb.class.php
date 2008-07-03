<?php
/**
* @package    jelix
* @subpackage db
* @author     Laurent Jouanneau
* @contributor
* @copyright  2005-2007 Laurent Jouanneau
*
* API ideas of this class were get originally from the Copix project (CopixDbFactory, Copix 2.3dev20050901, http://www.copix.org)
* No lines of code are copyrighted by CopixTeam
*
* @link      http://www.jelix.org
* @licence  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 *
 */
require(JELIX_LIB_PATH.'db/jDbConnection.class.php');
require(JELIX_LIB_PATH.'db/jDbResultSet.class.php');

/**
 * factory for database connector and other db utilities
 * @package  jelix
 * @subpackage db
 */
class jDb {

    static private $_profils =  null;

    /**
    * return a database connector
    * Use a local pool.
    * @param string  $name  profil name to use. if empty, use the default one
    * @return jDbConnection  connector
    */
    public static function getConnection ($name = null){
        static $cnxPool = array();

        $profil = self::getProfil ($name);

        if (!isset ($cnxPool[$name])){
            $cnxPool[$name] = self::_createConnector ($profil);
        }
        return $cnxPool[$name];
    }

    /**
     * create a new jDbWidget
     * @param string  $name  profil name to use. if empty, use the default one
     * @return jDbWidget
     */
    public static function getDbWidget($name=null){
        $dbw = new jDbWidget(self::getConnection($name));
        return $dbw;
    }

    /**
    * instancy a jDbTools object
    * @param string $name profil name to use. if empty, use the default one
    * @return jDbTools
    */
    public static function getTools ($name=null){
        $profil = self::getProfil ($name);

        $driver = $profil['driver'];

        if($driver == 'pdo'){
            preg_match('/^(\w+)\:.*$/',$profil['dsn'], $m);
            $driver = $m[1];
        }

        global $gJConfig;
        if(!isset($gJConfig->_pluginsPathList_db[$driver])
            || !file_exists($gJConfig->_pluginsPathList_db[$driver]) ){
            throw new jException('jelix~db.error.driver.notfound', $driver);
        }
        require_once($gJConfig->_pluginsPathList_db[$driver].$driver.'.dbtools.php');
        $class = $driver.'DbTools';

        //Création de l'objet
        $cnx = self::getConnection ($name);
        $tools = new $class ($cnx);
        return $tools;
    }

    /**
    * load properties of a connector profil
    *
    * a profil is a section in the dbprofils.ini.php file
    *
    * with getProfil('myprofil') (or getProfil('myprofil', false)), you get the profil which
    * has the name "myprofil". this name should correspond to a section name in the ini file
    *
    * with getProfil('myprofiltype',true), it will search a parameter named 'myprofiltype' in the ini file. 
    * This parameter should contains a profil name, and the corresponding profil will be loaded.
    *
    * with getProfil(), it will load the default profil, (so the profil of "default" type)
    *
    * @param string   $name  profil name or profil type to load. if empty, use the default one
    * @param boolean  $nameIsProfilType  says if the name is a profil name or a profil type. this parameter exists since 1.0b2
    * @return array  properties
    */
    public static function getProfil ($name='', $nameIsProfilType=false){
        global $gJConfig;
        if(self::$_profils === null){
            self::$_profils = parse_ini_file(JELIX_APP_CONFIG_PATH.$gJConfig->dbProfils , true);
        }

        if($name == ''){
            if(isset(self::$_profils['default']))
                $name=self::$_profils['default'];
            else
                throw new jException('jelix~db.error.default.profil.unknow');
        }elseif($nameIsProfilType){
            if(isset(self::$_profils[$name]) && is_string(self::$_profils[$name])){
                $name = self::$_profils[$name];
            }else{
                throw new jException('jelix~db.error.profil.type.unknow',$name);
            }
        }

        if(isset(self::$_profils[$name]) && is_array(self::$_profils[$name])){
            self::$_profils[$name]['name'] = $name;
            return self::$_profils[$name];
        }else{
            throw new jException('jelix~db.error.profil.unknow',$name);
        }
    }

    /**
     * call it to test a profil (during an install for example)
     * @param array  $profil  profil properties
     * @return boolean  true if properties are ok
     */
    public function testProfil($profil){
        try{
            self::_createConnector ($profil);
            $ok = true;
        }catch(Exception $e){
            $ok = false;
        }
        return $ok;
    }

    /**
    * create a connector
    * @param array  $profil  profil properties
    * @return jDbConnection|jDbPDOConnection  database connector
    */
    private static function _createConnector ($profil){
        if($profil['driver'] == 'pdo'){
            $dbh = new jDbPDOConnection($profil);
            return $dbh;
        }else{
            global $gJConfig;
            if(!isset($gJConfig->_pluginsPathList_db[$profil['driver']])
                || !file_exists($gJConfig->_pluginsPathList_db[$profil['driver']]) ){
                throw new jException('jelix~db.error.driver.notfound', $profil['driver']);
            }
            $p = $gJConfig->_pluginsPathList_db[$profil['driver']].$profil['driver'];
            require_once($p.'.dbconnection.php');
            require_once($p.'.dbresultset.php');

            //creating of the connection
            $class = $profil['driver'].'DbConnection';
            $dbh = new $class ($profil);
            return $dbh;
        }
    }

    public static function createVirtualProfile ($name, $params) {
        if ($name == '') {
           throw new jException('jelix~db.error.virtual.profile.no.name');
        }

        if (! is_array ($params)) {
           throw new jException('jelix~db.error.virtual.profile.invalid.params', $name);
        }

        if (self::$_profils === null) {
            self::$_profils = parse_ini_file (JELIX_APP_CONFIG_PATH . $gJConfig->dbProfils, true);
        }
        self::$_profils[$name] = $params;
    }
}
?>