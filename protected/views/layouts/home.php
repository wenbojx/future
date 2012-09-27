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
                <a href="/" class="brand">一路好</a>
                <div id="main-menu" class="nav-collapse">
                    <!-- <ul id="main-menu-left" class="nav">
                        <li><a href="<?=$this->createUrl('/web/list/a');?>">全部景点</a></li>
                    </ul>-->
                    <ul id="main-menu-right" class="nav pull-right bold font-size14">
                        <li><a href="<?=$this->createUrl('/web/list/a');?>">全部景点</a></li>
                        <li><a href="<?=$this->createUrl('/member/register/a');?>">注册</a></li>
                        <li><a href="<?=$this->createUrl('/member/login/a');?>">登陆</a></li>
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
    <a target="_blank" href="http://weibo.com/yiluhao">关注微博</a><br>

    </div>
</div>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/style/js/google.analytics.js"?>"></script>
</body>
</html>