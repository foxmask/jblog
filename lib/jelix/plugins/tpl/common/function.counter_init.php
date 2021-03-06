<?php
/**
 * @package     jelix
 * @subpackage  jtpl_plugin
 * @author      Thibault PIRONT < nuKs >
 * @copyright   2007 Thibault PIRONT
 * @link        http://jelix.org/
 * @licence     GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
 */

/**
 * function plugin :  Init a counter.
 *
 * <pre>{counter_init 'name', 'type', 'start', 'incr'}</pre>
 * @param jTpl $tpl The template
 * @param string $name The name of the counter
 * @param string $type The type of the counter ('0', '00', 'aa' or 'AA').
 * @param string|int $start Where the counter start. String if type == 'aa'/'AA'
 * @param int $incr How many time the counter is increased on each call
 */
function jtpl_function_common_counter_init($tpl, $name = '', $type = '0', $start = 1, $incr = 1) {
    if(!isset($tpl->_privateVars['counterArray']))
        $tpl->_privateVars['counterArray'] = array( 'default' => array('type' => '0', 'start' => 1, 'incr' => 1) );
    
    if( empty($name) && $name !== '0')
        $name = 'default';
    
    /* On réinitialise le compteur et on ajoute les variables données */
    $tpl->_privateVars['counterArray'][$name] = array( 'type' => $type, 'start' => $start, 'incr' => $incr );
    
    /* On racourci la variable */
    $in_use = &$tpl->_privateVars['counterArray'][$name];
    
    /* Adapte le nombre au type (pas toujours nécessaire) */
    if( !is_string($in_use['start']) )
    {
        if( $in_use['type'] === 'aa' )
            $in_use['start'] = 'a';
        elseif( $in_use['type'] === 'AA' )
            $in_use['start'] = 'A';
    }
}

?>