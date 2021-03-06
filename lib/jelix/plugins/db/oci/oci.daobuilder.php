<?php
/**
* @package    jelix
* @subpackage db_driver
* @author     Laurent Jouanneau
* @contributor Gwendal Jouannic
* @copyright  2007 Laurent Jouanneau
* @link      http://www.jelix.org
* @licence  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 * driver for jDaoCompiler
 * @package    jelix
 * @subpackage db_driver
 */
class ociDaoBuilder extends jDaoGenerator {

    protected $aliasWord = ' ';
    protected $propertiesListForInsert = 'PrimaryFieldsExcludeAutoIncrement';

    function __construct($factoryClassName, $recordClassName, $daoDefinition){
        parent::__construct($factoryClassName, $recordClassName, $daoDefinition);
    }

    protected function genOuterJoins(&$tables, $primaryTableName){
        $sqlFrom = '';
        $sqlWhere ='';
        foreach($this->_dataParser->getOuterJoins() as $tablejoin){
            $table= $tables[$tablejoin[0]];
            $tablename = $this->_encloseName($table['name']);

            if($table['name']!=$table['realname'])
                $r =$this->_encloseName($table['realname']).' '.$tablename;
            else
                $r =$this->_encloseName($table['realname']);
            $fieldjoin='';

            if($tablejoin[1] == 0){
                $operand='='; $opafter='(+)';
            }elseif($tablejoin[1] == 1){
                $operand='(+)='; $opafter='';
            }
            foreach($table['fk'] as $k => $fk){
                $fieldjoin.=' AND '.$primaryTableName.'.'.$this->_encloseName($fk).$operand.$tablename.'.'.$this->_encloseName($table['pk'][$k]).$opafter;
            }
            $sqlFrom.=', '.$r;
            $sqlWhere.=$fieldjoin;
        }
        return array($sqlFrom, $sqlWhere);
    }

    protected function genSelectPattern ($pattern, $table, $fieldname, $propname ){
        if ($pattern =='%s'){
            if ($fieldname != $propname){
                $field = $table.$this->_encloseName($fieldname).' "'.$propname.'"';
            }else{
                $field = $table.$this->_encloseName($fieldname);
            }
        }else{
            $field = sprintf (str_replace("'","\\'",$pattern), $table.$this->_encloseName($fieldname)).' "'.$propname.'"';
        }
        return $field;
    }
    
    /*
     * Remplace le lastInsertId qui ne marche pas avec oci 
     */
    protected function genUpdateAutoIncrementPK($pkai, $pTableRealName) {
        return '          $record->'.$pkai->name.'= $this->_conn->query(\'SELECT '.$pkai->sequenceName.'.currval as '.$pkai->name.' from dual\')->fetch()->'.$pkai->name.';';
    }
    

}
?>