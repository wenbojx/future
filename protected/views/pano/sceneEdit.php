<?php 
$this->pageTitle=$datas['page_title'].'---足不出户，畅游中国';
$edit = $datas['done'] == 'doEdit' ? true : false;
?>
<div class="detail">
    <div class="hero-unit margin-top55">
        <h2>足不出户  畅游中国</h2>
    </div>
    <ul class="breadcrumb">
        <li><?php echo CHtml::link('项目',array('pano/project/list'));?> <span class="divider">/</span></li>
        <li><?php echo CHtml::link('场景',array('pano/scene/list', 'id'=>$project_id));?> <span class="divider">/</span></li>
    	<li class="active"><?=$datas['page_title']?></li>
    </ul>
    <div class="row-fluid">
        <div class="span9">
            <div class="thumbnail">
				
				<form method="post" class="form-horizontal" id="save_scene" action="<?=$this->createUrl('/pano/scene/'.$datas['done'])?>">
                    <fieldset>
                        <legend><?=$datas['page_title']?></legend>
                        <div class="save_project_filed">
	                        <div class="control-group">
	                            <label class="control-label" for="login_email">场景名称</label>
	                            <div class="controls">
	                            	<input name="project_id" type="hidden" value="<?=$project_id?>" id="project_id">
    								<input name="name" type="text" value="<?=$edit ? $datas['scene']['name']:''?>" class="input-xlarge" id="scene_name">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label" for="login_passwd">场景简介</label>
	                            <div class="controls">
	                            	<textarea name="desc" id="scene_desc" class="input-xlarge" rows="3"><?=$edit ? $datas['scene']['desc']:''?></textarea>
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label" for="login_passwd">拍摄时间</label>
	                            <div class="controls">
	                            	<input type="text" name="photo_time" class="input-xlarge" value="<?=$edit ? date('Y-m-d H:i',$datas['scene']['photo_time']):''?>" id="scene_photo_time">
	                            </div>
	                        </div>
	                        
	                        <div class="form-actions">
	                            <button class="btn btn-primary" type="button" onclick="save_scene(<?=$edit ? $datas['scene']['id']:''?>)">保存</button>
	                            <p class="help-block color_red" id="save_scene_msg"></p>
	                        </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="span3">
            <div class="thumbnail">
                <div class="list_box">
                	<button class="btn btn-success" onclick="jump_to('<?=$this->createUrl('/pano/scene/list/', array('id'=>$project_id));?>')">返回</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var scene_url = '<?=$this->createUrl('/pano/scene/list/', array('id'=>$project_id));?>';
</script>

