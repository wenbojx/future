<?php

/**
 * This is the model class for table "{{member}}".
 *
 * The followings are the available columns in table '{{member}}':
 * @property integer $id
 * @property string $username
 * @property string $passwd
 * @property integer $status
 */
class Member extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Member the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{member}}';
    }

    public function find_by_email($email=''){
        if(!$email){
            return false;
        }
        $criteria=new CDbCriteria;
        $criteria->addCondition("email='{$email}'");
        $data = $this->find($criteria);
        if(!$data){
            return false;
        }
        return $data[0];
    }
    public function check_login($datas){
        if(!$datas['email'] || !$datas['passwd']){
            return false;
        }

    }
    public function add_user($datas){
        if(!$datas['email'] || !$datas['passwd']){
            return false;
        }
        $this->email = $datas['email'];
        $this->passwd = $this->encrypt($datas['passwd']);
        $this->created = time();
        return $this->save();
    }
    public function encrypt($passwd){
        $passwd .= Yii::app()->params['encrypt_prefix'];
        return md5($passwd);
    }
}