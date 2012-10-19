<?php
class DealPanosCommand extends CConsoleCommand {
    public $defaultAction = 'index'; //默认动作

    public $path = '/home/wbli/pics/0826';
    public $panos_path = array();
    public $default_new_folder = 'panos';
    public $default_pano_name = 'Panorama.jpg';

    public function actionFind() {
        $this->myscandir($this->path);
        $new_folder = $this->path. '/' .$this->default_new_folder;
        if(!file_exists($new_folder)){
            mkdir($new_folder);
        }
        $this->moveFiles();

        //print_r($this->panos_path);
    }
    public function moveFiles(){
        if(!$this->panos_path){
            return false;
        }
        foreach($this->panos_path as $v){
            $path_explode = explode('/', $v);
            $num = count($path_explode)-3;
            $folder = $path_explode[$num];
            $path = $this->path. '/' . $this->default_new_folder. '/'. $folder;
            $new_file = $path.'/'.$this->default_pano_name;

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
                $path2= $path.'/'.$file;
                if(is_dir($path2)){
                    $this->myscandir($path2);
                }else if($file == $this->default_pano_name){
                    $this->panos_path[] = $path.'/'.$file;
                }
            }
        }

    }
}