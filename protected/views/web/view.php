<?php $this->pageTitle=$datas['project']['name'].'---足不出户，畅游中国';?>
<div class="view">
	<div class="hero-unit margin-top55">
		<div class="banner_box">
			<h2>足不出户 畅游中国</h2>
			<div class="r_index">
				<a style="color:#0088CC;" href="/">返回首页</a>
			</div>
		</div>
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
			<h3></h3>
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