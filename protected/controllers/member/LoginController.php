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

        $datas['username'] = $reg_datas['email'];
        $datas['passwd'] = $reg_datas['passwd'];

        if($datas['username']== '' || $datas['passwd']==''){
            $datas['error_msg'] = 'username or passwd can not empty!';
        }
        elseif($this->check_user($datas)){
            $this->redirect(array('home/main'));
        }
        $this->render('/member/login', array('datas'=>$datas));
    }
    private function check_user($datas){
        $identity=new UserIdentity($datas['username'], $datas['passwd']);
        if(!$identity->authenticate()){
            return false;
        }
        unset($datas['passwd']);
        Yii::app()->user->login($identity);

        $datas['member_id'] = $identity->getId();
        Yii::app()->session['userinfo'] = $datas;
        return true;
    }
    private function logout(){
        Yii::app()->session['userinfo'] = '';
        $this->login_state();
    }


}