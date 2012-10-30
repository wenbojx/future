<?php $this->pageTitle=$datas['page_title'].'---足不出户，畅游中国';?>
<div class="detail">
    <div class="hero-unit margin-top55">
        <h2>足不出户  畅游中国</h2>
    </div>
    <ul class="breadcrumb">
        <li class="active">项目</li>
    </ul>
    <div class="row-fluid">
        <div class="span9">
            <div class="thumbnail">
            	<div class="project_list">
            	<?php if(isset($datas['list'])){ foreach($datas['list'] as $v){?>
            		<div class="project_single">
            			<div class="float_left title">
                    	<?php echo $v['id'];?> : <?php echo CHtml::link($v['name'],array('pano/scene/list','id'=>$v['id']));?>
                    	</div>
                    	<div class="float_right tools">
                    	<?php echo CHtml::link("编辑",array('pano/project/edit','id'=>$v['id']));?>
                    	</div>
                    </div>
                <?php }}?>
            	</div>
            	<div class="page-footer">
					<div class="pagination">
                    <?php if(isset($datas['pages'])){  $this->widget('CLinkPager',array(
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
                	<button class="btn btn-success" onclick="jump_to('<?=$this->createUrl('/pano/project/add/');?>')">新建项目</button>
                </div>
            </div>
        </div>
    </div>
</div>

