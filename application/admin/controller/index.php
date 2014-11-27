<?php

class Admin_Controller_Index extends Admin_Controller_Base {

    public function init() {
        $this->allowAccessAction = array('login');
        parent::init();
    }
    
    public function index() {
        $user = Navi_User::getInfo();
        $this->view->user = $user;
        $this->view->render('index');
    }
    

    public function login() {
        $this->view->setLayout('login');
        $this->view->error = '';
        if (null != Navi_Request::post('User')) {
            $user = new Users('login');
            $user->load(Navi_Request::post('User'));
            if ($user->validate() && $user->login()) {
                $this->redirect(Navi::$baseUrl);
            } else {
                $this->view->error = 'Wrong username or password.';
            }
        }
        $this->view->render('login');
    }

    public function logout() {
        if (Navi_User::logout()) {
            $this->redirect(Navi::$baseUrl . '/login');
        } else {
            Navi_Session::destroy();
            $this->redirect(Navi::$baseUrl . '/../');
        }
    }

}
