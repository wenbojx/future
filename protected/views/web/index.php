<?php $this->pageTitle='足不出户，畅游中国';?>
<div class="hero-unit padding5" id="static_banner">
	<div class="banner_box">
		<div class="index_banner" style="background:url(<?=Yii::app()->baseUrl . '/style/banner/'.$datas['baner_scene_id'].'.jpg'?>)">
			<div class="click" onclick="show_banner_pano()">点击，开始奇妙之旅！</div>
			<div class="tips">图片加载完，拖动鼠标，不一样的视觉体验！</div>
		</div>
		<p class="r_top"><a target="_blank" href="http://weibo.com/yiluhao">关注微博</a></p>
	</div>
</div>
<div class="hero-unit banner_box padding5 display_none" id="pano_banner">
	<div class="banner_box">
		<div>
			<iframe src="<?=$this->createUrl('/web/single/a/', array('id'=>$datas['baner_scene_id'],'w'=>'932','h'=>'400','auto'=>'1'));?>" frameborder=0 width="930" height="400" scrolling="no">
			</iframe>
		</div>
		<p class="r_top">
			<a href="javascript::" onclick="show_banner_pic()">收起 | </a>
			<a target="_blank" href="http://weibo.com/yiluhao">关注微博</a>
		</p>
	</div>
</div>

<div class="row about">
	<div class="span6">
		<h3>奇妙旅程</h3>
		<p>360度全景体验，宅在家里也可以畅游世界</p>
 	</div>
	<div class="span6">
		<h3><a href="<?=$this->createUrl('/web/list/a');?>">全部景点</a></h3>
		<p>当前共有 (<a class="color_red" href="<?=$this->createUrl('/web/list/a');?>"><?=$datas['total_num']?></a>) 个场景，
		<a target="_blank" href="http://weibo.com/yiluhao">关注微博</a>，获取最新景点发布信息..
			 <a href="<?=$this->createUrl('/web/list/a');?>">查看全部</a>
		</p>
	</div>
</div>
<div class="row case">
<?php if($datas['scenes']){ foreach ($datas['scenes'] as $v){?>
	<div class="span3">
		<div class="thumbnail">
			<a href="<?=$this->createUrl('/web/detail/a/', array('id'=>$v['id']));?>">
				<img src="<?=$this->createUrl('/panos/thumb/pic/', array('id'=>$v['id'], 'size'=>'200x100.jpg'));?>"/>
			</a>
		</div>
	</div>
<?php }}?>
</div>