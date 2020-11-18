<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Role;
use App\Model\Right;
use Illuminate\Support\Facades\Route;
use App\Model\Roleright;
use App\Model\Adminrole;
use DB;
class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = session('login');
        $admin_id = $data['admin_id'];
         
        if(empty($admin_id)){
            return redirect('/login')->with('msg','请先登录！');
        }
       $name=Route::currentRouteName();
       
 


       if($data->admin_name =='admin'){
                $datas=Right::where('is_show',1)->get();

            }else{              //角色权限表
              $datas=Right::join('role_right',"right.right_id","=","role_right.right_id")
              ->join('admin_role',"admin_role.role_id","=","role_right.role_id")
              ->distinct('role_right.right_id')
              ->where(['admin_role.admin_id'=>$data-> admin_id,'is_show'=>1])
              ->get(['role_right.right_id','right.*']);
              $routName=[];
              foreach($datas as $key=>$val){
                  $routName[]=$val->right_as;
              }
              if($name!='aindex'){
                if(!in_array($name,$routName)){
                  return redirect('/login')->with('msg','没有权限');
                }
              }
            }

           
            $reg=$this->createSoneTree($datas);
            view()->share('aaaaa',$reg);
            return $next($request);
    }
    public function createSoneTree($dataAll,$parent_id=0){
          if(!$dataAll){
                return;
          }
          $Arrays=[];
          foreach($dataAll as $k=>$v){
            if($v['parent_id']==$parent_id){
                $Arrays[$k] = $v;
                $Arrays[$k]['son'] = $this->createSoneTree($dataAll,$v['right_id']);
             }
          }
          return $Arrays;
    }
}
