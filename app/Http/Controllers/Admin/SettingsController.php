<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Permissions;
use App\Models\RoleHasPermissions;
use App\Models\Roles;
use App\Models\SubPermissions;
use App\Models\Tokens;
use App\Models\User;
use App\Models\Tocken;
use App\Models\UserHasRoles;
use App\Models\Technician;
use App\Models\PartsOrder;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;


use Illuminate\Support\Facades\Route;
use Request;
use Hash;
use DB;
use Auth;
use URL;
use Redirect;

class SettingsController extends Controller
{


    public function getView($id = 0)
    {
        $view = '';
        $data = Array();

        switch(Request::segment(1)) {


            case '':

                $view = 'admin.settings.login';
             break;
            case 'dashboard':

                $view = 'admin.settings.dashboard';
                break;
            case 'home':

                $view = 'admin.settings.dashboard';
                break;

            case 'tss_dashboard':

               $data['newjobs'] = Job::count();
               $data['comjobs'] = Job::where('status','=',41)->count();
               $data['pendjobs'] = Job::where('status','!=',41)->count();
               $data['invoices'] =  Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
               ->leftjoin('users','users.id','=','jobs.technician')
               ->leftjoin('job_status','job_status.status_id','=','jobs.status')
               ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
               ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
               ->orderBy('jobs.job_date', 'desc')
               ->where('jobs.status','=',41)
               ->count();



                $view = 'admin.settings.tss_dashboard';
                break;
            case 'asp_dashboard':

            $data['newjobs'] = Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
            ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
            ->leftjoin('users','users.id','=','jobs.technician')
               ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                 ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
               ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
               ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                 ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                 ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                  ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                 //->where('jobs.status','!=',41)
                 ->orderBy('jobs.job_date', 'desc')
                 
                
                   
            ->count();
        


            $data['comjobs']= DB::table('jobs')
                    ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                    ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                    ->leftjoin('users','users.id','=','jobs.technician')
                       ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                         ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                       ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                       ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                       ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                         ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                         ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                         ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')

                          ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                         ->where('jobs.status','=',41)
                         ->orderBy('jobs.job_date', 'desc')
                        
                    
            ->count();

           
            $data['pendjobs'] = Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
            ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
           ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
            ->where('jobs.status','!=',41)
            ->count();
            

                $view = 'admin.settings.asp_dashboard';
                break;
            case 'user_dashboard':

            $data['jobs'] = Job::leftjoin('users','users.id','=','jobs.technician')
            ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            ->leftjoin('job_status','job_status.status_id','=','jobs.status')
            ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
            ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
           ->where('jobs.technician','=',Auth::user()->id)
            ->orderBy('jobs.job_date', 'desc')->count();
        
        $data['comjobs'] = Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
        ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
        ->where('jobs.technician','=',Auth::user()->id)->where('status','=',41)->count();

       
        $data['pendjobs'] = Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
        ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
        ->where('jobs.technician','=',Auth::user()->id)->where('status','!=',41)->count();
        
                $view = 'admin.settings.user_dashboard';
                break;

                case 'log_dashboard':

                $data['jobs'] = PartsOrder::where('isapprove','=',1)->count();
                $data['gma'] = DB::table('product_repalcement_order')->join('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
          ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
          ->join('symptoms','symptoms.symptom_id','=','jobs.symptom')
          ->where('product_repalcement_order.is_approve','=',1)
        
          ->count();
                $data['rma'] = DB::table('product_repalcement_order')->join('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
             ->join('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
             ->join('symptoms','symptoms.symptom_id','=','jobs.symptom')
             ->leftjoin('job_status','job_status.status_id','=','jobs.status')
             ->where('product_repalcement_order.is_approve','=',1)
             
             //->orderBy('jobs.job_date', 'desc')
             ->count();
                $view = 'admin.settings.log_dashboard';
                break;
            case 'forgot':
                $view = 'admin.settings.forgotPassword';
                break;

            case 'adminReset':

                $query = DB::table('tokens');
                $query->where('token_status',1);
                $query->where('token_code',Request::segment(2));
                $token = $query->first();
                if($token!=null){
                    $data['resetId'] =$token;
                }else{
                    return Redirect::to(URL::route('/'));
                }

                $view = 'admin.settings.resetPassword';
                break;


            case 'admin-profile':
                $data['userProfile'] = User::where('id',Auth::user()->id)->first();
                
                $view = 'admin.settings.profile';
                break;
            case 'admin-password':
                $view = 'admin.settings.password';
            break;


            case '$2y$10$V091JdZYAeUEdnuQZaEUUe24XOd9gcp3eqi27jUbU43uFrMJR':
                  $view = 'admin.settings.404';
             break;
        }

        return view($view)->with($data);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    //common post function
    public function authManage(){

        $message = "";
        $status = 0;
        $html = "";
        $data = "";


        switch (Request::input('type')) {

            case 'login':
           
           $email=Request::input('email');
           $pass=Request::input('password');
           if (Auth::attempt(['email' => $email, 'password' => $pass])) {
            
             if(Auth::user()->user_role_id == 1){
                $status=1;      
             }
             elseif(Auth::user()->user_role_id == 2){
                $status=2;
            }
            elseif(Auth::user()->user_role_id == 3){
                $status=3;
            }
            elseif(Auth::user()->user_role_id == 4){
                $status=4;
            }
            else{
                $status=0;
            }
             
        }
            
                break;

            case 'forgotPassword':

                $email =Request::input('forgot_email');
               
                if(isset($email)) {

                    $query = DB::table('users');
                    $query->where('users.email', $email);
                    $user = $query->first();
                    $token = md5(uniqid(rand(), true ));
                    if(!empty($user)) {
                        Tokens::create([
                            'token_code' => $token,
                            'user_id' => $user->id,
                            'token_status' => 1,
                        ]);

                        $data['type'] = "AdminResetPassword";
                        $data['url'] = URL::route("AdminResetPassword") . '/' . $token;
                        $data['userId'] = $user->id;
                        $data['tocken'] = $token;
                     
                        Mail::send('layouts.email', $data, function ($message) {
                            $message->to(Request::input('forgot_email'), 'Reset Password ')->from('info@ccafe.in')->subject('Reset Password');
                        });
                        
                        $html = 'Your Mail Successfiully Updated';
                        $status = 1;
                    }else{
                        $status = 2;
                        $html = '<p style="color: red;">Invalid Email Address</p>';

                    }


                }

                break;
            case 'AdminResetPassword':
            
                $adminResetPassword = User::find(Request::input('userId'));
                $adminResetPassword->password = Hash::make(Request::input('password'));
                $adminResetPassword->save();
                $delete = Tokens::where('user_id',Request::input('userId'))->delete();

            break;

            case 'AdminUpdateProfile':
                $adminUpdateProfile = User::find(Request::input('user_id'));
                $adminUpdateProfile->name = Request::input('username');
                $adminUpdateProfile->email = Request::input('email');
                $adminUpdateProfile->save();
            break;

            case 'AdminUpdatePassword':

                $adminUpdatePassword = User::find(Request::input('user_id'));
                $adminUpdatePassword->password = Hash::make(Request::input('password'));
                $adminUpdatePassword->save();
            break;


        }
        return response()->json(['status' => $status, 'message' => $message, 'html' => $html, 'data' => $data]);

    }


}
