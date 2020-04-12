<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Menu;

class AdminBaseController extends Controller
{

    public function __call($method, $parameters)
    {
        parent::__call($method, $parameters); // TODO: Change the autogenerated stub
    }

    public function getMenuTree($where=['pid'=>0]){
        $list = Menu::menuList($where);

        foreach ($list as $key => $value){
            $where['pid'] = $value['menu_id'];
            $data = $this->getMenuTree($where);
            if(sizeof($data)>0) {
                $list[$key]['child'] = $data;
            }
        }
        return $list;
    }
}