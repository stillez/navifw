<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of news
 *
 * @author JanThanh
 */
class Admin_Controller_News extends Admin_Controller_Base {

    //put your code here
    public function init() {
        parent::init();
    }

    // liet ke danh sach san pham.
    public function index() {
        $model = new News('search');
        $model->load(Navi_Request::post('News'));
        $condition = $model->searchCondition();
        $this->view->model = $model;
        $this->view->models = $model->findAll($condition['condition'], $condition['param']);
        $this->view->render('index');
    }

    public function add() {
        $model = new News;
        $model->status = 1;
        if (null != Navi_Request::post('Products')) {
            $model->load(Navi_Request::post('Products'));
            $model->alias = Navi_Helper::convertAlias($model->alias);
            if ($model->validate()) {
                $exists = $model->find('alias = :alias', array(':alias' => $model->alias));
                if ($exists != false) {
                    $model->errors['alias'] = 'This product is exists in database.';
                } else {
                    $model->insert();
                    $this->redirect(Navi::$baseUrl . '/' . Navi::$controller);
                }
            }
            $this->view->errors = $model->errors;
        }
        $this->view->model = $model;
        $this->view->render('form');
    }

    //edit products
    public function edit($param = null) {
        if (isset($param[0])) {
            $product = News::model()->find('id = :id', array(':id' => $param[0]));
            if ($product) {
                $model = new News('update');
                $model->load($product);
                if (null != Navi_Request::post('Products')) {
                    $model->load(Navi_Request::post('Products'));
                    $model->alias = Navi_Helper::convertAlias($model->alias);
                    if ($model->validate()) {
                        $exists = $model->find('alias = :alias and id <> :id', array(':alias' => $model->alias, ':id' => $model->id));
                        if ($exists) {
                            $model->errors['alias'] = 'Other product with this alias exists in database.';
                        } else {
                            $model->image = $model->alias . '.jpg';
                            $model->update('id = :id', array(':id' => $model->id));
                            $this->redirect(Navi::$baseUrl . '/' . Navi::$controller);
                        }
                    }
                    $this->view->errors = $model->errors;
                }
                $this->view->model = $model;
                $this->view->render('form');
            } else {
                $this->redirect(Navi::$baseUrl . '/' . Navi::$controller);
            }
        } else {
            $this->redirect(Navi::$baseUrl . '/' . Navi::$controller);
        }
    }

    // delete
    public function delete($param = null) {
        if (isset($param[0])) {
            News::model()->delete('id = :id', array(':id' => $param[0]));
        }
        $this->redirect(Navi::$baseUrl . '/' . Navi::$controller);
    }

}
