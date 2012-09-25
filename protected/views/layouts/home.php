<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/css/bootstrap.css"); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/css/style.css"); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/jquery.min.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/bootstrap.min.js");?>
<title><?=$this->pageTitle?></title>
</head>
<body>
<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a href="<?=$this->createUrl('/');?>" class="brand">一路好</a>
				<div id="main-menu" class="nav-collapse">
					<!-- <ul id="main-menu-left" class="nav">
						<li><a href="<?=$this->createUrl('/web/list/a');?>">全部景点</a></li>
					</ul>-->
					<ul id="main-menu-right" class="nav pull-right">
						<li><a href="<?=$this->createUrl('/web/list/a');?>">全部景点</a></li>
					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
		</div>
</div>
<div class="container">
	<?php echo $content;?>
	<hr class="soften">
	<div id="footer">
	制作：<a href="#" target="_blank">李文博</a> | 电子邮箱：<a href="#">faashi@gmail.com</a> | QQ：24329121<br>
	
	</div>
</div>

</body>
</html>