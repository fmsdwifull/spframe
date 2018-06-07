<?php

/**
* \HomeController
*/

use Illuminate\Support\Facades\DB;
error_reporting(0);

class SmsController extends BaseController
{	 
	function getVerifyCode()
	{	
		header("Access-Control-Allow-Origin: *");

		$mobile = $_GET['mobile'];
		if(strlen($mobile )==0)
		{
			echo "必须传入手机号码";
			return  false;
		}
        //$verifycode = rand(pow(10,(4-1)), pow(10,4)-1);
		$verifycode = str_pad(mt_rand(0, 999999), 6, "0", STR_PAD_BOTH);;

	    //实例化redis
        $redis = new Redis();
        //连接
        $redis->connect('127.0.0.1', 6379);
        //检测是否连接成功
        

        $redis->set($mobile, $verifycode);
        //echo $redis->get('cat'); // 111
        		
		
		/**
		 * demo 测试类
		 */
		$url 		= "http://www.ztsms.cn/sendNSms.do";//提交地址
		$username 	= 'fastkd';//用户名
		$password 	= 'Fastkd123';//原密码
		$sendAPI = new sendAPI($url, $username, $password);
		$data = array(
			'content' 	=> '您的短信验证码为'.$verifycode.'千万不要告诉别人哦 【天天开心】',//短信内容
			'mobile' 	=> $mobile,//手机号码
			'productid' => '676767',//产品id
			'xh'		=> ''//小号
		);
		$sendAPI->data = $data;//初始化数据包
		$ret = $sendAPI->sendSMS('POST');//GET or POST
		echo "您的验证码正在路上..........";
	}	
	

	function querydb()
	{
		//$articles = DB::table('articles')->get();
		$articles=DB::select("select * from articles");  
		//返回一个二维数组  $student  
		var_dump($articles);  
	}
    

	function uploadClientInfo()
	{
		header("Access-Control-Allow-Origin: *");

		//var_dump($_GET['ctd']);die;
		$clientInfo = $_GET['ctd'];
		$clientInfo=json_decode($clientInfo,true);
		
		$client_mob = $clientInfo['contactmobile'];
		$verify_code = $clientInfo['verifycode'];
		#$verify_code = "329486";
		//echo $_SESSION[$client_mob];die;;
		
        $redis = new Redis();
        //连接
        $redis->connect('127.0.0.1', 6379);
        //检测是否连接成功

        $currentmob = $redis->get($client_mob); // 111
		
		//if(0)
		if($verify_code != $currentmob)
		{
			echo "验证码不正确";
			return false;
		}			
		//var_dump($clientInfo);
		if((strlen($clientInfo['contactname'])==0)||(strlen($clientInfo['contactmobile'])==0))
		{
			echo "提交数据有误请检测";
			return false;
		}		
		
		$ct = new Client;
		$ct->client_name = $clientInfo['contactname'];
		$ct->client_mob = $clientInfo['contactmobile'];
		$ct->client_province = $clientInfo['city'];
		$ct->client_city = $clientInfo['country'];
		$ct->client_addr = $clientInfo['addr'];
		$ct->client_page = $clientInfo['page'];
		$ct->client_from = $clientInfo['from'];		
		
		$ret = $ct->save();
		if($ret)
		{
			echo "信息提交成功，客服会稍后主动联系您！";
		}
	}	


	function fdlist(){
		$ct = new Client;
		$ctdata = Client::all();
		$lstarray = array();
		foreach($ctdata as $k=>$val)
		{
			$lstarray[$k]['client_name'] = $val['client_name'];
			$lstarray[$k]['client_mob'] = $val['client_mob'];
			$lstarray[$k]['client_province'] = $val['client_province'];
			$lstarray[$k]['client_city'] = $val['client_city'];
			$lstarray[$k]['client_addr'] = $val['client_addr'];
			$lstarray[$k]['client_page'] = $val['client_page'];
			$lstarray[$k]['client_from'] = $val['client_from'];
		}
        $smarty = new Smarty;
        $smarty->setTemplateDir(dirname(__FILE__).'/../views');
		$smarty->assign('xx3', $lstarray);
		$smarty->display("fdlist.html");
	}
	function ndlist(){
		$ct = new Client;
		$ctdata = Client::all();
		$lstarray = array();
		foreach($ctdata as $k=>$val)
		{
			$lstarray[$k]['client_name'] = $val['client_name'];
			$lstarray[$k]['client_mob'] = $val['client_mob'];
			$lstarray[$k]['client_province'] = $val['client_province'];
			$lstarray[$k]['client_city'] = $val['client_city'];
			$lstarray[$k]['client_addr'] = $val['client_addr'];
			$lstarray[$k]['client_page'] = $val['client_page'];
			$lstarray[$k]['client_from'] = $val['client_from'];
		}
		$this->assign('xx3', $lstarray);
		$this->display("fdlist.html");
	}
}
