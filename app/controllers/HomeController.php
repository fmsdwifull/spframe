<?php

/**
* \HomeController
*/
class HomeController extends BaseController
{
  
  public function home()
  {
        $article =  Article::first();
        require dirname(__FILE__).'/../views/home.php';

  }
  public function kk()
  {
        $smarty = new Smarty;
       // $smarty->template_dir = dirname(__FILE__).'/../views'; 
        $smarty->setTemplateDir(dirname(__FILE__).'/../views');
	//print_r($smarty->template_dir);
        //$smarty->force_compile = true;
        $smarty->debugging = true;
        $smarty->caching = false;
        $smarty->cache_lifetime = 120;
        $data['111']="sssss";
        $data['222']="eeeeeeeeeeeee";
        $smarty->assign("x1", "NE");
        $smarty->assign("x2", $data);
        $smarty->display('kk.tpl');
  }
}
