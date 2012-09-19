<?php

/**
 * This is the model class for table "{{fields}}".
 *
 * The followings are the available columns in table '{{fields}}':
 */
class Scene extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Fields the static model class
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
        return '{{scene}}';
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, created, status', 'required'),
            array('id, created,status', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>60),
            array('desc', 'length', 'max'=>300),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, year, month, field, datas', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'desc' => 'Desc',
            'created' => 'Created',
            'status' => 'Status',
        );
    }
    public function add_scene($datas){
        if($datas['name']=='' || !$datas['project_id']){
            return false;
        }
        $this->name = $datas['name'];
        $this->desc = $datas['desc'];
        $this->project_id = $datas['project_id'];
        $this->member_id = $datas['member_id'];
        $this->created = $datas['created'];
        return $this->save();
    }
    
    public function get_by_admin_scene($member_id, $scene_id){
        return $this->findByPk($scene_id, 'member_id=:member_id', array(':member_id'=>$member_id));
    }
    public function get_by_scene_id($scene_id){
        return $this->findByPk($scene_id);
    }
    public function update_scene_dispaly($scene_id, $display){
        return $this->updateByPk($scene_id, array('display'=>$display));
    }
    public function find_extend_scene($scene_id, $not_in, $limit){
        $scene_ids = $scene_id;
        if(is_array($not_in)){
            $scene_ids = implode(',', $not_in);
        }
        $criteria=new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->limit = $limit;
        $criteria->addCondition("id>{$scene_id}");
        if($scene_ids){
            $criteria->addCondition("id not in ({$scene_ids})");
        }
        $criteria->addCondition('display=2');
        return $this->findAll($criteria);
    }
}