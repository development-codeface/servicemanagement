<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\Menus;



use Request;
use Hash;
use DB;
use Auth;
use URL;
use App;

class ValidationController extends Controller
{
    public function postValidation()
    {
        $message = "";
        $status = 0;
        $html = "";
        $data = "";

        switch (Request::input('type')) {
            case 'number':
                $user = User::where('mobile', Request::input('mobile'))->count();
                if($user != 0){
                    return response()->json('Number already exist!');
                }else{
                    return response()->json('true');
                }

                break;
            case 'email':
                if(Request::input('id')!=''){
                    $user = User::find(Request::input('id'));
                    if($user->email == Request::input('email')){
                        return response()->json('true');
                    }else{
                        return response()->json('Email already exist!');
                    }
                }else{
                    $user = User::where('email', Request::input('email'))->count();
                    if($user != 0){
                        return response()->json('Email already exist!');
                    }else{
                        return response()->json('true');
                    }
                }
                break;
            case 'permission':
                if(Request::input('permission_id')!=''){
                    $permission = Permissions::find(Request::input('permission_id'));
                    if($permission->permission_name == Request::input('permission_name')){
                        return response()->json('true');
                    }else{
                        return response()->json('Permission already exist!');
                    }
                }else{
                    $routes = Route::getRoutes();
                    $value =array();
                    foreach ($routes as $route) {
                        if($route->getName() !=null || $route->getName() !=''){
                            array_push($value, $route->getName());
                        }
                    }
                    if (in_array(Request::input('permission_name'), $value)) {

                        $user = Permissions::where('permission_name', Request::input('permission_name'))->count();
                        if($user != 0){
                            return response()->json('Permission already exist!');
                        }else{
                            return response()->json('true');
                        }

                    }else{
                        return response()->json('Route Name does not exist!');
                    }

                }
                break;
            case 'userRole':
                if(Request::input('role_id')!=''){
                    $role = Roles::find(Request::input('role_id'));
                    if($role->role_name == Request::input('role_name')){
                        return response()->json('true');
                    }else{
                        return response()->json('Role already exist!');
                    }
                }else{
                    $user = Roles::where('role_name', Request::input('role_name'))->count();
                    if($user != 0){
                        return response()->json('Role already exist!');
                    }else{
                        return response()->json('true');
                    }
                }
                break;
            case 'category':
                $exist =  Categories::where('category_name', '=', Request::input('category_name'))->where('is_active',1)->exists();

                if( Request::input('category_id')!=''){
                    $category = Categories::where('category_id', Request::input('category_id'))->where('is_active',1)->first();
                    if($category->category_name == Request::input('category_name')){
                        return response()->json('true');
                    }
                    else{
                        if($exist){
                            return response()->json('Categories already exist!');
                        }else{
                            return response()->json('true');
                        }
                    }
                }else{
                    if($exist){
                        return response()->json('Categories already exist!');
                    }else{
                        return response()->json('true');
                    }
                }

                break;
            case 'menu':

                $exist =Menus::where('menu_name', '=', Request::input('menu_name'))->exists();

                if( Request::input('menu_id')!=''){

                    $menu = Menus::where('menu_id', Request::input('menu_id'))->first();
                    if($menu->menu_name == Request::input('menu_name')){
                        return response()->json('true');
                    }
                    else{

                        if($exist){
                            return response()->json('Menu already exist!');
                        }else{

                            return response()->json('true');
                        }
                    }
                }else{
                    if($exist){
                        return response()->json('Menu already exist!');
                    }else{
                        return response()->json('true');
                    }
                }

                break;
            case 'brand':
                $exist =  Brands::where('brand_name', '=', Request::input('brand_name'))->where('is_active',1)->exists();
                if( Request::input('brand_id')!=''){
                    $brand = Brands::where('brand_id', Request::input('brand_id'))->where('is_active',1)->first();
                    if($brand->brand_name == Request::input('brand_name')){
                        return response()->json('true');
                    }
                    else{
                        if($exist){
                            return response()->json('Brand already exist!');
                        }else{
                            return response()->json('true');
                        }
                    }
                }else{
                    if($exist){
                        return response()->json('Brand already exist!');
                    }else{
                        return response()->json('true');
                    }
                }

                break;
        }
        return response()->json(['status' => $status, 'message' => $message, 'html' => $html, 'data' => $data]);

    }



}
