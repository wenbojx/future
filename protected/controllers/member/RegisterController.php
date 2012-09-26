<?php

class RegisterController extends FController{

    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
    	$datas['page']['title'] = '免费注册';
        $this->render('/member/register', array('datas'=>$datas));
    }
    public function actionReg(){
        $request = Yii::app()->request;
        $this->login_state();
        $reg_datas = $request->getPost('reg');
        $datas['email'] = $reg_datas['username'];
        $datas['passwd'] = $reg_datas['passwd'];
        $datas['repasswd'] = $reg_datas['repasswd'];
        $datas['code'] = $reg_datas['code'];
        print_r($datas);
        if($datas['username']== '' || $datas['passwd']=='' ){
            $datas['error_msg'] = 'username or passwd can not empty!';
        }
        elseif($this->check_user($datas)){
            $this->redirect(array('home/index'));
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
        Yii::app()->session['userinfo'] = $datas;
        return true;
    }
    private function logout(){
        Yii::app()->session['userinfo'] = '';
        $this->login_state();
    }


}