<?php $this->pageTitle='足不出户，畅游中国';?>
<div class="hero-unit">
	<h1>足不出户 畅游中国</h1>
	<p><a target="_blank" href="http://weibo.com/yiluhao">关注微博</a></p>
</div>

<div class="row about">
	<div class="span6">
		<h3>奇妙旅程</h3>
		<p>360度全景体验，宅在家里也可以畅游世界</p>
 	</div>
	<div class="span6">
		<h3><a href="<?=$this->createUrl('/web/list/a');?>">全部景点</a></h3>
		<p>更多景点图片正在制作中，敬请期待！
			 <a href="<?=$this->createUrl('/web/list/a');?>">更多...</a>
		</p>
	</div>
</div>
<div class="row case">
<?php if($datas){ foreach ($datas as $v){?>
	<div class="span3">
		<div class="thumbnail">
			<a href="<?=$this->createUrl('/web/detail/a/', array('id'=>$v['id']));?>">
				<img src="<?=$this->createUrl('/panos/thumb/pic/', array('id'=>$v['id'], 'size'=>'200x100.jpg'));?>"/>
			</a>
		</div>
	</div>
<?php }}?>
</div>