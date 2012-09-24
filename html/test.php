<?php
$md = new Memcached();
$md->addServer('127.0.0.1', 11211);
$v = $md->get('counter', null, $token);
$md->cas($token, 'counter', $v + 1);