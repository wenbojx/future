<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/css/bootstrap.css"); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/css/style.css"); ?>
<script>
var check_login_url = '<?=$this->createUrl('/member/login/check');?>';
</script>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/jquery.min.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/bootstrap.min.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/core.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/member.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/jcarousellite_1.0.1.js");?>

<?php if (isset ($this->editPano) && $this->editPano){?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/css/salado.edit.css"); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/plugins/uploadify/uploadify.css"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/salado.admin.js");?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/plugins/uploadify/jquery.uploadify-3.1.js");?>
<?php }?>

<?php if (isset ($this->madmin) && $this->madmin){?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/style/css/admin.css"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/style/js/admin.js");?>
<?php }?>

<title><?=$this->pageTitle?></title>
</head>
<body>
<div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a href="/" class="brand">一路好</a>
                <div id="main-menu" class="nav-collapse  bold font-size14">
                    <ul id="main-menu-left" class="nav">
                        <li><a href="<?=$this->createUrl('/web/list/a');?>">全部景点</a></li>
                    </ul>
                    <ul id="main-menu-right" class="nav pull-right">
                        <!-- <li><a href="<?=$this->createUrl('/web/list/a');?>">全部景点</a></li> -->
                        <li id="m_register" style="display:none">
                            <a href="<?=$this->createUrl('/member/register/a');?>">注册</a>
                        </li>
                        <li id="m_login" style="display:none">
                            <a href="<?=$this->createUrl('/member/login/a');?>">登陆</a>
                        </li>
                        <li id="m_welcome" style="display:none">
                            <a href="<?=$this->createUrl('/pano/project/list');?>" id="m_nickname"></a>
                        </li>
                        <li id="m_loginout" style="display:none">
                            <a href="<?=$this->createUrl('/member/loginout/a');?>" id="m_nickname">[退出]</a>
                        </li>
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
    	Copyright © 2012 www.yiluhao.com All Rights Reserved <br>
    	QQ群：280573438 Email:yiluhao@gmail.com 微博：<a href="http://weibo.com/yiluhao" target="_blank">http://weibo.com/yiluhao</a>
    	<br><br><br>
    </div>
</div>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/style/js/google.analytics.js"?>"></script>
</body>
</html>