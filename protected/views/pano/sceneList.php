<?php $this->pageTitle=$datas['page_title'].'---足不出户，畅游中国';?>
<div class="detail">
    <div class="hero-unit margin-top55">
        <h2>足不出户  畅游中国</h2>
    </div>
    <ul class="breadcrumb">
        <li><?php echo CHtml::link('项目',array('pano/project/list'));?> <span class="divider">/</span></li>
        <li class="active">场景</li>
    </ul>
    <div class="row-fluid">
        <div class="span9">
            <div class="thumbnail">
            	<div class="scene_list">
            	<?php if(isset($datas['list'])){ foreach($datas['list'] as $v){?>
            		<div class="scene_single">
            			<div class="previe_img">
	            			<a href="<?=$this->createUrl('/pano/salado/edit/', array('id'=>$v['id']));?>">
	            			<img width="200" src="<?=$this->createUrl('/panos/thumb/pic/', array('id'=>$v['id'], 'size'=>'200x100.jpg'));?>"/>
	            			</a>
            			</div>
            			<div class="scene_title">
            				<div class="title_line">
            					<?php echo $v['id'];?> : <?php echo CHtml::link($v['name'],array('pano/salado/edit','id'=>$v['id']));?>
            				</div>
            				<div class="scene_desc">
            					<?=$v['desc']?>
            					<br>
            					<?php echo CHtml::link('编辑',array('pano/scene/edit','id'=>$v['id']));?>
                    		</div>
                    	</div>
                    </div>
                    <div class="clear"></div>
                <?php }}?>
            	</div>
            	<div class="page-footer">
					<div class="pagination">
                    <?php if(isset($datas['pages'])){ $this->widget('CLinkPager',array(
                        'header'=>'',
                        //'firstPageLabel' => '首页',
                        //'lastPageLabel' => '末页',
                        'prevPageLabel' => '上一页',
                        'nextPageLabel' => '下一页',
                        'pages' => $datas['pages'],
                        'maxButtonCount'=>10
                        )
                    );}?>
                    </div>
            	</div>
            </div>
        </div>
        <div class="span3">
            <div class="thumbnail">
                <div class="list_box">
                	<button class="btn btn-success" onclick="jump_to('<?=$this->createUrl('/pano/scene/add/', array('id'=>$project_id));?>')">新建场景</button>
                </div>
            </div>
        </div>
    </div>
</div>

