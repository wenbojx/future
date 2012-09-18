<?php
class ScenesPanoram extends CActiveRecord
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
		return '{{scene_panoram}}';
	}
	public function find_by_scene_id($scene_id){
		return $this->findByPk($scene_id);
	}
	public function find_by_scene_ids($scene_ids){
		if(!$scene_ids){
			return false;
		}
		$panoram_datas = array();
		$scene_ids_str = implode(',', $scene_ids);
		$criteria=new CDbCriteria;
		$criteria->addCondition("scene_id in ({$scene_ids_str})");
		$datas = $this->findAll($criteria);
		if(!$datas){
			return $panoram_datas;
		}
		foreach ($datas as $v){
			$panoram_datas[$v['scene_id']] = $v;
		}
		return $panoram_datas;
	}
	public function save_camera($datas, $scene_id){
		if(!$scene_id){
			return false;
		}
		$content = json_encode($datas);
		if (!$scene_datas = $this->find_by_scene_id($scene_id)){
			
			$this->scene_id = $scene_id;
			$this->content = $content;
			return $this->insert();
		}
		else{
			$attributes = array('content'=>$content);
			return $this->updateByPk($scene_id, $attributes);
		}
	}
	
	
}