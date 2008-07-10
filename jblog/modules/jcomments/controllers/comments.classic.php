<?php
/**
* @package      sharecode
* @subpackage   jComments
* @author       Bastien Jaillot
* @copyright    2008 Bastien Jaillot
* @link         http://forge.jelix.org/projects/sharecode/
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*
*/

class commentsCtrl extends jControllerDaoCrud {
    public $pluginParams = array(
        '*'=>array('jacl2.rights.and'=>array('admin.view')),
        'index'=>array('jacl2.rights.and'=>array('jcomments.list')),
        'view'=>array('jacl2.rights.and'=>array('jcomments.read')),
        'precreate'=>array('jacl2.rights.and'=>array('jcomments.create')),
        'create'=>array('jacl2.rights.and'=>array('jcomments.create')),
        'savecreate'=>array('jacl2.rights.and'=>array('jcomments.create')),
        'preupdate'=>array('jacl2.rights.and'=>array('jcomments.update')),
        'editupdate'=>array('jacl2.rights.and'=>array('jcomments.update')),
        'saveupdate'=>array('jacl2.rights.and'=>array('jcomments.update')),
        'delete'=>array('jacl2.rights.and'=>array('jcomments.delete')),
	);

    protected $dao = 'jcomments~comments';
    protected $form = 'jcomments~comments';
    protected $dbProfil = '';

	protected function _getResponse(){
		$rep = $this->getResponse('commentsAdminHtml');
		return $rep;
	}

    function savecreate(){
         $form = jForms::fill($this->form);
         $rep = $this->getResponse('redirect');
         if($form == null){
             $rep->action = $this->_getAction('index');
             return $rep;
         }

         if($form->check() && $this->_checkDatas($form, false)){

 	        extract($form->prepareDaoFromControls($this->dao,null,$this->dbProfil), 
 								EXTR_PREFIX_ALL, "form");

            $scope = $this->param("scope", false);


            $idObject = $this->param("id_subject", false);

            $form_daorec->com_scope = $scope;
            $form_daorec->com_subject_id = $idObject;
            $form_daorec->user_login = jAuth::getUserSession()->login;

 			$form_dao->insert($form_daorec);

             $rep->action = $this->param("return_url", false);
             $rep->params['id'] = $this->param("return_url_params", false);

             jForms::destroy($this->form);
             
             
              jZone::clear("jcomments~view", array("scope"=>$scope, "id"=>$idObject));
              jZone::clear("jcomments~nbcomments", array("scope"=>$scope, "id"=>$idObject));

             return $rep;
         } else {
             $resp->action = $this->param("return_url", false);
             return $rep;
         }
     }
    
    
    
    //HACKBYNUKS
	/**
     * overload this method if you want to do additionnal things on the response and on the view template
     * during the view action.
     * @param jFormsBase $form the form
     * @param jHtmlResponse $resp the response
     * @param jtpl $tpl the template to display the form content
     */
    protected function _view($form, $resp, $tpl) {
		$wr = new jWiki('wr3_to_xhtml');
		$content = $wr->render($form->getData('com_content'));
		$form->setData('com_content', $content);
    }
	// /HACKBYNUKS

}
?>