<?php $this->pageTitle='足不出户，畅游中国';?>
<div class="list">
	<div class="hero-unit margin-top55">
		<h2>足不出户 畅游中国</h2>
	</div>
	
	<div class="row project">
	<?php if($datas['projects']){ foreach($datas['projects'] as $v){?>
		<div class="span6">
			<h3><a href="<?=$this->createUrl('/web/view/a/', array('id'=>$v['project']['id']));?>">
				<?=$v['project']['name']?>
			</a></h3>
			<div class="row">
			<?php if ($v['scene']){ foreach($v['scene'] as $v1){?>
				<div class="span3">
					<div class="thumbnail">
					<a href="<?=$this->createUrl('/web/detail/a/', array('id'=>$v1['id']));?>">
						<img src="<?=$this->createUrl('/panos/thumb/pic/', array('id'=>$v1['id'], 'size'=>'200x100.jpg'));?>"/>
					</a>
					</div>
				</div>
			<?php }}?>
			</div>
		</div>
	<?php }}?>
		
	</div>
</div>