<?php
/**
* @package     jelix-modules
* @subpackage  jauth
* @author      Laurent Jouanneau
* @contributor Antoine Detante
* @copyright   2005-2008 Laurent Jouanneau, 2007 Antoine Detante
* @link        http://www.jelix.org
* @licence  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/


class loginCtrl extends jController {

    public $pluginParams = array(
      '*'=>array('auth.required'=>false)
    );

    function index() {
        $rep = $this->getResponse('html');
        $rep->body->assignZone('MAIN','jcommunity~login');
        return $rep;
    }

    /**
    *
    */
    function in() {
        $rep = $this->getResponse('redirectUrl');
        $conf = $GLOBALS['gJCoord']->getPlugin('auth')->config;
        $url_return = '/';

        if ($conf['after_login'] == '')
            throw new jException ('jauth~autherror.no.auth_login');

        if ($conf['after_logout'] == '')
            throw new jException ('jauth~autherror.no.auth_logout');

        $form = jForms::fill('jcommunity~login');
        if(!$form) {
            $rep->url = jurl::get($conf['after_logout']);
            return $rep;
        }

        if (!jAuth::login($form->getData('auth_login'), $form->getData('auth_password'), $form->getData('auth_remember_me'))){
            sleep (intval($conf['on_error_sleep']));
            $form->setErrorOn('login',jLocale::get('jcommunity~login.error'));
            $url_return = jurl::get($conf['after_logout']);
        } else {
            jForms::destroy('jcommunity~login');
            if (!($conf['enable_after_login_override'] && $url_return = $this->param('auth_url_return'))){
                $url_return =  jurl::get($conf['after_login']);
            }
        }

        $rep->url = $url_return;
        return $rep;
    }

    /**
    *
    */
    function out() {
        $rep = $this->getResponse('redirectUrl');
        jAuth::logout();
        $conf = $GLOBALS['gJCoord']->getPlugin ('auth')->config;

        if ($conf['after_logout'] == '')
            throw new jException ('jauth~autherror.no.auth_logout');

        if (!($conf['enable_after_logout_override'] && $url_return= $this->param('auth_url_return'))){
            $url_return =  jurl::get($conf['after_logout']);
        }

        $rep->url = $url_return;
        return $rep;
    }
}
