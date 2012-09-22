<?php $this->pageTitle='足不出户，行遍中国';?>
<div class="hero-unit">
	<h1>足不出户，游遍中国</h1>
	<p>用心记录每一步</p>
</div>

<div class="row about">
	<div class="span6">
		<h3>留下足迹</h3>
		<p>走遍世界各地，记录精彩瞬间</p>
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