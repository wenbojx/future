<?php
$md = new Memcached();
$md->addServer('127.0.0.1', 11211);

$v = $md->set('aaa', 'asdfasdfasdf', '60000');
$a = $md->get('aaa');
echo $a;
echo 111;