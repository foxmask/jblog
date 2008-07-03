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
        '*'        => array('auth.required' => true),
        'index'=>array('jacl2.rights.and'=>array('jcomments.comments.view')),
        // 'precreate'=>array('jacl2.rights.and'=>array('jcomments.comments.view','jcomments.comments.modify')),
        //         'create'=>array('jacl2.rights.and'=>array('jcomments.comments.view','jcomments.comments.modify')),
        //          'savecreate'=>array('jacl2.rights.and'=>array('jcomments.comments.view','jcomments.comments.modify')),
          'preupdate'=>array('jacl2.rights.and'=>array('jcomments.comments.view','jcomments.comments.modify')),
        'editupdate'=>array('jacl2.rights.and'=>array('jcomments.comments.view','jcomments.comments.modify')),
        'saveupdate'=>array('jacl2.rights.and'=>array('jcomments.comments.view','jcomments.comments.modify')),
        'view'=>array('jacl2.rights.and'=>array('jcomments.comments.view')),
        'delete'=>array('jacl2.rights.and'=>array('jcomments.comments.view','jcomments.comments.modify')),
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
    
    
    
    
    
}
?>