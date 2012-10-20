<?php
class DealPanosCommand extends CConsoleCommand {
    public $defaultAction = 'index'; //默认动作

    public $path = 'C:\Users\faashi\Desktop\pics\0826'; //搜索全景图的目录
    public $panos_path = array();
    public $default_new_folder = 'panos';  //新的全景图目录
    public $default_pano_name = 'Panorama.jpg'; //默认的搜索的全景图名称
    public $width = '1863';  //cube图的宽度
    public $error = array();
    public $split_file = '';
    public $cube_path = '/mnt/hgfs/pics/panos/';
    

    public function actionFind() {
        $this->myscandir($this->path);
        $new_folder = $this->path. DIRECTORY_SEPARATOR .$this->default_new_folder;
        if(!file_exists($new_folder)){
            mkdir($new_folder);
        }
        $this->moveFiles();

        //print_r($this->panos_path);
    }
    public function actionSlipt(){
    	$this->default_pano_name = 'Panorama-2.jpg';
    	$path = '/mnt/hgfs/pics/panos';
    	$this->myscandir($path);
    	//print_r($this->panos_path);
    	foreach ($this->panos_path as $v){
    		echo "----deal file {$v} ----\n";
	    	$this->slip($v);
	    	$this->split_file = $v;
	    	$this->exec_libpano();
	    	echo "----end deal file {$v} ----\n";
    	}
    	print_r($this->error);
    }
    public function exec_libpano(){
    	$str = "/usr/local/libpano13/bin/PTmender script.txt";
    	echo "----slipting pano {$this->split_file}----\n";
    	system($str);
    	echo "----slipting pano down {$this->split_file}----\n";
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
    	$new_folder = $this->cube_path.$explode[$num].'/cube';
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
    public function slip($path){
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
            $path = $this->path. DIRECTORY_SEPARATOR . $this->default_new_folder. DIRECTORY_SEPARATOR. $folder;
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
    public function myscandir($path){
        if(!is_dir($path))  return;

        foreach(scandir($path) as $file){
            if($file!='.'  && $file!='..' && $file != $this->default_new_folder){
                $path2= $path.DIRECTORY_SEPARATOR.$file;
                if(is_dir($path2)){
                    $this->myscandir($path2);
                }else if($file == $this->default_pano_name){
                    $this->panos_path[] = $path.DIRECTORY_SEPARATOR.$file;
                }
            }
        }

    }
}