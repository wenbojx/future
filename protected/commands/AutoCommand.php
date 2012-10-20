<?php
class AutoCommand extends CConsoleCommand {
	
	public $search_path = '/var/www/panos';
	public $thumb_size200 = 'thumbx200.jpg';
	public $cubes = array('front', 'left', 'right', 'top', 'back', 'bottom');
	
	public function actionRun(){
		$this->myScanCubeDir($search_path);
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