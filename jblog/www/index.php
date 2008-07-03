<?php
/**
* @package  jblog
* @subpackage www
* @author
* @contributor
* @copyright
*/

require ('../../lib/jelix/init.php');
require ('../application.init.php');
require (JELIX_LIB_CORE_PATH.'request/jClassicRequest.class.php');

$config_file = 'index/config.ini.php';

$jelix = new jCoordinator($config_file);
$jelix->process(new jClassicRequest());

?>
