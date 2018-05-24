<?php

use NoahBuscher\Macaw\Macaw;

Macaw::get('/spframe/public/index.php/xxx', function() {
  echo "成功！";
});

Macaw::get('(:all)', function($fu) {
  echo '未匹配到路由<br>'.$fu;
});

Macaw::get('/spframe/public/index.php/home', 'HomeController@home');
Macaw::get('/spframe/public/index.php/home/kk', 'HomeController@kk');
Macaw::get('/spframe/public/index.php/mredis', 'MredisController@index');
Macaw::get('/spframe/public/index.php/mredis/connect', 'MredisController@connect');

Macaw::dispatch();
