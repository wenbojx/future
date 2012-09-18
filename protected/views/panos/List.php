<div>
<?php if(isset($datas['list'])){ foreach($datas['list'] as $v){?>
    <dl>
        <dt>
            <?php echo CHtml::link($v['name'],array('panos/pano/show/','id'=>$v['id']));?>
        </dt>
        <dd></dd>
    </dl>
<?php }}?>
</div>