<?php

class Default_Controller_Index extends Default_Controller_Base {

    public function index() {
        $cates = Cates::model()->findAll('status = 1');
        $news = array();
        foreach ($cates as $item) {
            $news[$item->id] = News::model()->findAll('status = 1');
                    
        }
        $this->view->cates = $cates;
        $this->view->news = $news;
        $this->view->render('index');
    }

    public function about() {
        $this->view->message = 'This is about page!';
        $this->view->render('about');
    }

}
