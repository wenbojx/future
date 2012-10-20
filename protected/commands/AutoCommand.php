<?php
class AutoCommand extends CConsoleCommand {

	public $panos_path = array();
	public $search_path = '/var/www/panos';
	public $thumb_size200 = 'thumbx200.jpg';
	public $cubes = array('front', 'left', 'right', 'top', 'back', 'bottom');
	public $default_m_id = 1;
	public $default_project_name = 'test1';

	public function actionRun(){
		$this->default_project_name = date('Y-m-dH', time());
		$this->myScanCubeDir($this->search_path);
		//print_r($this->panos_path);
		$project_id = $this->add_project();

		//添加项目
		foreach ($this->panos_path as $v){
			$fordle_explode = explode('/', $v);
    		$num = count($fordle_explode)-1;
    		$fordle = $fordle_explode[$num];
			$this->add_scene($project_id, $fordle);
		}
	}
	//添加项目
	private function add_project(){
		$project_db = new Project();
		$datas['name'] = $this->default_project_name;
    	$datas['desc'] = '';
    	$datas['member_id'] = $this->default_m_id;
    	$datas['created'] = time();
		if(!$id = $project_db->add_project($datas)){
			return false;
		}
		return $id;
	}
	//添加场景
	private function add_scene($project_id ,$name){
		$scene_db = new Scene();

		$datas['name'] = $name;
    	$datas['desc'] = '';
    	$datas['member_id'] = $this->default_m_id;
    	$datas['project_id'] = $project_id;
    	$datas['created'] = time();
		if(!$id = $scene_db->add_scene($datas)){
			return false;
		}
		return $id;
	}

	/**
	 * 扫描目录下的cube
	 */
	public function myScanCubeDir($path){
		if(!is_dir($path))  return;

		foreach(scandir($path) as $file){
			if($file!='.'  && $file!='..' ){
				$path2= $path.DIRECTORY_SEPARATOR.$file;
				if(is_dir($path2)){
					$this->panos_path[] = $path2;
				}
			}
		}
	}
}