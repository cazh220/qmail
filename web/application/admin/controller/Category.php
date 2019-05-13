<?php
namespace app\admin\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\View;

class Category extends Controller
{
    public function index()
    {
		$view = new View();
		return $view->fetch('admin/system-category');
    }
	
	
}
