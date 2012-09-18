<?php

class LoginoutController extends NoLoginController{

    public $defaultAction = 'loginout';
    //public $layout = 'default';

    public function actionLoginout(){
        Yii::app()->session['userinfo'] = '';
        $this->login_state();
    }

    private function login_state(){
        if(Yii::app()->session['userinfo']){
            $this->redirect(array('home/index'));
        }
        $this->redirect(array('member/login'));
        return false;
    }
}