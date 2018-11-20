<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Libraries\UploadFileHandler;
use App\Models\Upload;
use App\Models\Technician;
use App\Models\Csvdata;
use App\Models\ServiceCentre;
use App\Models\User;
use App\Models\WareHouse;
use App\Models\Roles;
use App\Models\Faulty;
use App\Models\Symptom;
use App\Models\Resolutions;
use App\Models\Job;
use App\Models\Customer;
use App\Models\Status;
use App\Models\Appointment;
use App\Models\Parts;
use App\Models\PartsOrder;
use App\Models\Claim;
use App\Models\Product;
use App\Models\RMA;
use App\Models\GRN;
use App\Models\ProductReplacement;
use App\Models\Files;
use App\Models\AspFile;
use App\Models\TechFile;
use App\Models\MultipleParts;
use App\Models\Mileage;
use App\Models\AspAdmin;



use Request;
use Hash;
use DB;
use Auth;
use URL;
use App;
use Redirect;
use PDF;
use Carbon;

class AdminController extends Controller
{

    public function getView($id = 0)
    {
        $view = '';
        $data = Array();

        switch(Request::segment(1)) {




            case 'uploads':

                $data['banners']= Upload::get();


                $view = 'admin.uploads.list';
                break;

            case 'new-upload':

                if($id!=''){
                    
                    $data['banner']= DB::table('uploads')
                        ->where('uploads.upload_id' ,$id)
                        ->first();
                       
                    $data['attachments'] = Upload::where('upload_id','=',$id)->get();
                    //$data['service_types'] = ServiceType::get();
                    if(empty($data['banner'])){
                        return Redirect::to(URL::route('Uploads'));
                    }
                    $view = 'admin.uploads.edit';
                }
				else{
                    $view = 'admin.uploads.edit';
                }

                break;
            case 'view-upload':


                $data['upload'] = Upload::where('upload_id','=',$id)->first();
                dd($data['upload']);
                $view = 'admin.uploads.view';

                break;

            
            
            
                case 'technicians':

               
                $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
               ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                ->where('users.user_role_id','=',3)
              ->orderBy('users.id','desc')
                ->paginate(10);
            
                //  $data['asps'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                //  ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                // ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                // ->first();
                  $data['asp'] = AspAdmin::where('asp_admin_id','=',Auth::user()->id)->first();
                 
                $view = 'admin.technicians.list';
                break;

            
                case 'new-technician':

                if($id!=''){
                    $data['centres'] = WareHouse::get();
                    $data['roles'] = Roles::get();
                   
                        $data['admin']= DB::table('users')
					  ->leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
					  ->leftjoin('asp_list','asp_list.code','=','asp_tech.warehouse_code')
                        ->where('id' ,$id)
                        ->first();
                    $data['centres'] = WareHouse::get();

                    //$data['attachments'] = Upload::where('upload_id','=',$id)->get();
                    //$data['service_types'] = ServiceType::get();
                    if(empty($data['admin'])){
                        return Redirect::to(URL::route('Technicians'));
                    }
                    $view = 'admin.technicians.edit';
                }else{
                    $data['centres'] = WareHouse::get();
                    $data['roles'] = Roles::get();
                    $view = 'admin.technicians.edit';
                }

                break;
                case 'new-technician_tss':

               
                    $data['centres'] = DB::table('asp_list')->get();
                    $data['roles'] = Roles::get();
                    $data['admin']= DB::table('users')
					  ->leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
					  ->leftjoin('asp_list','asp_list.code','=','asp_tech.warehouse_code')
                        ->where('id' ,$id)
                        ->first();
              
                   
                    $view = 'admin.asp_admin.tech_edit';
            

                break;

            case 'asp_admin':

            $data['warehouse'] = DB::table('asp_list')->get();
            $data['roles'] = Roles::whereIn('user_role_id', [ 2, 4])->get();

                $data['admins']= User::leftjoin('asp_admin','users.id','=','asp_admin.asp_admin_id')
                ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                
                ->where('user_role_id',2)
                 ->orderBy('users.id', 'desc')
                 ->paginate(15);
          
                
                    $data['admin']= User::leftjoin('asp_admin','users.id','=','asp_admin.asp_admin_id')
                        ->leftjoin('asp_list','asp_list.code','=','asp_admin.warehouse_code')
                        ->leftjoin('user_role','user_role.user_role_id','=','users.user_role_id')
                        ->where('users.id','=',$id)
                        ->first();
                        
                $view = 'admin.asp_admin.list';
                break;
                case 'asp_tech':

                $data['warehouse'] = DB::table('asp_list')->get();

                $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
               //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                ->where('users.user_role_id','=',3)
                ->orderBy('users.id','desc')
              
                ->paginate(15);
         
               $view = 'admin.asp_admin.tech_list';
                break;
             case 'warehouses':

             $data['admins']= Warehouse::orderBy('warehouse_id','desc')->get();

             $view = 'admin.warehouse.list';
             break;


             case 'view-warehouse':

             $data['admin']= Warehouse::where('warehouse_id','=',$id)
                        ->first();
                       

             $view = 'admin.warehouse.view';
             break;


             case 'new-warehouse':

                if($id!=''){
                   
                   
                
                    $data['admin']= Warehouse::where('warehouse_id','=',$id)
                        ->first();
                    //$data['attachments'] = Upload::where('upload_id','=',$id)->get();
                    //$data['service_types'] = ServiceType::get();
                    if(empty($data['admin'])){
                        return Redirect::to(URL::route('AspAdmin'));
                    }
                    $view = 'admin.warehouse.edit';
                }else{

                   

                    $view = 'admin.warehouse.edit';
                }

                break;
            case 'new-asp_admin':

                if($id!=''){
                   
                    $data['centres'] = WareHouse::get();
                    $data['roles'] = Roles::whereIn('user_role_id', [ 2, 4])->get();
                
                    $data['admin']= User::leftjoin('asp_admin','users.id','=','asp_admin.asp_admin_id')
                        ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                        ->leftjoin('user_role','user_role.user_role_id','=','users.user_role_id')
                        ->where('users.id','=',$id)
                        ->first();
                    //$data['attachments'] = Upload::where('upload_id','=',$id)->get();
                    //$data['service_types'] = ServiceType::get();
                    if(empty($data['admin'])){
                        return Redirect::to(URL::route('AspAdmin'));
                    }
                    $view = 'admin.asp_admin.edit';
                }else{

                    $data['centres'] = WareHouse::get();
                    $data['roles'] = Roles::whereIn('user_role_id', [ 2, 4])->get();

                    $view = 'admin.asp_admin.edit';
                }

                break;
            case 'view-asp_admin':
                $data['admin']= User::leftjoin('asp_admin','users.id','=','asp_admin.asp_admin_id')
                    ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                    ->leftjoin('user_role','user_role.user_role_id','=','users.user_role_id')
                    ->where('users.id','=',$id)
                    ->first();
                $view = 'admin.asp_admin.view';
                break;

        case 'jobs':
            $data['faultys'] = DB::table('faultylist')->get();
            $data['status'] = DB::table('job_status')->where('complete_status','=',0)->get();   
            $data['warehouses'] = DB::table('asp_list')->get();
            $data['warehouse'] = DB::table('asp_list')->get();
            $data['symptoms'] = DB::table('symptoms')->get();
            $data['parts_list'] = Parts::get();
            $data['products'] = DB::table('products')->get();
            $data['techs'] = User::leftjoin('jobs','jobs.technician','=','users.id')
                ->where('users.user_role_id','=',3)
                ->get();
            $data['uss'] = DB::table('users')
					  ->leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
					  ->leftjoin('asp_list','asp_list.code','=','asp_tech.warehouse_code')  
					  ->where('users.user_role_id','=',3)
					  ->get();
           
            $data['resolutions'] = DB::table('resolutions')->get();
            //$data['techs'] = User::where('users.user_role_id','=',3)   ->get();
            $data['milaeges'] = Mileage::get();
        
            $data['jobs'] = DB::table('jobs')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
                ->leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                ->select( 'jobs.*','jobs.remark as job_remark','claim.job_id as claimjob_id','jobs.created_at as job_create','claim.created_at as claim_create','jobs.technician as ass_tech','parts_order.delivery_date as part_del','product_repalcement_order.delivery_date as prod_del','parts_order.remark as part_remark','grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as gma_ex','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel','claim.isapprove as claim_approve','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','parts_order.*','asp_list.*','asp_admin.*','users.*','appointment.appointment_time','appointment.appointment_id','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','product_repalcement_order.*','grn.*','gma.*')
			    ->orderBy('jobs.job_date', 'desc')
			    //->tosql();
			    //count();
                ->paginate(15);
            
            $data['appoints'] = Appointment::join('jobs','jobs.job_id','=','appointment.job_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->orderBy('jobs.job_date', 'desc')
                ->get();
            $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->orderBy('jobs.job_date', 'desc')
                ->get();
            $data['apps'] = Claim::leftjoin('jobs','jobs.job_id','=','claim.job_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->get();
             
            $view = 'admin.jobs.list';
        break;
        case 'all_jobs':
            $data['jobs'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('asp_admin','asp_admin.asp_warehouse_id','=','jobs.asp_location') 
                ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->orderBy('jobs.job_date', 'desc')->get();
            $view = 'admin.jobs.all';
        break;
        case 'asp_jobs': 
            $data['status'] = DB::table('job_status')->where('complete_status','!=',2)->get();  
            $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                ->where('users.user_role_id','=',3)
                ->get();
            $data['warehouse'] = DB::table('asp_list')->get();
            $data['milaeges'] = Mileage::get();
        //         $data['jobs'] = Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
        //    //->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
        //         ->leftjoin('asp_list','asp_admin.warehouse_code','=','asp_list.code')
        //         ->leftjoin('users','users.id','=','asp_admin.technician')

        //       ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
        //         ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
        //       ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
        //         ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
        //         ->leftjoin('job_status','job_status.status_id','=','jobs.status')
        //         // ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
        //         // ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
        //          ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                
        //         ->orderBy('jobs.job_date', 'desc')
        //         ->get();    
            $data['faultys'] = Faulty::get();
            $data['products'] = DB::table('products')->get();
            $data['symptoms'] = Symptom::get();
            $data['resolutions'] = Resolutions::get();
            $data['parts_list'] = Parts::get();
                // $data['jobs'] = Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
                // ->leftjoin('users','users.id','=','jobs.technician')
                //    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                //      ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                //    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                 
                //      ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                //      ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                //       ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                //      ->where('jobs.status','!=',41)
                //      ->orderBy('jobs.job_date', 'desc')
                //      ->get();


            $data['jobs']= DB::table('jobs')
                ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                ->leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                ->select('appointment.job_id as appjob_id','jobs.created_at as job_create','jobs.remark as job_remark','claim.created_at as claim_create','parts_order.remark as part_remark','grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as gma_ex','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel', 'jobs.*','claim.job_id as claimjob_id','claim.isapprove as claim_approve','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','parts_order.*','asp_list.*','asp_admin.*','users.*','appointment.appointment_time','appointment.appointment_id','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','grn.*','gma.*','product_repalcement_order.*')
                ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                //->where('jobs.status','!=',41)
                ->orderBy('jobs.job_date', 'desc')
                ->paginate(15);
            $data['jo_id']=Request::segment(2);
            $data['appoints'] = Appointment::join('jobs','jobs.job_id','=','appointment.job_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                ->orderBy('jobs.job_date', 'desc')
                ->get();           
            $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                ->where('asp_admin.asp_admin_id','=',Auth::user()->id) 
                ->orderBy('jobs.job_date', 'desc')
                ->get();
            $data['apps'] = Claim::leftjoin('jobs','jobs.job_id','=','claim.job_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                ->where('asp_admin.asp_admin_id','=',Auth::user()->id)                   ->get();
            $view = 'admin.asp_jobs.list';
            break;
  
        case 'progress_jobs_asp':
            $data['jobs'] = Job::leftjoin('asp_admin','asp_admin.asp_warehouse_id','=','jobs.asp_location') 
                ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                ->where('jobs.status','!=','9')
                ->orderBy('jobs.job_date', 'desc')
                ->get();
            $view = 'admin.asp_jobs.pending';
        break;
        case 'completed_jobs_asp':
            $data['jobs']= DB::table('jobs')
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
                ->where('jobs.status','=',63)
                ->orderBy('jobs.job_date', 'desc')
                ->get();
            $view = 'admin.asp_jobs.completed';
        break;
        case 'tech_jobs':
            $data['status'] = DB::table('job_status')->where('complete_status','=',0)->get();  
            $data['faultys'] = Faulty::get();
            $data['symptoms'] = Symptom::get(); 
            $data['parts_list'] = Parts::get();
            $data['products'] = DB::table('products')->get();
            $data['milaeges'] =Mileage::get();
            $data['warehouse'] = DB::table('asp_list')->get();
            $data['resolutions'] = Resolutions::get();
            $data['jobs'] = Job::leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                ->select('appointment.job_id as appjob_id','jobs.created_at as job_create','claim.created_at as claim_create', 'jobs.*','claim.job_id as claimjob_id','parts_order.remark as part_remark','grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as gma_ex','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel','claim.isapprove as claim_approve','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','parts_order.*','users.*','appointment.appointment_time','appointment.appointment_id','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','asp_list.*','grn.*','gma.*','product_repalcement_order.*')
                ->where('jobs.technician','=',Auth::user()->id)
                ->orderBy('jobs.job_date', 'desc')
                ->paginate(15);
            $data['jo_id']=Request::segment(2);
            $data['appoints'] = Appointment::join('jobs','jobs.job_id','=','appointment.job_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->where('jobs.technician','=',Auth::user()->id)
                ->orderBy('jobs.job_date', 'desc')
                ->get();
            $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->where('jobs.technician','=',Auth::user()->id)
                ->orderBy('jobs.job_date', 'desc')
                ->get();
            $data['apps'] = Claim::leftjoin('jobs','jobs.job_id','=','claim.job_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->where('jobs.technician','=',Auth::user()->id)
                ->get();
            $view = 'admin.tech_jobs.list';
        break;
        case 'tech_jobs_compelted':
            $data['status'] = Status::get();
            $data['jobs'] = Job::leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->where('jobs.technician','=',Auth::user()->id)
                ->where('jobs.status','=',63)
                ->orderBy('jobs.job_date', 'desc')
                ->get();
            $view = 'admin.tech_jobs.completed';
        break;
        case 'tech_jobs_progress':
            $data['status'] = Status::get();
            $data['jobs'] = Job::leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->where('jobs.status','!=',9)
                ->where('jobs.technician','=',Auth::user()->id)
                ->orderBy('jobs.job_date', 'desc')
                ->get();
            $view = 'admin.tech_jobs.pending';
        break;
        case 'completed_jobs':
            $date= Carbon::now();
            $fordate = date('Y-m-d', strtotime($date));   
            $data['jobs'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
                ->leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                ->where('jobs.status','=',63)
                ->select( 'jobs.*','customers.*','faultylist.*','symptoms.*','asp_admin.*','users.*','resolutions.*','job_status.*','parts_order.*','parts_list.*','appointment.*','jobs.remark as job_remark')   
            //->where('job_date','=',$fordate)
                ->orderBy('jobs.job_date', 'desc')
                ->paginate(15);
            $data['warehouse'] = DB::table('asp_list')->get();
            $data['techs'] = User::leftjoin('asp_admin','asp_admin.asp_admin_id','=','users.id')
                ->leftjoin('jobs','jobs.asp_location','=','asp_admin.warehouse_code')
                ->where('users.user_role_id','=',3)
                //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                ->get();
            $data['status'] = Status::get();
            $view = 'admin.jobs.completed_list';
        break;   
        case 'pending_jobs':
                  $data['jobs'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                  ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                  ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                  ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                  ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                  ->where('jobs.status','!=',9)
                  ->orderBy('jobs.job_date', 'desc')
                  ->get();
                
                  
                    $view = 'admin.jobs.pending_list';
                    break;
  
            case 'new-job':

                $data['faultys'] = Faulty::get();
                $data['status'] = Status::get();
                $data['warehouse'] = DB::table('asp_list')->get();
                $data['symptoms'] = Symptom::get();

                $data['resolutions'] = Resolutions::get();

              $view = 'admin.jobs.create';

                break;

            case 'edit-job':
           
                $data['products'] = DB::table('products')->get();
                $data['warehouse'] = WareHouse::get();
				$data['parts'] = Parts::get(); 
				$data['milaeges'] =Mileage::get();
                $data['parts_list'] = Parts::get();
                $data['faultys'] = DB::table('faultylist')->get();
				$data['resolutions'] =DB::table('resolutions')->get();
				$data['symptoms'] = DB::table('symptoms')->get();
                $data['jo_id'] =Request::segment(2);
	            $data['job'] = DB::table('jobs')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                    ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
                    //->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                    ->leftjoin('users','users.id','=','jobs.technician')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                    ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                    //->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    //->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                    ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
                    ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                    ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                    ->select( 'jobs.*','products.*','claim.job_id as claimjob_id','jobs.technician as job_tech','jobs.seriel_number as job_seriel_number','claim.isapprove as claim_approv','claim.remarks as claim_remarks','parts_order.isapprove as part_appr','jobs.remark as job_remark','parts_order.remark as part_remark','parts_order.apprv_remarks as appr_remark','product_repalcement_order.delivery_date as prod_deliver','grn.amount as grn_amount','grn.credit_note as grn_credit','grn.issue_image as grn_image','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as rma_ex_number','gma.rma_remarks as rma_remarks','gma.issue_image as gma_image','gma.ex_number as gma_ex','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel','claim.isapprove as claim_approve','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','asp_list.*','asp_admin.*','users.*','appointment.appointment_time','appointment.appointment_id','appointment.time','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','product_repalcement_order.*','grn.*','gma.*','asp_admin.*','parts_order.*')
                    ->where('jobs.job_id','=',$id)
                    ->first();
                     $varj=$data['job']->asp_location;
                $data['is_proof_image']   =  $this->isImageExstesion($data['job']->attach_proof);
                $data['is_symptom_image'] =  $this->isImageExstesion($data['job']->grn_image);
                     
	            $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                    ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                   //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                    ->where('asp_tech.warehouse_code','=',$varj)
                    ->where('users.user_role_id','=',3)
                    ->get();
				$data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                    ->where('jobs.job_id','=',$id)
                    ->get();
				$data['part'] = DB::table('parts_order')
                    ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->select( 'parts_list.*','muliple_parts.parts as mul_parts','customers.*','faultylist.*','symptoms.*','resolutions.*','parts_order.*','parts_list.*','jobs.job_id','jobs.job_location','jobs.repaire_order_no')
                    ->where('jobs.job_id','=',$id)
                    ->first();
				$data['claim'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id') 
				  	->leftjoin('data_mileage','data_mileage.mil_id','=','claim.mileage')
                    ->where('jobs.job_id',$id)->first();
                $varj=$data['job']->asp_location;
                $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                    ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                   //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                    ->where('asp_tech.warehouse_code','=',$varj)
                    ->where('users.user_role_id','=',3)
                    ->get();
                $view = 'admin.jobs.edit';
            break;
                

            case 'tech_edit-job':
                $data['products'] = DB::table('products')->get();
                $data['warehouse'] = WareHouse::get();
                $data['parts'] = Parts::get(); 
                $data['milaeges'] =Mileage::get();
                $data['parts_list'] = Parts::get();
                $data['faultys'] = DB::table('faultylist')->get();
                $data['resolutions'] =DB::table('resolutions')->get();
                $data['symptoms'] = DB::table('symptoms')->get();
                $data['jo_id'] =Request::segment(2);
                $data['job']= DB::table('jobs')
                        ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                        ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                        ->leftjoin('users','users.id','=','jobs.technician')
                        ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                        ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                        ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                        ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                        ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                        ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
                        ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                        ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                        ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                        ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                        ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                        ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                        ->select('jobs.*','appointment.job_id as appjob_id','jobs.technician as jo_tc','jobs.seriel_number as job_seriel_number','parts_order.delivery_date as part_del','product_repalcement_order.delivery_date as prod_del','claim.remarks as claim_remarks','claim.isapprove as claim_approv','grn.issue_image as grn_image','gma.issue_image as gma_image','jobs.remark as job_remark','appointment.time','parts_order.remark as part_remark','products.*','grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as rma_ex_number','gma.rma_remarks as rma_remarks','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel', 'jobs.*','claim.job_id as claimjob_id','claim.isapprove as claim_approve','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','parts_order.*','asp_list.*','asp_admin.*','users.*','appointment.appointment_time','appointment.appointment_id','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','grn.*','gma.*','product_repalcement_order.*','parts_order.*')
                        ->where('jobs.technician','=',Auth::user()->id)
                        ->where('jobs.job_id','=',$id)
                        ->first();
                $data['is_proof_image']   =  $this->isImageExstesion($data['job']->attach_proof);
                $data['is_symptom_image'] =  $this->isImageExstesion($data['job']->grn_image);
                $varj=$data['job']->asp_location;
                $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                        ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                    //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                        ->where('asp_tech.warehouse_code','=',$varj)
                        ->where('users.user_role_id','=',3)
                    ->get();
                $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                        ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                        ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                        ->where('jobs.job_id','=',$id)
                        ->get();
                $data['part'] = DB::table('parts_order')
                        ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                        ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                        ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                        ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                        ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                        ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                        ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                        ->select( 'parts_list.*','muliple_parts.parts as mul_parts','customers.*','faultylist.*','symptoms.*','resolutions.*','parts_order.*','parts_list.*','jobs.job_id','jobs.job_location','jobs.repaire_order_no')
                        ->where('jobs.job_id','=',$id)
                        ->first();
                $data['claim'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id') 
                        ->leftjoin('data_mileage','data_mileage.mil_id','=','claim.mileage')
                        ->where('jobs.job_id',$id)->first();
                $view = 'admin.assign_technician.tech_job_edit';
            break;
   

        case 'view-asp_job':
            $data['products'] = DB::table('products')->get();
            $data['warehouse'] = WareHouse::get();
            $data['parts'] = Parts::get(); 
            $data['milaeges'] =Mileage::get();
            $data['parts_list'] = Parts::get();
            $data['faultys'] = Faulty::get();
            $data['symptoms'] = Symptom::get();
            $data['resolutions'] = Resolutions::get();
            $data['jo_id'] =Request::segment(2);
	        $data['job'] = DB::table('jobs')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
                //->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                ->leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                //->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                //->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
			    ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
                ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                ->select( 'jobs.*','products.*','jobs.created_at as job_create','jobs.seriel_number as job_seriel_number','claim.remarks as claim_remarks','claim.created_at as claim_create','appointment.time','jobs.remark as job_remark','claim.isapprove as claim_approve','parts_order.delivery_date as part_del','product_repalcement_order.delivery_date as prod_del','claim.job_id as claimjob_id', 'grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','grn.issue_image as grn_image','gma.issue_image as gma_image','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as rma_ex_number','gma.rma_remarks as rma_remarks','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','asp_list.*','asp_admin.*','users.*','appointment.appointment_time','appointment.appointment_id','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','product_repalcement_order.*','grn.*','gma.*','asp_admin.*','parts_order.*')
				->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                ->where('jobs.job_id','=',$id)
                ->first();
            $data['is_proof_image']   =  $this->isImageExstesion($data['job']->attach_proof);
            $data['is_symptom_image'] =  $this->isImageExstesion($data['job']->grn_image);		
			$varj=$data['job']->asp_location;
	        $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                ->where('asp_tech.warehouse_code','=',$varj)
                ->where('users.user_role_id','=',3)
                ->get();
				
			$data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->where('jobs.job_id','=',$id)
                ->get();
			$data['part'] = DB::table('parts_order')
                ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->select( 'parts_list.*','muliple_parts.parts as mul_parts','customers.*','faultylist.*','symptoms.*','resolutions.*','parts_order.*','parts_list.*','jobs.job_id','jobs.job_location','jobs.repaire_order_no')
                ->where('jobs.job_id','=',$id)
                ->first();
			$data['claim'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id') 
				->leftjoin('data_mileage','data_mileage.mil_id','=','claim.mileage')
                ->where('jobs.job_id',$id)->first();
            $view = 'admin.asp_jobs.view';
        break;

        case 'asp_edit-job':
            $data['products'] = DB::table('products')->get();
            $data['warehouse'] = WareHouse::get();
			$data['parts'] = Parts::get(); 
			$data['milaeges'] =Mileage::get();
            $data['parts_list'] = Parts::get();
            $data['faultys'] = DB::table('faultylist')->get();
			$data['resolutions'] =DB::table('resolutions')->get();
		    $data['symptoms'] = DB::table('symptoms')->get();
            $data['jo_id'] =Request::segment(2);
	        $data['job']= DB::table('jobs')
                    ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                    ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                    ->leftjoin('users','users.id','=','jobs.technician')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                    ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
			  		->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
                    ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                    ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                    ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                    ->select('jobs.*','appointment.job_id as appjob_id','jobs.technician as jo_tc','jobs.seriel_number as job_seriel_number','parts_order.delivery_date as part_del','product_repalcement_order.delivery_date as prod_del','claim.remarks as claim_remarks','claim.isapprove as claim_approv','grn.issue_image as grn_image','gma.issue_image as gma_image','jobs.remark as job_remark','appointment.time','parts_order.remark as part_remark','products.*','grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as rma_ex_number','gma.rma_remarks as rma_remarks','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel', 'jobs.*','claim.job_id as claimjob_id','claim.isapprove as claim_approve','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','parts_order.*','asp_list.*','asp_admin.*','users.*','appointment.appointment_time','appointment.appointment_id','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','grn.*','gma.*','product_repalcement_order.*','parts_order.*')
                    ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
					->where('jobs.job_id','=',$id)
                    ->first();
            $data['is_proof_image']   =  $this->isImageExstesion($data['job']->attach_proof);
            $data['is_symptom_image'] =  $this->isImageExstesion($data['job']->grn_image);
			$varj=$data['job']->asp_location;
	        $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                    ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                   //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                    ->where('asp_tech.warehouse_code','=',$varj)
                    ->where('users.user_role_id','=',3)
                   ->get();
			$data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                    ->where('jobs.job_id','=',$id)
                    ->get();
			$data['part'] = DB::table('parts_order')
                    ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->select( 'parts_list.*','muliple_parts.parts as mul_parts','customers.*','faultylist.*','symptoms.*','resolutions.*','parts_order.*','parts_list.*','jobs.job_id','jobs.job_location','jobs.repaire_order_no')
                    ->where('jobs.job_id','=',$id)
                    ->first();
			$data['claim'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id') 
				  	->leftjoin('data_mileage','data_mileage.mil_id','=','claim.mileage')
                    ->where('jobs.job_id',$id)->first();
            $view = 'admin.asp_jobs.asp_job_edit';
        break;

    case 'view-job':

                $data['products'] = DB::table('products')->get();
                $data['warehouse'] = WareHouse::get();
				$data['parts'] = Parts::get(); 
				$data['milaeges'] =Mileage::get();
                $data['parts_list'] = Parts::get();
                $data['faultys'] = Faulty::get();
                $data['symptoms'] = Symptom::get();
                $data['resolutions'] = Resolutions::get();
                $data['jo_id'] =Request::segment(2); 
	            $data['job'] = DB::table('jobs')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                    ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
                    //->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                    ->leftjoin('users','users.id','=','jobs.technician')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                    ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                    //->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    //->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                    ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
                    ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                    ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                    ->select( 'jobs.*','products.*','appointment.time','parts_order.delivery_date as part_del','claim.remarks as claim_remarks','jobs.seriel_number as job_seriel_number','jobs.created_at as job_create','claim.created_at as claim_create','product_repalcement_order.delivery_date as prod_del','jobs.remark as job_remark','grn.issue_image as grn_image','gma.issue_image as gma_image','claim.job_id as claimjob_id', 'grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as rma_ex_number','gma.rma_remarks as rma_remarks','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel','claim.isapprove as claim_approve','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','asp_list.*','asp_admin.*','users.*','appointment.appointment_time','appointment.appointment_id','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','product_repalcement_order.*','grn.*','gma.*','asp_admin.*','parts_order.*')
                    ->where('jobs.job_id','=',$id)
                    ->first();
                $data['is_proof_image']   =  $this->isImageExstesion($data['job']->attach_proof);
                $data['is_symptom_image'] =  $this->isImageExstesion($data['job']->grn_image);    
			
				$varj=$data['job']->asp_location;
	            $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                    ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                   //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                    ->where('asp_tech.warehouse_code','=',$varj)
                    ->where('users.user_role_id','=',3)
                    ->get();
				$data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                    ->where('jobs.job_id','=',$id)
                    ->get();
				$data['part'] = DB::table('parts_order')
                    ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->select( 'parts_list.*','muliple_parts.parts as mul_parts','customers.*','faultylist.*','symptoms.*','resolutions.*','parts_order.*','parts_list.*','jobs.job_id','jobs.job_location','jobs.repaire_order_no')
                    ->where('jobs.job_id','=',$id)
                    ->first();
				
				$data['claim'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id') 
				  	->leftjoin('data_mileage','data_mileage.mil_id','=','claim.mileage')
                    ->where('jobs.job_id',$id)->first();
                $view = 'admin.jobs.view';
            break;

            case 'view-tech_job':

                $data['products'] = DB::table('products')->get();
                $data['warehouse'] = WareHouse::get();
                $data['parts'] = Parts::get(); 
                $data['milaeges'] =Mileage::get();
                $data['parts_list'] = Parts::get();
                $data['faultys'] = Faulty::get();
                $data['symptoms'] = Symptom::get();
                $data['resolutions'] = Resolutions::get();
                $data['jo_id'] =Request::segment(2);
                $data['job'] = DB::table('jobs')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                    ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
                    //->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                    ->leftjoin('users','users.id','=','jobs.technician')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                    ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                    //->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    //->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                    ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
                    ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                    ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                    ->select( 'jobs.*','products.*','jobs.created_at as job_create','jobs.seriel_number as job_seriel_number','claim.remarks as claim_remarks','claim.created_at as claim_create','appointment.time','jobs.remark as job_remark','claim.isapprove as claim_approve','parts_order.delivery_date as part_del','product_repalcement_order.delivery_date as prod_del','claim.job_id as claimjob_id', 'grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','grn.issue_image as grn_image','gma.issue_image as gma_image','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as rma_ex_number','gma.rma_remarks as rma_remarks','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','asp_list.*','asp_admin.*','users.*','appointment.appointment_time','appointment.appointment_id','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','product_repalcement_order.*','grn.*','gma.*','asp_admin.*','parts_order.*')
                    ->where('jobs.technician','=',Auth::user()->id)
                    ->where('jobs.job_id','=',$id)
                    ->first();
                $data['is_proof_image']   =  $this->isImageExstesion($data['job']->attach_proof);
                $data['is_symptom_image'] =  $this->isImageExstesion($data['job']->grn_image);		
                $varj=$data['job']->asp_location;
                $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                    ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                    //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                    ->where('asp_tech.warehouse_code','=',$varj)
                    ->where('users.user_role_id','=',3)
                    ->get();
                    
                $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                    ->where('jobs.job_id','=',$id)
                    ->get();
                $data['part'] = DB::table('parts_order')
                    ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->select( 'parts_list.*','muliple_parts.parts as mul_parts','customers.*','faultylist.*','symptoms.*','resolutions.*','parts_order.*','parts_list.*','jobs.job_id','jobs.job_location','jobs.repaire_order_no')
                    ->where('jobs.job_id','=',$id)
                    ->first();
                $data['claim'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id') 
                    ->leftjoin('data_mileage','data_mileage.mil_id','=','claim.mileage')
                    ->where('jobs.job_id',$id)->first();
                $view = 'admin.assign_technician.view';
            break;

            case 'new-csv':

                    $view = 'admin.csvfiles.csv';
                    break;

            case 'csvfiles':

                $view = 'admin.csvfiles.lists';
                break;

            case 'view-csvfiles':

                $data['csdaas'] = DB::table('csvdata')->get();

                $view = 'admin.csvfiles.view';
                break;

            case 'edit-csvfiles':

                $data['csvs'] = DB::table('csvdata')->where('id',$id)->first();

                $view = 'admin.csvfiles.edit';
                break;
                case 'edit_file_share':

                $data['users']= User::leftjoin('asp_admin','users.id','=','asp_admin.asp_admin_id')
                ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
              ->where('users.user_role_id','=',2)
                ->get();                
                $data['file'] = Files::leftjoin('asp_admin','asp_admin.asp_admin_id','=','files.permission')
              ->leftjoin('asp_list','asp_list.code','=','asp_admin.warehouse_code')->where('file_id',$id)->first();

                $view = 'admin.fileshare.edit';
                break;
            case 'assign_job':

                $view = 'admin.assign.lists';
                break;


                case 'unassigned_jobs':

                $data['jobs'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('asp_admin','asp_admin.asp_warehouse_id','=','jobs.asp_location') 
                ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->where('jobs.asp_location','=',NULL)
                ->orderBy('jobs.job_date', 'desc')
                ->get();
               
                
                $view = 'admin.assign.unassigned';
                break;

                
            case 'create-assign_job':

            $data['job'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
            ->leftjoin('job_status','job_status.status_id','=','jobs.status')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            ->where('jobs.job_id',$id)
            ->first();

                $data['warehouses'] = WareHouse::get();


                $view = 'admin.assign.create';
                break;

            case 'edit-assign_job':

                $data['csvs'] = DB::table('csvdata')->where('id',$id)->first();

                $view = 'admin.assign.edit';
                break;


                case 'assigned_jobs':
                $data['jobs'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('asp_admin','asp_admin.asp_warehouse_id','=','jobs.asp_location') 
                ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->where('jobs.asp_location','!=',NULL)
                ->orderBy('jobs.job_date', 'desc')
                ->get();
               
                // $data['jobs'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                // ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                // ->leftjoin('asp_admin','asp_admin.asp_warehouse_id','=','jobs.asp_location') 
                // ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
                // ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                // ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                // ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                // ->where('jobs.asp_location','!=',NULL)
                // ->orderBy('jobs.job_id','desc')
               
                // ->get();
                
                
                $view = 'admin.assign.lists';
                break;

            case 'create-assign_tech_job':

            $data['job'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
            ->leftjoin('job_status','job_status.status_id','=','jobs.status')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            ->where('jobs.job_id',$id)
            ->first();
         

                $data['warehouses'] = User::where('user_role_id','=',3)->get();




                $view = 'admin.assign_technician.create';
                break;

            case 'edit-assign_job':

                $data['csvs'] = DB::table('csvdata')->where('id',$id)->first();

                $view = 'admin.assign.edit';
                break;

                case 'unassigned_jobs_tech':

                $data['jobs'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('asp_admin','asp_admin.asp_warehouse_id','=','jobs.asp_location') 
                ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->where('jobs.technician','=',NULL)
                ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                ->orderBy('jobs.job_date', 'desc')
                ->get();
                
                $view = 'admin.assign_technician.unassigned';
                break;

                case 'assigned_jobs_tech':
              
                $data['jobs'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('asp_admin','asp_admin.asp_warehouse_id','=','jobs.asp_location') 
                ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->where('jobs.technician','!=',NULL)
                ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                ->orderBy('jobs.job_date', 'desc')
                ->get();
                
                $view = 'admin.assign_technician.assigned';
                break;

                case 'appointment':

                 $data['jobss'] = Job::get();
                 $data['status'] = Status::get();

                 $data['apps'] = Job::leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')

                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                //->where('jobs.technician','=',Auth::user()->id)
                ->where('jobs.job_id','=',$id)
          
                ->first();
               
             $data['joid']=Request::segment(2);

                $data['job'] = Job::leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                //->where('jobs.technician','=',Auth::user()->id)
                ->where('jobs.job_id','=',$id)
    
                ->orderBy('jobs.job_date', 'desc')->first();
               
               
                $view = 'admin.tech_jobs.appointment';
                break;




                case 'asp-appointment':
                $data['jobss'] = Job::get();
                $data['status'] = Status::get();

                $data['apps'] = Job::leftjoin('users','users.id','=','jobs.technician')
               ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
               ->leftjoin('job_status','job_status.status_id','=','jobs.status')

               ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
               ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
               ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
               //->where('jobs.technician','=',Auth::user()->id)
               ->where('jobs.job_id','=',$id)
         
               ->first();
              
            $data['joid']=Request::segment(2);

               $data['job'] = Job::leftjoin('users','users.id','=','jobs.technician')
               ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
               ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
               ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
               ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               //->where('jobs.technician','=',Auth::user()->id)
               ->where('jobs.job_id','=',$id)
   
               ->orderBy('jobs.job_date', 'desc')->first();
              
              
               $view = 'admin.asp_jobs.appointment';
                break;




                case 'admin-appointment':

                $data['jobss'] = Job::get();
                $data['status'] = Status::get();

            //     $data['apps'] = Appointment::leftjoin('jobs','appointment.job_id','=','jobs.job_id')
            //    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
            //    ->leftjoin('job_status','job_status.status_id','=','jobs.status')
            //    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            //    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            //    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            //    ->where('jobs.job_id','=',$id)
         
            //    ->first();
       
               $data['apps'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
               ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
               ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
               ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
               ->where('jobs.job_id','=',$id)
               ->first();

               
            $data['joid']=Request::segment(2);

               $data['job'] = Job::leftjoin('users','users.id','=','jobs.technician')
               ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
               ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
               ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
               ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               ->leftjoin('job_status','job_status.status_id','=','jobs.status')

               //->where('jobs.technician','=',Auth::user()->id)
               ->where('jobs.job_id','=',$id)
   
               ->orderBy('jobs.job_date', 'desc')->first();
              
              
               $view = 'admin.admin_claims.appointment';
                break;


                case 'appointments':

                $data['jobss'] = Job::get();
  
                  $data['jobs'] = Appointment::join('jobs','jobs.job_id','=','appointment.job_id')
                  ->where('jobs.technician','=',Auth::user()->id)
                  ->orderBy('jobs.job_date', 'desc')
                ->paginate(10);
                
                 
                  $view = 'admin.tech_jobs.appointments';
                  break;
                        case 'asp_appointments':
                        $data['jobs'] = DB::table('appointment')->leftjoin('jobs','jobs.job_id','=','appointment.job_id')
                       ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
                       //->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id')
                      ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                        ->orderBy('jobs.job_date', 'desc')
                        ->paginate();


                        $view = 'admin.asp_jobs.appoinments';
                        break;

                        case 'tss_appointments':
                        $data['jobs'] = Appointment::join('jobs','jobs.job_id','=','appointment.job_id')
                        ->leftjoin('asp_admin','asp_admin.asp_warehouse_id','=','jobs.asp_location') 
                         ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id')
                        //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                        ->orderBy('jobs.job_date', 'desc')
                        ->paginate(10);


                        $view = 'admin.jobs.appoinments';
                        break;
                  case 'edit_appointment':

                  $data['job'] = Job::leftjoin('users','users.id','=','jobs.technician')
                  ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                  ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                  ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                  ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                  ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                  ->where('appointment.appointment_id','=',$id)
                  ->first();
               
                  $view = 'admin.tech_jobs.edit-appointment';
                  break;
                  case 'view_appointment':

                  $data['job'] = Job::leftjoin('users','users.id','=','jobs.technician')
                  ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                  ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                  ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                  ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                  ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                  ->leftjoin('job_status','job_status.status_id','=','jobs.status')

                  ->where('appointment.appointment_id','=',$id)
                  ->first();
               
                  $view = 'admin.tech_jobs.view-appointment';
                  break;

                case 'waiting_parts':

                $data['alljobs'] = Job::get();
                $data['faultys'] = Faulty::get();

                $data['symptoms'] = Symptom::get(); 
                $data['parts'] = Parts::get();

                $data['resolutions'] = Resolutions::get();

                $data['job'] = Job::leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')

                ->where('jobs.technician','=',Auth::user()->id)
                ->where('jobs.job_id','=',$id)
                ->orderBy('jobs.job_date', 'desc')->first();

                $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->where('jobs.job_id','=',$id)
                ->get();

                $view = 'admin.tech_jobs.parts';
                break;



                case 'parts_order':
                $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->orderBy('jobs.job_date', 'desc')
                ->get();
                
                $view = 'admin.parts.list';
                break;
                case 'view-parts_order':

                $data['job'] = PartsOrder::leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('part_order_notes','part_order_notes.part_order','=','parts_order.part_order_id')

                ->where('part_order_id','=',$id)
                ->first();

                $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->where('parts_order.part_order_id','=',$id)
                ->get();

                $view = 'admin.parts.view';
                
                break;
               case 'view-spare-part-log':

               $data['job'] = PartsOrder::leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
               ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
               ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
               ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
               ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
               ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
               ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               ->leftjoin('part_order_notes','part_order_notes.part_order','=','parts_order.part_order_id')

               ->where('part_order_id','=',$id)
               ->first();

               $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
               ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
               ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
               ->where('parts_order.part_order_id','=',$id)
               ->get();
  
                $view = 'admin.logistic.part_view';
               break;
                case 'new-parts_order';

                $data['parts'] = DB::table('parts_order')->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
              
               ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
               ->leftjoin('asp_admin','asp_admin.warehouse_code','=','parts_order.location') 
                ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
               ->leftjoin('part_order_notes','part_order_notes.part_order','=','parts_order.part_order_id')
                ->where('type','with_job')
                ->orderBy('jobs.job_date', 'desc')
            
                ->paginate(15);
         
                $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->where('jobs.job_id','=',$id)
                ->get();

                $view = 'admin.parts.new';
                break;
                case 'parts_wo_job_tss';

                $data['parts'] = DB::table('parts_order')->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                
                
                ->leftjoin('asp_admin','asp_admin.warehouse_code','=','parts_order.location') 
                ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
                ->where('type','=','with_out_job')
                ->orderBy('parts_order.part_order_id', 'desc')
            
                ->paginate(10);
             
                $view = 'admin.parts.wo_job';
                break;

                case 'approved-req';
                
                $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')

                ->where('isapprove','=',1)
                ->orderBy('jobs.job_date', 'desc')
                ->get();
  
                $view = 'admin.parts.approved';
                break;
                
                case 'rejected-req';
                
                $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                
                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')

                ->where('isapprove','=',0)
                ->orderBy('jobs.job_date', 'desc')
                ->get();
                
                $view = 'admin.parts.reject';
                break;
                case 'edit-parts_order':
              
                $data['faultys'] = Faulty::get();

                $data['symptoms'] = Symptom::get(); 
                $data['resolutions'] = Resolutions::get();
                $data['parts'] = Parts::get(); 
                $data['job'] = DB::table('parts_order')
                ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')

                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')

                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->select( 'parts_list.*','muliple_parts.parts as mul_parts','customers.*','faultylist.*','symptoms.*','resolutions.*','parts_order.*','parts_list.*','jobs.job_id','jobs.job_location','jobs.repaire_order_no')

                ->where('jobs.job_id','=',$id)
                ->first();
     

                $data['mparts']=MultipleParts::leftjoin('parts_order','muliple_parts.order_id','=','parts_order.part_order_id')
                                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                                ->where('jobs.job_id','=',$id)
                                ->get();
                              
                $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->where('jobs.job_id','=',$id)
                ->get();
              




                $view = 'admin.parts.edit';
                break;
                case 'edit-parts_order_wo_job':
              
                $data['faultys'] = Faulty::get();

                $data['symptoms'] = Symptom::get(); 
                $data['resolutions'] = Resolutions::get();
                $data['parts'] = Parts::get();
                $data['job'] = PartsOrder::leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
              
              
                ->where('part_order_id','=',$id)
                ->first();
               
                $data['mul_parts']=MultipleParts::leftjoin('parts_order','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')

                ->where('part_order_id','=',$id)
                ->get();
        
                $view = 'admin.parts.wo_job_edit';
                break;

                case 'edit-parts_asp':

                $data['faultys'] = Faulty::get();
                $data['parts'] = Parts::get();
                $data['symptoms'] = Symptom::get(); 
                $data['resolutions'] = Resolutions::get();

                $data['job'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               
                ->where('part_order_id','=',$id)
                ->first();
                $view = 'admin.asp_parts.edit';
                break;

             case 'log_parts_order':

             $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
             ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
             ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
             ->leftjoin('users','users.id','=','asp_admin.asp_admin_id')
             ->leftjoin('job_status','job_status.status_id','=','jobs.status')
             ->leftjoin('asp_list','asp_list.code','=','parts_order.location')

             ->where('isapprove','=',1)
             ->orderBy('jobs.job_date', 'desc')
             ->get();
           
             $view = 'admin.logistic.list';
             break;

             case 'log_rma_order':
             $data['gma'] = DB::table('product_repalcement_order')
			 ->join('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
             ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
             ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
             ->leftjoin('asp_list','asp_list.code','=','product_repalcement_order.location')

             //->join('symptoms','symptoms.symptom_id','=','jobs.symptom')
            // ->leftjoin('job_status','job_status.status_id','=','jobs.status')

             ->where('product_repalcement_order.delivery_date','!=',NULL)
            ->orderBy('jobs.job_date', 'desc')
             ->get();
			
             $view = 'admin.logistic.rma';
             break;

             case 'log_grn_order':
             $data['gma'] = DB::table('product_repalcement_order')
             ->join('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
          ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
          //->join('symptoms','symptoms.symptom_id','=','jobs.symptom')
          ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
          ->leftjoin('asp_list','asp_list.code','=','product_repalcement_order.location')
             ->where('product_repalcement_order.delivery_date','!=',NULL)
          ->orderBy('jobs.job_date', 'desc')
        
          ->get();

             $view = 'admin.logistic.grn';
             break;







             case 'tech-parts_order';
             $data['parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
              
             ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
             ->leftjoin('asp_admin','asp_admin.warehouse_code','=','parts_order.location') 
             ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
             //->leftjoin('part_order_notes','part_order_notes.part_order','=','parts_order.part_order_id')
             ->where('jobs.technician','=',Auth::user()->id)
              ->where('type','with_job')
              ->orderBy('jobs.job_date', 'desc')
          
              ->paginate(10);
            


            //  $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
            //  ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
            //  ->where('jobs.technician','=',Auth::user()->id)
            //  ->orderBy('jobs.job_date', 'desc')
            //  ->get();
             
             $view = 'admin.tech_parts.list';
             break;
             case 'app_tech_parts';


                
             $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
             ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
             ->where('isapprove','=',1)
             ->orderBy('jobs.job_date', 'desc')
             ->get();
             
             $view = 'admin.tech_parts.appr_list';
             break;
             case 'rej_tech_parts';
             
             $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
             ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
             ->leftjoin('part_order_notes','part_order_notes.part_order','=','parts_order.part_order_id')
             ->where('part_order_notes.isapprove','=',0)
             ->orderBy('jobs.job_date', 'desc')
             ->get();
             
             $view = 'admin.tech_parts.rej_list';
             break;

             case 'asp_parts_order':


             $data['parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
              
               ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
               //->leftjoin('part_order_notes','part_order_notes.part_order','=','parts_order.part_order_id')
               ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
               ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id')
               ->where('asp_admin.asp_admin_id','=',Auth::user()->id) 
                ->where('type','with_job')
                ->orderBy('jobs.job_date', 'desc')
            
                ->paginate(10);
              
                              
                $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->where('jobs.job_id','=',$id)
                ->get();

            //  $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
            //  ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
            //  ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
            //  ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')

            //  ->leftjoin('asp_admin','asp_admin.asp_warehouse_id','=','jobs.asp_location') 
            //  ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
            //  ->where('parts_order.type','=','with_job')
            //  ->orderBy('jobs.job_date', 'desc')
            //  ->get();
            
             $view = 'admin.asp_parts.list';
             break;
             case 'view-asp_parts_order':


             $data['job'] = PartsOrder::leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
             ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
             ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
             ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
             ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
             ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
             ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
             ->leftjoin('part_order_notes','part_order_notes.part_order','=','parts_order.part_order_id')

             ->where('part_order_id','=',$id)
             ->first();

             $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
             ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
             ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
             ->where('parts_order.part_order_id','=',$id)
             ->get();

            //  $data['job'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
            //  ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
            //  ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
            //  ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
            //  ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            //  ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            //  ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            //  ->where('part_order_id','=',$id)
            //  ->first();
             
             $view = 'admin.asp_parts.view';
             break;

             case 'asp_appr_list';
                
             $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
             ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
             ->orderBy('jobs.job_id','desc')
             ->where('isapprove','=',1)
             ->get();
             
             $view = 'admin.asp_parts.appr_list';
             break;

             case 'asp_rej_list';
             
             $data['parts'] = PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
             ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
             ->leftjoin('part_order_notes','part_order_notes.part_order','=','parts_order.part_order_id')
             ->where('part_order_notes.isapprove','=',0)
             ->orderBy('jobs.job_date', 'desc')
             ->get();
             
             $view = 'admin.asp_parts.rej_list';
             break;
            case 'new-claim':

            $data['apps'] = Job::leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            ->leftjoin('claim','claim.job_id','=','jobs.job_id')
            //->where('jobs.technician','=',Auth::user()->id)
            ->where('jobs.job_id','=',$id)
            ->first();

            // $data['apps'] = Claim::leftjoin('jobs','jobs.job_id','=','claim.job_id')
            // ->where('jobs.technician','=',Auth::user()->id)
            // ->where('jobs.job_id','=',$id)
            // ->first();

         $data['jo_id']=Request::segment(2);
       
            $data['job'] = Job::where('job_id',$id)->first();

            $view = 'admin.claims.create';
            break;

            case 'claims':
             
            $data['claims'] = Claim::leftjoin('jobs','jobs.job_id','=','claim.job_id')
            ->where('jobs.technician','=',Auth::user()->id)
            ->orderBy('jobs.job_date', 'desc')
            ->paginate(10);
        
            $view = 'admin.claims.list';
            break;
            case 'edit-claim':

            $view = 'admin.claims.edit';
            break;


            case 'admin_claims':
             
            $data['claims'] = Claim::leftjoin('jobs','jobs.job_id','=','claim.job_id')
            
            ->orderBy('jobs.job_date', 'desc')
            ->paginate(15);
           
            $view = 'admin.admin_claims.list';
            break;

            case 'admin_edit_claim':

            $data['job'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id') 
            //->leftjoin('data_mileage','data_mileage.mil_id','=','claim.mileage')
          ->where('jobs.job_id',$id)->first();
       
          $data['milaeges'] =Mileage::get();
           
          $data['jo_id']=Request::segment(2);
            $view = 'admin.admin_claims.edit';
            break;

            case 'admin_appr_claims':
             
            $data['claims'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id')
            ->where('isapprove','=',1)
            ->orderBy('jobs.job_date', 'desc')
            ->get();
            $view = 'admin.admin_claims.appr_list';
            break;
            case 'admin_rej_claims':
             
            $data['claims'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id')
            ->where('isapprove','=',0)
            ->orderBy('jobs.job_date', 'desc')
            ->get();
            $view = 'admin.admin_claims.rej_list';

            break;

          case 'appr_claims':
             
            $data['claims'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id')
            ->where('isapprove','=',1)
            ->get();
            $view = 'admin.claims.approved_claims';
            break;
            case 'rej_claims':
             
            $data['claims'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id')
            ->where('isapprove','=',0)
            ->orderBy('jobs.job_date', 'desc')
            ->get();
            $view = 'admin.claims.rej_claims';
            
            break;

            case 'view-parts_tech':

            $data['job'] = PartsOrder::leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
            ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
            ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
            ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            ->leftjoin('part_order_notes','part_order_notes.part_order','=','parts_order.part_order_id')

            ->where('part_order_id','=',$id)
            ->first();

            $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
            ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
            ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
            ->where('parts_order.part_order_id','=',$id)
            ->get();
            
            $view = 'admin.parts.tech_view';
            break;
            case 'edit_claim':

            $data['job'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id')
          ->where('claim_id',$id)
            ->first();
          
            $view = 'admin.claims.edit';
            break;

            case 'asp_partsedit':
            $data['faultys'] = Faulty::get();

            $data['symptoms'] = Symptom::get(); 
            $data['parts'] = Parts::get();

            $data['resolutions'] = Resolutions::get();

            $data['job'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
            ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
            ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')


            ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                     ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
            ->where('jobs.job_id','=',$id)
            ->orderBy('jobs.job_date', 'desc')->first();

            $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
            ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
            ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
            ->where('jobs.job_id','=',$id)
            ->get();

            $view = 'admin.asp_jobs.edit_parts';

            break;

            case 'admin-waiting_parts':
            $data['faultys'] = Faulty::get();

            $data['symptoms'] = Symptom::get(); 
            $data['parts'] = Parts::get();

            $data['resolutions'] = Resolutions::get();

            $data['job'] = Job::leftjoin('customers','customers.cu_id','=','jobs.customer_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
            ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')

            ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                    
            ->where('jobs.job_id','=',$id)
            ->orderBy('jobs.job_date', 'desc')->first();

            $view = 'admin.parts.admin_parts';

            break;




          case 'asp_claim_edit':
         $data['jo_id'] = Request::segment(2);
          $data['apps'] = Job::leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
          ->leftjoin('claim','claim.job_id','=','jobs.job_id')
          ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
          ->where('asp_admin.asp_admin_id','=',Auth::user()->id)         
           ->where('jobs.job_id','=',$id)
          ->first();

            $view = 'admin.asp_jobs.edit_claim';
          break;
         
          case 'admin-new_claim':
          $data['jo_id'] = Request::segment(2);
           $data['apps'] = Job::leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
           ->leftjoin('claim','claim.job_id','=','jobs.job_id')
           ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                
            ->where('jobs.job_id','=',$id)
           ->first();
 
             $view = 'admin.admin_claims.edit_claim';
           break;

          case 'rma_requests';

        //   $data['rma'] = DB::table('product_repalcement_order')
        //   ->join('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
        //   ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
        //   ->join('symptoms','symptoms.symptom_id','=','jobs.symptom')
        //  ->orderBy('jobs.job_date', 'desc')
        //   ->get();

          $data['rma'] = DB::table('product_repalcement_order')
          ->join('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
          ->join('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
          ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
          ->where('product_repalcement_order.is_approve','!=',1)
          
        //   ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
        //   ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
          ->orderBy('jobs.job_date', 'desc')
          ->paginate(15);
          $view = 'admin.rma.list';
          break;

            case 'edit-rma':
            $data['products'] = DB::table('products')->get();
            $data['job'] = DB::table('product_repalcement_order')->join('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
            ->join('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
            ->leftjoin('job_status','job_status.status_id','=','jobs.status')

            ->where('gma_id','=',$id)
            ->first();
        
            $view = 'admin.rma.edit';
          break;

          case 'gma_requests';

          $data['gma'] = DB::table('product_repalcement_order')
          ->join('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
          ->join('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
          ->where('product_repalcement_order.is_approve','!=',1)
          
         ->orderBy('jobs.job_date', 'desc')
          ->paginate(15);


          $view = 'admin.gma.list';
          break;

            case 'edit-gma':
          
            $data['job'] = DB::table('product_repalcement_order')->join('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
            ->join('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
            ->leftjoin('job_status','job_status.status_id','=','jobs.status')

            ->where('grn_id','=',$id)
            ->first();
        
            $data['products'] = DB::table('products')->get();
            $view = 'admin.gma.edit';
          break;
          case 'asp-edit-rma':
          $data['products'] = DB::table('products')->get();
          $data['job'] = DB::table('product_repalcement_order')->join('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
          ->join('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
          ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
          ->leftjoin('job_status','job_status.status_id','=','jobs.status')

          ->where('gma_id','=',$id)
          ->first();
     
          $view = 'admin.rma.asp_edit';
        break;

        case 'tech-edit-rma':
        $data['products'] = DB::table('products')->get();
        $data['job'] = DB::table('product_repalcement_order')->join('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
        ->join('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
        ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
        ->leftjoin('job_status','job_status.status_id','=','jobs.status')

        ->where('gma_id','=',$id)
        ->first();
   
        $view = 'admin.rma.tech_edit';
      break;
        case 'asp-edit-gma':

        $data['products'] = DB::table('products')->get();
        $data['job'] = DB::table('product_repalcement_order')->join('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
            ->join('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
            ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            ->leftjoin('job_status','job_status.status_id','=','jobs.status')

            ->where('grn_id','=',$id)
            ->first();
            
          $view = 'admin.gma.asp_edit';
        break;
        case 'tech-edit-gma':

        $data['products'] = DB::table('products')->get();
        $data['job'] = DB::table('product_repalcement_order')->join('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
            ->join('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
            ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
            ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
            ->leftjoin('job_status','job_status.status_id','=','jobs.status')

            ->where('grn_id','=',$id)
            ->first();
            
          $view = 'admin.gma.tech_edit';
        break;
         case 'create_part_wo_job':

         $data['job']=Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
             ->where('jobs.technician','=',Auth::user()->id)
             ->first();

             $data['parts'] = Parts::get();
         $view = 'admin.parts_wo_job.create';
         break;
         case 'part_wo_job':

         $data['parts']= PartsOrder::leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
         ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
         ->where('creator','=',Auth::user()->id)
         ->get();

         $view = 'admin.parts_wo_job.list';

         break;
         
         case 'view-part_wo_job':
         $data['job']= PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
         ->where('creator','=',Auth::user()->id)
         ->where('parts_order.part_order_id',$id)
         ->first();
         $view = 'admin.parts_wo_job.view';
         break;


         case 'gma_tech_lists';

        //  $data['gma'] = DB::table('product_repalcement_order')->join('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
        //  ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
        //  ->where('jobs.technician','=',Auth::user()->id)
         
        //  ->get();
         $data['gma'] = DB::table('product_repalcement_order')->join('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
         ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
         ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
         ->where('jobs.technician','=',Auth::user()->id)
         ->orderBy('jobs.job_date', 'desc')
         ->paginate(10);

         $view = 'admin.gma.tech_list';
         break;

         case 'rma_tech_lists';

         $data['gma'] = DB::table('product_repalcement_order')->join('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
         ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
         ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')

         ->where('jobs.technician','=',Auth::user()->id)
         ->orderBy('jobs.job_date', 'desc')
         ->paginate(10);


         $view = 'admin.rma.tech_list';
         break;


         case 'gma_asp_lists';

         $data['gma'] = DB::table('product_repalcement_order')->join('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
         ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
         ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
         ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
         ->orderBy('jobs.job_date', 'desc')
         ->paginate(10);


         $view = 'admin.gma.asp_list';
         break;

         case 'rma_asp_lists';

         $data['gma'] = DB::table('product_repalcement_order')->join('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
         ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
         ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
         ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
         ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
         ->orderBy('jobs.job_date', 'desc')
         ->paginate(10);


         $view = 'admin.rma.asp_list';
         break;



        case 'file_share':
        
        $data['users'] = Files::leftjoin('asp_admin','asp_admin.asp_admin_id','=','files.permission')
        ->leftjoin('asp_list','asp_list.code','=','asp_admin.warehouse_code')
        ->orderBy('files.file_id', 'desc')
        ->paginate(10);
       
       // $data['users11'] = User::where('user_role_id','=',2)->get();
        $data['users11']= User::leftjoin('asp_admin','users.id','=','asp_admin.asp_admin_id')
        ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
      ->where('users.user_role_id','=',2)
        ->get();
     
       $view = 'admin.fileshare.list';
        break;


        case 'create_file_share':

       $data['users'] = User::where('user_role_id','=',2)->get();
      
        $view = 'admin.fileshare.create';
        break;


        case 'asp_create_part_wo_job':

        $data['job']=Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
            ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
            ->first();

            $data['parts'] = Parts::get();
        $view = 'admin.aspparts_wo_job.create';
        break;
        case 'asp_part_wo_job':

        $data['parts']= PartsOrder::leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
        ->leftjoin('asp_admin','asp_admin.warehouse_code','=','parts_order.location') 
        ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
        ->where('parts_order.type','=','with_out_job')
       ->where('creator','=',Auth::user()->id)
        ->paginate(10);
       

        // $data['parts'] = DB::table('parts_order')->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
        // ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
        
        
        // ->leftjoin('asp_admin','asp_admin.warehouse_code','=','parts_order.location') 
        // ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id') 
        // ->where('type','=','with_out_job')
        // ->orderBy('parts_order.part_order_id', 'desc')
    
        // ->get();
     
     

        $view = 'admin.aspparts_wo_job.list';

        break;

        case 'asp_claims':
             
            $data['claims'] = Claim::leftjoin('jobs','jobs.job_id','=','claim.job_id')
            ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
            ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
            ->orderBy('jobs.job_date', 'desc')
            ->paginate(10);
           
            $view = 'admin.asp_jobs.claims';
            break;
        case 'asp_view-part_wo_job':
        $data['job']= PartsOrder::leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
        ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
        ->where('creator','=',Auth::user()->id)
        ->where('parts_order.part_order_id',$id)
        ->first();
        
        $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->where('parts_order.part_order_id','=',$id)
                ->get();
        $view = 'admin.aspparts_wo_job.view';
        break;

        case 'asp_files':
        $data['files'] = Files::where('permission',Auth::user()->id)
        ->get();
 
 
        $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
        ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
       ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
        ->where('users.user_role_id','=',3)
      
       ->get();

        $view = 'admin.asp_jobs.asp_files';
        break;



        case 'tech_files':
        $data['files'] = Files::leftjoin('tech_file_sharing','tech_file_sharing.file_id','=','files.file_id')
        ->where('tech_file_sharing.tehnician',Auth::user()->id)
        ->get();

       

        $view = 'admin.tech_jobs.tech_files';
        break;

      case 'invoices':
      
      $data['jobs'] = Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
      ->leftjoin('users','users.id','=','jobs.technician')
      ->leftjoin('job_status','job_status.status_id','=','jobs.status')
      ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
      ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
      ->leftjoin('claim','claim.job_id','=','jobs.job_id')
      ->select('claim.isapprove as claim_appr', 'jobs.*','parts_order.*','parts_list.*','claim.*','job_status.*','users.*')

      ->orderBy('jobs.job_date', 'desc')
      ->where('jobs.status','=',63)
      ->paginate(15);

      $view = 'admin.invoices.list';
      break;
      case 'asp-invoices':

      $data['jobs'] = Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
      ->leftjoin('users','users.id','=','jobs.technician')
      ->leftjoin('job_status','job_status.status_id','=','jobs.status')
      ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
      ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
      ->where('jobs.status','=',63)
      ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
      ->orderBy('jobs.job_date', 'desc')
      ->paginate(15);
      $view = 'admin.asp_jobs.asp_invoices';
      break;
     
      case 'tech-invoices':
      $data['jobs'] = Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
      ->leftjoin('users','users.id','=','jobs.technician')
      ->leftjoin('job_status','job_status.status_id','=','jobs.status')
      ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
      ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
      ->where('jobs.status','=',63)
      ->where('jobs.technician','=',Auth::user()->id)
      ->orderBy('jobs.job_date', 'desc')
      ->paginate(15);

      $view = 'admin.tech_jobs.tech_invoices';
      break;

	  
     case 'pending_part':
                $data['products'] = DB::table('products')->get();	
                $data['warehouse'] = WareHouse::get();
				$data['parts'] = Parts::get(); 
				$data['milaeges'] =Mileage::get();
                $data['parts_list'] = Parts::get();
                $data['faultys'] = DB::table('faultylist')->get();
				$data['resolutions'] =DB::table('resolutions')->get();
				$data['symptoms'] = DB::table('symptoms')->get();
                $data['jo_id'] =Request::segment(2);
	            $data['job'] = DB::table('jobs')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                    ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
                    //->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                    ->leftjoin('users','users.id','=','jobs.technician')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                    ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                    //->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    //->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                    ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
			        ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
                    ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                    ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                    ->select( 'jobs.*','products.*','claim.job_id as claimjob_id','jobs.technician as jo_tc','jobs.seriel_number as job_seriel_number','claim.remarks as claim_remarks','claim.isapprove as claim_approv','parts_order.isapprove as part_appr','jobs.remark as job_remark','parts_order.remark as part_remark','parts_order.apprv_remarks as appr_remark','product_repalcement_order.delivery_date as prod_deliver','grn.amount as grn_amount','grn.credit_note as grn_credit','grn.issue_image as grn_image','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as rma_ex_number','gma.rma_remarks as rma_remarks','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.issue_image as gma_image','gma.issue_image as gma_image','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel','claim.isapprove as claim_approve','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','asp_list.*','asp_admin.*','users.*','appointment.appointment_time','appointment.appointment_id','appointment.time','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','product_repalcement_order.*','grn.*','gma.*','asp_admin.*','parts_order.*','claim.*')
                    ->where('jobs.job_id','=',$id)
                    ->first();
                    
                $data['is_proof_image']   =  $this->isImageExstesion($data['job']->attach_proof);
                $data['is_symptom_image'] =  $this->isImageExstesion($data['job']->grn_image);
				$varj=$data['job']->asp_location;
	            $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                    ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                   //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                    ->where('asp_tech.warehouse_code','=',$varj)
                    ->where('users.user_role_id','=',3)
                    ->get();
				$data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                    ->where('jobs.job_id','=',$id)
                    ->get();
				
				$data['part'] = DB::table('parts_order')
                    ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->select( 'parts_list.*','muliple_parts.parts as mul_parts','customers.*','faultylist.*','symptoms.*','resolutions.*','parts_order.*','parts_list.*','jobs.job_id','jobs.job_location','jobs.repaire_order_no')
                    ->where('jobs.job_id','=',$id)
                    ->first();
				$data['claim'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id') 
				  	->leftjoin('data_mileage','data_mileage.mil_id','=','claim.mileage')
                    ->where('jobs.job_id',$id)->first();		
                $view = 'admin.jobs.pending_part';
        break;
	 
	 
	 case 'pending_asp':
	 
	            $data['products'] = DB::table('products')->get();
                $data['warehouse'] = WareHouse::get();
				$data['parts'] = Parts::get(); 
				$data['milaeges'] =Mileage::get();
                $data['parts_list'] = Parts::get();
                $data['faultys'] = DB::table('faultylist')->get();
				$data['resolutions'] =DB::table('resolutions')->get();
				$data['symptoms'] = DB::table('symptoms')->get();
                $data['jo_id'] =Request::segment(2);
	            $data['job']= DB::table('jobs')
                    ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                    ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                    ->leftjoin('users','users.id','=','jobs.technician')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                    ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
			  		->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
                    ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                    ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                    ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                    ->select('jobs.*','appointment.job_id as appjob_id','jobs.seriel_number as job_seriel_number','jobs.technician as jo_tc','parts_order.delivery_date as part_del','product_repalcement_order.delivery_date as prod_del','claim.remarks as claim_remarks','claim.isapprove as claim_approv','jobs.remark as job_remark','parts_order.apprv_remarks as appr_remark','appointment.time','parts_order.remark as part_remark','products.*','grn.amount as grn_amount','grn.credit_note as grn_credit','grn.issue_image as grn_image','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as rma_ex_number','gma.rma_remarks as rma_remarks','gma.issue_image as gma_image','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel', 'jobs.*','claim.job_id as claimjob_id','claim.isapprove as claim_approve','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','parts_order.*','asp_list.*','asp_admin.*','users.*','appointment.appointment_time','appointment.appointment_id','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','grn.*','gma.*','product_repalcement_order.*')
                    ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
					->where('jobs.job_id','=',$id)
					->first();
                $data['is_proof_image']   =  $this->isImageExstesion($data['job']->attach_proof);
                $data['is_symptom_image'] =  $this->isImageExstesion($data['job']->grn_image);	
				$varj=$data['job']->asp_location;
	            $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                    ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                   //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                    ->where('asp_tech.warehouse_code','=',$varj)
                    ->where('users.user_role_id','=',3)
                   ->get();
				$data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                    ->where('jobs.job_id','=',$id)
                    ->get();
				$data['part'] = DB::table('parts_order')
                    ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->select( 'parts_list.*','muliple_parts.parts as mul_parts','customers.*','faultylist.*','symptoms.*','resolutions.*','parts_order.*','parts_list.*','jobs.job_id','jobs.job_location','jobs.repaire_order_no')
                    ->where('jobs.job_id','=',$id)
                    ->first();
				$data['claim'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id') 
				  	->leftjoin('data_mileage','data_mileage.mil_id','=','claim.mileage')
                    ->where('jobs.job_id',$id)->first();
	            $view = 'admin.asp_jobs.pending_asp';
	        break;
	 
	 
	 case 'pending_tech':
            $data['products'] = DB::table('products')->get();
            $data['warehouse'] = WareHouse::get();
            $data['parts'] = Parts::get(); 
            $data['milaeges'] =Mileage::get();
            $data['parts_list'] = Parts::get();
            $data['faultys'] = DB::table('faultylist')->get();
            $data['resolutions'] =DB::table('resolutions')->get();
            $data['symptoms'] = DB::table('symptoms')->get();
            $data['jo_id'] =Request::segment(2);
            $data['job']= DB::table('jobs')
                ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
                ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                ->leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
                ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
                ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                ->leftjoin('appointment','appointment.job_id','=','jobs.job_id')
                ->leftjoin('claim','claim.job_id','=','jobs.job_id')
                ->select('jobs.*','appointment.job_id as appjob_id','jobs.seriel_number as job_seriel_number','jobs.technician as jo_tc','parts_order.delivery_date as part_del','product_repalcement_order.delivery_date as prod_del','claim.remarks as claim_remarks','claim.isapprove as claim_approv','jobs.remark as job_remark','parts_order.apprv_remarks as appr_remark','appointment.time','parts_order.remark as part_remark','products.*','grn.amount as grn_amount','grn.credit_note as grn_credit','grn.issue_image as grn_image','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as rma_ex_number','gma.rma_remarks as rma_remarks','gma.issue_image as gma_image','gma.spare_part_no as gma_spare','grn.spare_part_no as grn_spare','grn.application_date as grn_appl','grn.purchase_date as grn_purchase','gma.application_date as gma_appl','gma.purchase_date as gma_purchase','grn.seriel_no as grn_seriel','gma.seriel_no as gma_seriel', 'jobs.*','claim.job_id as claimjob_id','claim.isapprove as claim_approve','customers.*','faultylist.*','symptoms.*','job_status.*','resolutions.*','parts_order.*','asp_list.*','asp_admin.*','users.*','appointment.appointment_time','appointment.appointment_id','claim.claim_amount','claim.mileage','claim.labour','claim.claim_id','grn.*','gma.*','product_repalcement_order.*')
                ->where('jobs.technician','=',Auth::user()->id)
                ->where('jobs.job_id','=',$id)
                ->first();
            $data['is_proof_image']   =  $this->isImageExstesion($data['job']->attach_proof);
            $data['is_symptom_image'] =  $this->isImageExstesion($data['job']->grn_image);	
            $varj=$data['job']->asp_location;
            $data['techs'] = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                //->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                ->where('asp_tech.warehouse_code','=',$varj)
                ->where('users.user_role_id','=',3)
                ->get();
            $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->where('jobs.job_id','=',$id)
                ->get();
            $data['part'] = DB::table('parts_order')
                ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                ->select( 'parts_list.*','muliple_parts.parts as mul_parts','customers.*','faultylist.*','symptoms.*','resolutions.*','parts_order.*','parts_list.*','jobs.job_id','jobs.job_location','jobs.repaire_order_no')
                ->where('jobs.job_id','=',$id)
                ->first();
            $data['claim'] = Job::leftjoin('claim','claim.job_id','=','jobs.job_id') 
                ->leftjoin('data_mileage','data_mileage.mil_id','=','claim.mileage')
                ->where('jobs.job_id',$id)->first();
	            $view = 'admin.tech_jobs.pending_tech';
	        break;
	    
		case 'reports':
		 $data['techs'] = User::leftjoin('jobs','jobs.technician','=','users.id')
            ->where('users.user_role_id','=',3)
            ->get();
			            $data['warehouse'] = DB::table('asp_list')->get();

		$data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
              ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
             ->select( 'jobs.*','muliple_parts.*','parts_list.*','asp_list.*','muliple_parts.created_at as mul_date','parts_order.*')
                ->get();

			  $view = 'admin.reports.report';

		
		break;
		

        case 'generate-pdf';

        $data['user'] = DB::table('product_repalcement_order')->join('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
        ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
        ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
        ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
        ->where('gma.gma_id','=',$id)
        ->first();
        
        
        $pdf = PDF::loadView('admin.invoices.view',$data);
        // download pdf
        return $pdf->download('pdfview.pdf');
        break;
        
        case 'generate-pdf-grn';

 

        $data['warehouse'] =Job::leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
        ->leftjoin('asp_list','asp_list.code','=','asp_admin.warehouse_code')
        ->where('jobs.job_id','=',$id)
        ->first();

      

        $data['tss'] = User::where('user_role_id','=',1)->first();
        $data['date']=Carbon::now();

        $data['rma'] = DB::table('jobs')
      ->leftjoin('product_repalcement_order','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
        ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
        ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')

        ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
        ->leftjoin('claim','claim.job_id','=','jobs.job_id')
        
      ->leftjoin('parts_order','parts_order.part_order_id','=','jobs.parts_order')
         ->leftjoin('parts_list','parts_list.part_id','=','parts_order.parts_item')
        ->where('jobs.job_id','=',$id)
        ->first();
 
        $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
        ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
        ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
        ->where('jobs.job_id','=',$id)
        ->get();
       
       
        ini_set('max_execution_time', 300);
            $pdf = PDF::loadView('admin.invoices.view',$data);
            // download pdf
            return $pdf->download('pdfview.pdf');
          
        break;

        case 'generate-delivery-parts':
       
        $data['user'] = PartsOrder::leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
            ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
            ->leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
            ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')

            ->where('jobs.job_id','=',$id)
            ->first();

            $data['mul_parts'] = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
            ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
            ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
            ->where('jobs.job_id','=',$id)
            ->get();


        ini_set('max_execution_time', 300);
        $pdf = PDF::loadView('admin.gma.parts_delivery',$data);
        // download pdf
        return $pdf->download('pdfview.pdf');
        break;


        case 'generate-grn-report':
       
        $data['user'] = DB::table('product_repalcement_order')->join('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
        ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
        ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')

        ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
        ->leftjoin('users','users.id','=','product_repalcement_order.creator')
        ->where('jobs.job_id','=',$id)
        ->first();

        ini_set('max_execution_time', 300);
        $pdf = PDF::loadView('admin.gma.report',$data);
        // download pdf
        return $pdf->download('pdfview.pdf');
        break;

 case 'generate-rma-report':
        
        $data['user'] = DB::table('product_repalcement_order')->join('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
        ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
        ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
        ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')

         ->leftjoin('symptoms','symptoms.symptom_id','=','gma.symptom')
        ->leftjoin('users','users.id','=','product_repalcement_order.creator')
        ->where('jobs.job_id','=',$id)
        ->first();
      
        ini_set('max_execution_time', 300);
        $pdf = PDF::loadView('admin.rma.report',$data);
        // download pdf
        return $pdf->download('pdfview.pdf');
        break;

        case 'generate-credit-note':

        $data['user'] = DB::table('product_repalcement_order')
                    ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                  ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                  ->select( 'grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as gma_ex','jobs.*','product_repalcement_order.*','grn.*','gma.*')

                    ->where('jobs.job_id','=',$id)
                    ->first();
  
  
       
 

        ini_set('max_execution_time', 300);
        $pdf = PDF::loadView('admin.gma.credit',$data);
        
        return $pdf->download('pdfview.pdf');
        break;


        case 'generate-transfer-order':

        $data['user'] = DB::table('product_repalcement_order')
                    ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                  ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                  ->select( 'grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as gma_ex','jobs.*','product_repalcement_order.*','grn.*','gma.*')

                    ->where('jobs.job_id','=',$id)
                    ->first();


        ini_set('max_execution_time', 300);
        $pdf = PDF::loadView('admin.gma.transfer',$data);
        
        return $pdf->download('pdfview.pdf');
        break;

        case 'generate-faulty-report':

        $data['user'] = DB::table('product_repalcement_order')
                    ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                  ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                  ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
                  ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')

                  ->select( 'grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as gma_ex','jobs.*','product_repalcement_order.*','grn.*','gma.*','products.*','customers.*')
                    ->where('jobs.job_id','=',$id)
                    ->first();

  
       
 

        ini_set('max_execution_time', 300);
        $pdf = PDF::loadView('admin.gma.faulty_set',$data);
        
        return $pdf->download('pdfview.pdf');
        break;


        case 'generate-delivery-report':

        $data['user'] = DB::table('product_repalcement_order')
                    ->leftjoin('jobs','jobs.product_replacement','=','product_repalcement_order.product_replacement_id')
                    ->leftjoin('grn','grn.order_id','=','product_repalcement_order.product_replacement_id')
                  ->leftjoin('gma','gma.order_id','=','product_repalcement_order.product_replacement_id')
                  ->leftjoin('products','products.product_no','=','product_repalcement_order.product_id')
                  ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')

                  ->select( 'grn.amount as grn_amount','grn.credit_note as grn_credit','grn.ex_number as grn_ex','gma.amount as gma_amount','gma.credit_note as gma_credit','gma.ex_number as gma_ex','jobs.*','product_repalcement_order.*','grn.*','gma.*','products.*','customers.*')
                    ->where('jobs.job_id','=',$id)
                    ->first();
 
  
       


        ini_set('max_execution_time', 300);
        $pdf = PDF::loadView('admin.gma.delivery',$data);
        
        return $pdf->download('pdfview.pdf');
        break;




        case 'parts_list':
        $data['parts'] = Parts::orderBy('part_id', 'desc')->paginate(15);
        $view = 'admin.parts_setup.list';
        break;

         case 'edit-spare-part':
         $data['parts'] = Parts::where('part_id','=', $id)->first();
       
         $view = 'admin.parts_setup.edit';
         break;
         case 'view-spare-part':
         $data['admin'] = Parts::where('part_id','=', $id)->first();
       
         $view = 'admin.parts_setup.view';
         break;

         case 'mileag_list':
         $data['parts'] = Mileage::orderBy('mil_id', 'desc')->paginate(15);
         
         $view = 'admin.mileage_setup.list';
         break;
 
          case 'edit-mileag':
          $data['parts'] = Mileage::where('mil_id','=', $id)->first();
        
          $view = 'admin.mileage_setup.edit';
          break;
          case 'view-mileag':
          $data['admin'] = Mileage::where('mil_id','=', $id)->first();
        
          $view = 'admin.mileage_setup.view';
          break;

          case 'faulty_list':
          $data['parts'] = DB::table('faultylist')->orderBy('faulty_id', 'desc')->paginate(15);
          
          $view = 'admin.faulty_list.list';
          break;
  
           case 'edit-faulty_list':
           $data['parts'] = DB::table('faultylist')->where('faulty_id','=', $id)->first();
         
           $view = 'admin.faulty_list.edit';
           break;
           case 'view-faulty_list':
           $data['admin'] = DB::table('faultylist')->where('faulty_id','=', $id)->first();
         
           $view = 'admin.faulty_list.view';
           break;

           case 'symptoms':
           $data['parts'] = DB::table('symptoms')->orderBy('symptom_id', 'desc')->paginate(15);
           
           $view = 'admin.symptoms.list';
           break;
   
            case 'edit-symptom':
            $data['parts'] = DB::table('symptoms')->where('symptom_id','=', $id)->first();
          
            $view = 'admin.symptoms.edit';
            break;
            case 'view-symptom':
            $data['admin'] = DB::table('symptoms')->where('symptom_id','=', $id)->first();
          
            $view = 'admin.symptoms.view';
            break;

            case 'resolutions':
            $data['parts'] = DB::table('resolutions')->orderBy('resolution_id', 'desc')->paginate(15);
            
            $view = 'admin.resolutions.list';
            break;
    
             case 'edit-resolution':
             $data['parts'] = DB::table('resolutions')->where('resolution_id','=', $id)->first();
           
             $view = 'admin.resolutions.edit';
             break;
             case 'view-resolution':
             $data['admin'] = DB::table('resolutions')->where('resolution_id','=', $id)->first();
           
             $view = 'admin.resolutions.view';
             break;
             
             case 'product_list':
             $data['parts'] = DB::table('products')->orderBy('product_no', 'desc')->paginate(15);
             
             $view = 'admin.products.list';
             break;
     
              case 'edit-product':
              $data['parts'] = DB::table('products')->where('product_no','=', $id)->first();
            
              $view = 'admin.products.edit';
              break;
              case 'view-product':
              $data['admin'] = DB::table('products')->where('product_no','=', $id)->first();
            
              $view = 'admin.products.view';
              break;


            case 'download':

                $csdaas=DB::table('csvdata')->get();
                $tot_record_found=0;
                if(count($csdaas)>0){
                    $tot_record_found=1;
                    //First Methos
                    $export_data="Country Id,Country Name\n";
                    foreach($csdaas as $value){
                        $export_data.=$value->joblocation1.','.$value->	docno1.','.$value->	textbox94."\n";
                    }
                    return response($export_data)
                        ->header('Content-Type','application/csv')
                        ->header('Content-Disposition', 'attachment; filename="download.csv"')
                        ->header('Pragma','no-cache')
                        ->header('Expires','0');
                }
                return view('download',['record_found' =>$tot_record_found]);


                break;



        }

        return view($view)->with($data);
    }

    public function postFileUpload(){

        $option = array(
            /* some options */
            'upload_dir' => 'data/temp/',

            /* .... */
        );


        $upload_handler = new UploadFileHandler($option);
    }

    public function isImageExstesion($path){
        if($path != null){
            return (preg_match("/\.(gif|png|jpg)$/", $path));
        }else {
            return false;
        }
    }




}
