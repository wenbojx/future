<?php $this->pageTitle=$datas['project']['name'].'---足不出户，行遍中国';?>
<div class="view">
	<div class="hero-unit margin-top55">
		<h2>足不出户，游遍中国</h2>
	</div>
	
	<div class="row about">
		<div class="span6">
		<?php if($datas['project']){?>
			<h3><?=$datas['project']['name']?></h3>
			<p>
				<?=$datas['project']['desc']?>
			</p>
		<?php }?>
	 	</div>
	 	<div class="span6">
			<h3>评论</h3>
			<ol>
				
			</ol>
	 	</div>
	</div>
	<hr class="line3">
	<div class="row project view">
	<?php if($datas['list']){ foreach ($datas['list'] as $v){?>
		<div class="span3">
			<div class="thumbnail">
				<a href="<?=$this->createUrl('/web/detail/a/', array('id'=>$v['id']));?>">
				<img src="<?=$this->createUrl('/panos/thumb/pic/', array('id'=>$v['id'], 'size'=>'200x100.jpg'));?>"/>
				</a>
			</div>
		</div>
	<?php }}?>
	</div>
</div>