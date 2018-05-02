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
        

      //进队列
      $redis->rpush('queue_name',json_encode(['user_id'=>5]));
      $redis->rpush('queue_name',json_encode(['user_id'=>6]));
      $redis->rpush('queue_name',json_encode(['user_id'=>7]));
      //$res = $redis->lrange('queue_name',0,1000);
      //print_r($res);
      
      //出队列
      $x = $redis->rpop('queue_name');
      print_r($x);
     */
     //监视count的值
    $redis->watch('count');
    $redis->multi();
    $redis->set('count',time());
    sleep(10);

    $res = $redis->exec();
    //提交事务
    if($res){
        echo 'sucesss';
        return;
    }else{
        echo 'fail';
    }
  }
}
