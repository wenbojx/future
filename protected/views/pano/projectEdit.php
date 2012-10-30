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
        <li class="active"><?=$datas['page_title']?></li>
    </ul>
    <div class="row-fluid">
        <div class="span9">
            <div class="thumbnail">
				
				<form method="post" class="form-horizontal" id="save_project" action="<?=$this->createUrl('/pano/project/'.$datas['done'])?>">
                    <fieldset>
                        <legend><?=$datas['page_title']?></legend>
                        <div class="save_project_filed">
	                        <div class="control-group">
	                            <label class="control-label" for="login_email">项目名称</label>
	                            <div class="controls">
	                                <input type="text" value="<?=$edit ? $datas['project']['name']:''?>" class="input-xlarge" id="project_name">
	                            </div>
	                        </div>
	                        <div class="control-group">
	                            <label class="control-label" for="login_passwd">项目简介</label>
	                            <div class="controls">
	                            	<textarea id="project_desc" class="input-xlarge" rows="3"><?=$edit ? $datas['project']['desc']:''?></textarea>
	                                
	                            </div>
	                        </div>
	                        <div class="form-actions">
	                            <button class="btn btn-primary" type="button" onclick="save_project(<?=$edit ? $datas['project']['id']:''?>)">保存</button>
	                            <p class="help-block color_red" id="save_project_msg"></p>
	                        </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="span3">
            <div class="thumbnail">
                <div class="list_box">
                	<button class="btn btn-success" onclick="jump_to('<?=$this->createUrl('/pano/project/list/');?>')">返回</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var project_url = '<?=$this->createUrl('/pano/project/list/');?>';
</script>

