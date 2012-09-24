<?php

/**
 * This is the model class for table "{{fields}}".
 *
 * The followings are the available columns in table '{{fields}}':
 */
class FilePath extends CActiveRecord
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
        return '{{file_path}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('folder, md5value, name, size, type, created', 'required'),
            array('id, folder, size, created', 'numerical', 'integerOnly'=>true),
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
            'md5value' => 'md5value',
            'folder' => 'folder',
            'name' => 'name',
            'size' => 'size',
            'type' => 'type',
            'created' => 'created',
        );
    }
    public function save_file_path($file_info){
    	$this->md5value = $file_info['md5value'];
    	$this->folder = $file_info['folder'];
    	$this->name = $file_info['name'];
    	$this->size = $file_info['size'];
    	$this->type = $file_info['type'];
    	$this->created = time();
    	return $this->save();
    }
    public function get_by_file_id($id){
        if(!$id){
            return false;
        }
        return $this->findByPk($id);
    }
    public function get_file_by_no($no){
        if(!$no){
            return false;
        }
        $criteria=new CDbCriteria;
        $criteria->addCondition("md5value='{$no}'");
        return $this->findAll($criteria);
    }

}