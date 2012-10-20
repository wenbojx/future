<?php
class DealPanosCommand extends CConsoleCommand {
    public $defaultAction = 'index'; //默认动作

    public $path = 'C:\Users\faashi\Desktop\pics\0826';
    public $panos_path = array();
    public $default_new_folder = 'panos';
    public $default_pano_name = 'Panorama.jpg';
    public $width = '1863';

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
    	print_r($this->panos_path);
    	//$this->slip($this->panos_path[0]);
    	$this->slip('a.jpg');
    }
    
    public function slip($path){
    	$script = "p w{$this->width} h{$this->width} f0 v90 u20 n'TIFF_m'\n
i n'{$path}'\n
o f4 y0 r0 p0 v360\n
i n'{$path}'\n
o f4 y-90 r0 p0 v360\n
i n'{$path}'\n
o f4 y-180 r0 p0 v360\n
i n'{$path}'\n
o f4 y90 r0 p0 v360\n
i n'{$path}'\n
o f4 y0 r0 p-90 v360\n
i n'{$path}'\n
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