<?php

class LoginController extends NoLoginController{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
        $datas['page']['title'] = '用户登陆';
        $this->render('/member/login', array('datas'=>$datas));
    }
    public function actionCheckLogin(){
        $request = Yii::app()->request;
        $reg_datas = $request->getPost('login');


        $datas['email'] = $reg_datas['email'];
        $datas['passwd'] = $reg_datas['passwd'];

        $msg['flag'] = '1';

        if($datas['email']== '' ){
            $msg['flag'] = '0';
            $msg['field']['email'] = '0';
        }
        if($datas['passwd']== '' ){
            $msg['flag'] = '0';
            $msg['field']['passwd'] = '0';
        }
        if($this->check_user($datas)){
            //$this->redirect(array('home/main'));
        }
        $this->display_msg($msg);
        //$this->render('/member/login', array('datas'=>$datas));
    }
    private function check_user($datas){
        $identity=new UserIdentity($datas['email'], $datas['passwd']);
        if(!$identity->authenticate()){
            return false;
        }
        unset($datas['passwd']);
        Yii::app()->user->login($identity);

        $datas['member_id'] = $identity->getId();
        Yii::app()->session['userinfo'] = $datas;
        return true;
    }
}