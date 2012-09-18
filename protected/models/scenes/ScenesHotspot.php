<?php
class ScenesHotspot extends CActiveRecord
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
        return '{{scene_hotspot}}';
    }
    public function add_hotsopt($datas){
        $this->pan = $datas['pan'] ? $datas['pan'] : 0;
        $this->tilt = $datas['tilt'] ? $datas['tilt'] : 0;
        $this->fov = $datas['fov'] ? $datas['fov'] : 90;
        $this->type = $datas['type'] ? $datas['type'] : 2;
        $this->content = $datas['content'] ? $datas['content'] : '';
        $this->link_scene_id = $datas['link_scene_id'] ? $datas['link_scene_id'] : 0;
        $this->scene_id = $datas['scene_id'];
        unset($datas);
        return $this->insert($insert);
    }
    public function find_by_scene_id($scene_id){
    	return $this->findAllByAttributes(array('scene_id'=>$scene_id));
    }
    public function find_by_scene_ids($scene_ids){
    	if(!$scene_ids){
    		return false;
    	}
    	$scene_ids_str = implode(',', $scene_ids);
    	$criteria=new CDbCriteria;
    	$criteria->addCondition("scene_id in ({$scene_ids_str})");
    	return $this->findAll($criteria);
    }
    public function edit_hotspot($id, $datas){
    	if(!$id){
    		return false;
    	}
    	return $this->updateByPk($id, $datas);
    }
}




