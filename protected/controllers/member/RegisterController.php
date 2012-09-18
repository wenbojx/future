<?php

class RegisterController extends NoLoginController{

    public $defaultAction = 'register';
    public $layout = 'member';

    public function actionRegister(){
        $import = new SaladoImport();
        $path = 'a.xml';
        $import->analyze_file($path);
        exit();
        $this->login_state();
        $this->render('/member/register');
    }
    public function actionCheckRegister(){
        $request = Yii::app()->request;
        $this->login_state();
        $reg_datas = $request->getPost('reg');
        $datas['email'] = $reg_datas['username'];
        $datas['passwd'] = $reg_datas['passwd'];
        $datas['repasswd'] = $reg_datas['repasswd'];
        $datas['code'] = $reg_datas['code'];

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