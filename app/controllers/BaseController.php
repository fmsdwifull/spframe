<?php
/**
* BaseController
*/
class BaseController
{
  public $view;
  public function __construct()
  {
       $this->view = new Smarty;
       $className = get_class($this);
       $pos = strpos($className,'Controller');
       $viewPath = strtolower(substr($className,0,$pos));	
       $this->view->setTemplateDir(dirname(__FILE__).'/../views/'.$viewPath);
       //print_r(__FILE__);
       //print_r(dirname(__FILE__));

  }
  public function display($v)
  {
      //var_dump(get_class($this));
      return $this->view->display($v);	
  }
  
  public function assign($key, $value)
  {
      //var_dump(get_class($this));
      return $this->view->assign($key, $value);	
  }
}
