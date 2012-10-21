<?php
class PanosCommand extends CConsoleCommand {
    //public $defaultAction = 'index'; //默认动作

    public $find_path = '/mnt/hgfs/pics/0826'; //搜索全景图的目录
    public $panos_path = array();
    public $default_new_folder = 'panos';  //新的全景图目录
    public $default_pano_name = 'Panorama.jpg'; //默认的搜索的全景图名称
    public $new_pano_name = 'Panorama-2.jpg';
    public $width = '1863';  //cube图的宽度
    public $swidth = '5852'; //sphere的宽度
    public $sheight = '2926'; //sphere的宽度
    public $error = array();
    public $split_file = '';
    public $cube_path = '/mnt/hgfs/pics/panos';
    public $upload_path = 'upload';
    public $thumb_size = 'thumbx200.jpg';
    public $thumb_name = 'thumb.jpg';
    public $thumb_size800 = 'thumbx800.jpg';
    
    //一键执行
    public function actionRun(){
    	$this->cube_path = $this->find_path.'/'.$this->default_new_folder;
    	$this->actionFind();
    	$this->new_pano_name = $this->default_pano_name;
    	//手工处理生成的全景图
    	$this->actionCube();
    	$this->actionBottomOut();
    	//手工处理cube底部图
    	$this->actionBottomIn();
    	$this->actionThumb();
    }
    //归类需要上传的文件
    public function actionUpload(){
    	$upload_path = $this->find_path.'/'.$this->upload_path.'/';
    	$search_path = $this->find_path.'/'.$this->default_new_folder;
    	if(!file_exists($upload_path)){
    		mkdir($upload_path);
    	}
    	$this->myScanCubeDir($search_path);
    	$search_path .= '/';
    	$cubes = array('front', 'left', 'right', 'top', 'back', 'bottom');
    	foreach($this->panos_path as $v){
    		$fordle_explode = explode('/', $v);
    		$num = count($fordle_explode)-1;
    		$fordle = $fordle_explode[$num];
    		$new_fordle = $upload_path.$fordle.'/';
    		if(!file_exists($new_fordle)){
    			mkdir($new_fordle);
    		}
    		$source_path = $search_path.$fordle.'/';
    		echo "----move {$source_path}{$this->thumb_size} ----\n";
    		copy($source_path.$this->thumb_size, $new_fordle.$this->thumb_size);
    		
    		echo "----move {$source_path}{$this->thumb_size800} ----\n";
    		copy($source_path.$this->thumb_size800, $new_fordle.$this->thumb_size800);
    		
    		$cube_path = $source_path.'cube/';
    		foreach($cubes as $v1){
    			echo "----move {$cube_path}{$v1} ----\n";
    			copy($cube_path.$v1.'.jpg', $new_fordle.$v1.'.jpg');
    		}
    	}
    }
	//查找全景图
    public function actionFind() {
    	$this->panos_path = array();
        $this->myscandir($this->find_path);
        $new_folder = $this->find_path. DIRECTORY_SEPARATOR .$this->default_new_folder;
        if(!file_exists($new_folder)){
            mkdir($new_folder);
        }
        $this->moveFiles();

        //print_r($this->panos_path);
    }
    //全景图转为cube
    public function actionCube(){
    	$this->default_pano_name = $this->new_pano_name;
    	$this->cube_path = $this->find_path.'/'.$this->default_new_folder;
    	$path = $this->cube_path;
    	$this->panos_path = array();
    	$this->myscandir($path);
    	//print_r($this->panos_path);
    	foreach ($this->panos_path as $v){
    		echo "----deal file {$v} ----\n";
    		$this->cube($v);
    		$this->split_file = $v;
    		$this->exec_libpano();
    		echo "----end deal file {$v} ----\n";
    	}
    	print_r($this->error);
    }
    //归类cube中的bottom图
    public function actionBottomOut(){
    	$this->cube_path = $this->find_path.'/'.$this->default_new_folder;
    	$path = $this->cube_path.'/bottom';
    	if(!file_exists($path)){
    		mkdir($path);
    	}
    	$this->panos_path = array();
    	$this->default_new_folder = 'bottom';
    	$this->default_pano_name = 'bottom.jpg';
    	$this->myscandir($this->cube_path);
    	print_r($this->panos_path);
    	foreach($this->panos_path as $v){
    		$explode = explode('/', $v);
    		$num = count($explode)-3;
    		$new_path = $path.'/'.$explode[$num];
    		$new_file = $new_path.'-bottom.jpg';
    		echo "---- copying {$v} to {$new_file}----\n";
    		copy($v, $new_file);
    	}
    	//print_r($this->panos_path);
    }
    //将处理过的bottom图归回
    public function actionBottomIn(){
    	$this->cube_path = $this->find_path.'/'.$this->default_new_folder;
    	$path = $this->cube_path.'/bottom';
    	if(!file_exists($path)){
    		return false;
    	}
    	$this->panos_path = array();
    	//$this->default_pano_name = 'bottom.jpg';
    	$this->myscandir($path, true);
    	foreach($this->panos_path as $v){
    		$explode = explode('/', $v);
    		$num = count($explode)-1;
    		$file = $explode[$num];
    		$explode_file = explode('-', $file);
    		$new_path = $this->cube_path.'/'.$explode_file[0].'/cube';
    		if(!file_exists($new_path)){
    			$this->error[] = $new_path;
    		}
    		$new_file = $new_path.'/bottom.jpg';
    		echo "---- copying {$v} to {$new_file}----\n";
    		$back_file = $new_path .'/bottom_back.jpg';
    		copy($new_file, $back_file);
    		copy($v, $new_file);
    	}
    	print_r($this->error);
    }
    //生成缩略图
    public function actionThumb(){
    	$this->cube_path = $this->find_path.'/'.$this->default_new_folder;
    	$this->default_pano_name = $this->new_pano_name;
    	$path = $this->cube_path;
    	$this->panos_path = array();
    	$this->myscandir($path);
    	//print_r($this->panos_path);
    	$i = 0;
    	foreach ($this->panos_path as $v){
    		echo "----thumb file {$v} ----\n";
    		$old = $v;
    		$length = strlen($this->default_pano_name);
    		$new_path = substr($v, 0,strlen($v)-$length);
    		$new = $new_path.$this->thumb_name;
    		$myimage = new Imagick($old);
    		$myimage->cropimage(4000, 2000, 926, 300);
    		$myimage->writeImage($new);
    		
    		$myimage->resizeimage(800, 400, Imagick::FILTER_LANCZOS, 1, true);
    		$new = $new_path.$this->thumb_size800;
    		$myimage->writeImage($new);
    		
    		$myimage->resizeimage(200, 100, Imagick::FILTER_LANCZOS, 1, true);
    		$new = $new_path.$this->thumb_size;
    		$myimage->writeImage($new);
    		$myimage->clear();
    		$myimage->destroy();
    		$i++;
    		echo "----end thumb file {$v} ----\n";
    	}
    	print_r($this->error);
    }
    //cube to sphere
    public function actionSphere(){
    	$this->cube_path = $this->find_path.'/'.$this->default_new_folder;
    	$this->panos_path = array();
    	$path = $this->cube_path;
    	$this->myScanCubeDir($path);
    	print_r($this->panos_path);
    	$this->sphere($this->panos_path[0]);
    	$this->exec_sphere();
    }
    public function sphere($path){
    	$front = $path.'/cube/front.jpg';
    	$left = $path.'/cube/left.jpg';
    	$back = $path.'/cube/back.jpg';
    	$right = $path.'/cube/right.jpg';
    	$top = $path.'/cube/top.jpg';
    	$bottom = $path.'/cube/bottom.jpg';
    	$script = "p w{$this->swidth} h{$this->sheight} f2 v360 u0 n\"JPEG\"
i n\"{$front}\"
o f0 y0 r0 p0 v90
i n\"{$left}\"
o f0 y90 r0 p0 v90
i n\"{$back}\"
o f0 y-180 r0 p0 v90
i n\"{$right}\"
o f0 y-90 r0 p0 v90
i n\"{$top}\"
o f0 y0 r0 p90 v90
i n\"{$bottom}\"
o f0 y0 r0 p-90 v90";
    	return file_put_contents('script-s.txt', $script);
    }
    public function exec_sphere(){
    	$str = "/usr/local/libpano13/bin/PTmender script-s.txt";
    	echo "----sphere pano {$this->split_file}----\n";
    	system($str);
    	echo "----sphere pano down {$this->split_file}----\n";
    	$this->covert();
    }
    public function exec_libpano(){
    	$str = "/usr/local/libpano13/bin/PTmender script.txt";
    	echo "----cube pano {$this->split_file}----\n";
    	system($str);
    	echo "----cube pano down {$this->split_file}----\n";
    	$this->covert();
    }
    public function covert(){
    	$panos = array( 'pano0005'=>'bottom',
    					'pano0000'=>'front',
    					'pano0001'=>'right',
    					'pano0002'=>'back',
    					'pano0003'=>'left',
    					'pano0004'=>'top', );
		foreach($panos as $k=>$v){
			$old = $k.'.tif';
			$new = $v.'.jpg';
			echo "----covering tifToJpg {$old}----\n";
			$this->tifToJpg($old, $new);
			echo "----covering tifToJpg success {$old}----\n";
			$this->move_cube_file($new);
		}
    }
    public function move_cube_file($file){
    	$explode = explode('/', $this->split_file);
    	$num = count($explode)-2;
    	$new_folder = $this->cube_path.'/'.$explode[$num].'/cube';
    	$new_file = $new_folder.'/'.$file;

    	if(!file_exists($new_folder)){
    		mkdir($new_folder);
    	}
    	
    	copy($file, $new_file);
    	echo "....moving to {$new_file}\n";
    }
    public function tifToJpg($old, $new){
    	if(!file_exists($old)){
    		$this->error[] = $old;
    		return false;
    	}
    	$myimage = new Imagick($old);
    	$myimage->setImageFormat("jpeg");
    	$myimage->setCompressionQuality( 100 );
    	$myimage->writeImage($new);
    	$myimage->clear();
    	$myimage->destroy();
    	if(!file_exists($new)){
    		$this->error[] = $old;
    		return false;
    	}
    }
    public function cube($path){
    	$script = "p w{$this->width} h{$this->width} f0 v90 u20 n\"TIFF_m\"\n
i n\"{$path}\"\n
o f4 y0 r0 p0 v360\n
i n\"{$path}\"\n
o f4 y-90 r0 p0 v360\n
i n\"{$path}\"\n
o f4 y-180 r0 p0 v360\n
i n\"{$path}\"\n
o f4 y90 r0 p0 v360\n
i n\"{$path}\"\n
o f4 y0 r0 p-90 v360\n
i n\"{$path}\"\n
o f4 y0 r0 p90 v360";
    	return file_put_contents('script.txt', $script);
    }
    public function moveFiles(){
        if(!$this->panos_path){
            return false;
        }
        foreach($this->panos_path as $v){
            $path_explode = explode(DIRECTORY_SEPARATOR, $v);
            $num = count($path_explode)-3;
            $folder = $path_explode[$num];
            $path = $this->find_path. DIRECTORY_SEPARATOR . $this->default_new_folder. DIRECTORY_SEPARATOR. $folder;
            $new_file = $path.DIRECTORY_SEPARATOR.$this->default_pano_name;

            if(!file_exists($path)){
                mkdir($path);
                //copy($v, $dest)
            }
            if(file_exists($new_file)){
                continue;
            }
            if( !copy($v, $new_file)){
                echo 'error---'.$new_file."\n";
            }
            else{
                echo 'ok---'.$new_file."\n";
            }
        }
    }
    /**
     * 扫描目录
     */
    public function myscandir($path, $scan_default=false){
        if(!is_dir($path))  return;

        foreach(scandir($path) as $file){
            if($file!='.'  && $file!='..' && $file != $this->default_new_folder){
                $path2= $path.DIRECTORY_SEPARATOR.$file;
                if(is_dir($path2)){
                    $this->myscandir($path2);
                }
                else if($scan_default){
                	$this->panos_path[] = $path.DIRECTORY_SEPARATOR.$file;
                }
                else if($file == $this->default_pano_name){
                    $this->panos_path[] = $path.DIRECTORY_SEPARATOR.$file;
                }
            }
        }
    }
    /**
     * 扫描目录下的cube
     */
    public function myScanCubeDir($path){
    	if(!is_dir($path))  return;
    	foreach(scandir($path) as $file){
    		if($file!='.'  && $file!='..' && $file!='bottom'){
    			$path2= $path.DIRECTORY_SEPARATOR.$file;
    			if(is_dir($path2)){
    				$this->panos_path[] = $path2;
    			}
    		}
    	}
    	
    }
}