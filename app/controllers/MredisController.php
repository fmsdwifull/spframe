<?php

/**
* \MredisController
*/
class MredisController extends BaseController
{
  
  public function index()
  {
        //$smarty->setTemplateDir(dirname(__FILE__).'/../views');
        $this->display("test.html");
  }
  public function connect()
  {
	//实例化redis
        $redis = new Redis();
        //连接
        $redis->connect('127.0.0.1', 6379);
        //检测是否连接成功
        
        /*
        echo "Server is running: " . $redis->ping();
        $redis->set('cat', 111);
        echo $redis->get('cat'); // 111
        $redis->set('cat', 222);
        echo $redis->get('cat');
        */
        $redis->lpush('list', 'html');
        $redis->lpush('list', 'css');
        $redis->lpush('list', 'php');

        //获取列表中所有的值
        $list = $redis->lrange('list', 0, -1);
        print_r($list);echo '<br>'; 

        //从右侧加入一个
        $redis->rpush('list', 'mysql');
        $list = $redis->lrange('list', 0, -1);
        print_r($list);echo '<br>';

        //从左侧弹出一个
        $redis->lpop('list');
        $list = $redis->lrange('list', 0, -1);
         print_r($list);echo '<br>';

    //从右侧弹出一个
    $redis->rpop('list');
    $list = $redis->lrange('list', 0, -1);
    print_r($list);echo '<br>';
  }
}
